<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Cell;

// models
use App\Models\Tinh;
use App\Models\TinhTemp;
use App\Models\Huyen;
use App\Models\HuyenTemp;
use App\Models\Dtgm;
use App\Models\DtgmTemp;
use App\Models\NhatKy;
use App\Models\User;
use DB;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Hash;


use App\Http\Controllers\Backend\CustomClass\CustomExcel;
use App\Lib\CheckMbc;
use App\Lib\ConvertAndUnicode;

class adminController extends Controller
{

    private $convert;
    private $checkMbc;

    public function __construct()
    {
        $this->convert = new ConvertAndUnicode();
        $this->checkMbc = new CheckMbc();
    }

    public function getindex()
    {
        return view('view.admin.index');
    }

    public function diary()
    {
        $data = nhatky::paginate(30);
        return view('backend.diary', compact('data'));
    }

    public function manage_account()
    {
        $data = User::paginate(20);
        return view('backend.manageAcc', compact('data'));
    }

    public function setting_account()
    {

        return view('backend.settingAcc');
    }

    public function update_account(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'unique:users,email'
            ],
            [

                'email.unique' => 'Email này đã trùng với tài khoản khác'
            ]
        );

        User::where('id', $request->id)->update(['name' => $request->name, 'email' => $request->email]);
        return redirect()->back();
    }

    public function deleteAcc(Request $request)
    {
        $id = $request->id;
        User::where('id', $id)->delete();
        return redirect()->route('admin.manage_account');
    }

    public function add_account()
    {

        return view('backend.addAcc');
    }

    public function createAcc(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'repassword' => 'required|same:password'
            ],
            [
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email này đã thuộc về 1 tài khoản',
                'name.required' => 'Hãy nhập tên cán bộ',
                'password.min' => 'Mật khẩu tối đa 6 ký tự',
                'password.max' => 'Mật khẩu không quá 20 ký tự',
                'password.required' => 'Mật khẩu không không được để trống',
                'repassword.same' => 'Mật khẩu không khớp',
                'repassword.required' => 'Hãy nhập lại mật khẩu'
            ]
        );

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->role = $role;
        $user->password = bcrypt($password);
        $user->save();

        return redirect()->back()->with('thanhcong', 'Tạo tài khoản thành công');
    }

    public function updateRole(Request $request)
    {
        $id = $request->id;
        User::where('id', $id)->update(["role" => $request->role]);
        return redirect()->route('admin.manage_account');
    }

    public function getAcc(Request $request)
    {
        $keyword = strval($request->query);
        $data = User::where('name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')->select('email')->get()->toArray();
        return json_encode($data);
    }

    public function searchAcc(Request $request)
    {
        $keyword = $request->keyword;
        $data = User::where('name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')->get();
        return view('backend.searchAcc', compact('data'));
    }

    public function changePass(Request $request)
    {


        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Mật khẩu nhập không khớp với mật khẩu cũ.Xin nhập lại !");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "Mật khẩu mới không thể trùng với mật khẩu cũ. Hãy nhập lại mật khẩu khác !");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("thanhcong", "Đổi mật khẩu thành công !");
    }
    /************** Excel *************************/
    /**
     * Trả về view cập nhật Excel
     */
    public function import_excels(Request $request)
    {
        return view('backend.import');
    }

    /**
     * Xử lý việc cập nhật Excel
     */
    public function import_excel(Request $req)
    {
        // 0. check validate
        $this->validate(
            $req,
            [
                'select_file' => 'required|mimes:xls,xlsx'
            ],
            [
                'select_file.required' => 'Hãy nhập 1 file Excel',
                'select_file.mimes' => 'Hãy chọn đúng file đuôi xls hoặc xlsx'

            ]
        );
        // 1. Đọc file Excel trả về mảng data
        $customExcel = new CustomExcel;
        // $arrExcel = $customExcel->addTenHuyen("Bưu Cục Trung tâm thành phố Long Xuyên", "thành phố Long Xuyên", "tỉnh An Giang");
        $arrExcel = $customExcel->readDataExcell($req);
        // dd($arrExcel);

        $arrImport = $arrExcel['huyen'][5];
        // dd($arrImport);

        $data =  [
            'id' => 1,
            'quan' => $arrImport['quan'],
            'ten' => $arrImport['ten'],
            'ten_eng' => "teng_eng",
            'mabc' => $arrImport['mbc'],
            'id_tinh' => 1
        ];

        // $tenHuyen = huyen::select('ten')->where('id',6)->get();
        // $tenHuyenTemp = huyen_temp::select('ten')->where('id',1)->get();
        // echo utf8_encode($tenHuyen);

        //  return view('backend.import')->with(['count' => $tenHuyen]);
        // echo mb_convert_encoding($tenHuyen, 'utf-8') . "<br>";
        // echo $tenHuyenTemp . "<br>";
        // if($tenHuyen == $tenHuyenTemp) {
        //     echo "ok";
        // } else {
        //     echo "false";
        // }

        // dd($tenHuyen);

        // huyen_temp::insert($data);

        // return view('backend.import')->with(['dataExcel' => $arrExcel]);

        // 2. Đọc database trả về mảng data
        $arrDatabase = $customExcel->readDataDb($arrExcel);
        // dd($arrDatabase);
        // return view('backend.import')->with(['arrDb' => $arrDatabase]);

        // 3. So sánh với database
        $arrExcel = $customExcel->compareDb($arrExcel, $arrDatabase);
        // return view('backend.import')->with(['count' => $arrExcel]);
        dd($arrExcel);
        return view('backend.import')->with(['dataExcel' => $arrExcel]);

        $id_tinh = $arrExcel[4][0];
        $dem = count($arrExcel);
        for ($i = 5; $i < $dem; $i++) {
            $tinh = $arrExcel[$i][0];
            $quan = $arrExcel[$i][1];
            $dtgm = $arrExcel[$i][2];
            $diachi = $arrExcel[$i][5];
            $them = $arrExcel[$i][6];
            $sua = $arrExcel[$i][7];
            $xoa = $arrExcel[$i][8];
            //Tỉnh
            if ($tinh == null && $quan == null && $dtgm != null) {

                if ($them != null && $sua == null && $xoa == null) {
                    $add = new TinhChitiet();
                    $add->dt_gan_ma = $arrExcel[$i][2];
                    $add->ten = $arrExcel[$i][3];
                    $add->mabc = $arrExcel[$i][4];
                    $add->id_tinh = $id_tinh;
                    $add->save();
                } elseif ($sua != null && $them == null && $xoa == null) {
                    $update = TinhChitiet::where([['dt_gan_ma', $dtgm], ['id_tinh', $id_tinh]])->update([
                        'dt_gan_ma' => $dtgm, 'ten' => $arrExcel[$i][3], 'mabc' => $arrExcel[$i][4], 'id_tinh' => $id_tinh,
                        'data3' => $diachi
                    ]);
                } elseif ($xoa != null && $sua == null && $them == null) {
                    $delete = TinhChitiet::where([['dt_gan_ma', $dtgm], ['id_tinh', $id_tinh]])->delete();
                }
            }
            //Quận, huyện
            if ($tinh == null && $quan != null && $dtgm != null) {
                $data = huyen::where([['quan', $quan], ['id_tinh', $id_tinh]])->get()->toArray();
                $id_huyen = $data[0]['id'];

                if ($them != null && $sua == null && $xoa == null) {
                    $add = new chitiet();
                    $add->doi_tuong_gan = $arrExcel[$i][2];
                    $add->ten = $arrExcel[$i][3];
                    $add->mabc = $arrExcel[$i][4];
                    $add->id_huyen = $id_huyen;
                    $add->save();
                }
                if ($sua != null && $them == null && $xoa == null) {
                    $update = chitiet::where([['id_huyen', $id_huyen], ['doi_tuong_gan', $dtgm]])->update([
                        'doi_tuong_gan' => $dtgm, 'ten' => $arrExcel[$i][3], 'mabc' => $arrExcel[$i][4]
                    ]);
                }
                if ($xoa != null && $sua == null && $them == null) {

                    $delete = chitiet::where([['doi_tuong_gan', $dtgm], ['id_huyen', $id_huyen]])->delete();
                }
            }
        }

        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Đã cập nhật bằng Excel ';
        $diary->save();

        return redirect()->back()->with('thanhcong', 'Import thành công !');
    }
/********************** Tinh ********************/
    public function getTinh(request $request)
    {
        if (isset($request->search)) {

            $value = $request->search;
            $arr = explode('-', $value);
            $value1 = $arr[count($arr) - 1];
            $value2 = $arr[0];
            $tinhs = tinh::where('mabc', 'LIKE', "%" . $value2 . "%")
                ->orWhere('mabc', $value2)->paginate(20);
        } else {
            $tinhs = Tinh::orderBy('id', 'asc')
                ->paginate(20);
        }
        return view('backend.tinh', compact('tinhs'));
    }

    public function addTinh()
    {
        return view('backend.addTinh');
    }

    /**
     * Thêm mới 1 tỉnh
     */
    public function PostaddTinh(request $request)
    {
        $validator = $this->validate(
            $request,
            [
                'id'    => 'unique:bc_tinh,id|required|integer',
                'ten'   => 'required',
                'mbc'   => 'unique:bc_tinh,mbc|required',

            ],
            [
                'id.unique'   => ':attribute này đã tồn tại',
                'mbc.unique'  => ':attribute này đã tồn tại',
                'required'    => ':attribute không được để trống',
                'integer'     => ':attribute phải là số nguyên',
            ],
            [
                'id' => 'ID',
                'ten' => 'Tên',
                'mbc' => 'Mã'
            ]
        );

        $ten = $request->ten;
        $teneng = $this->convert->toHop2DungSan($ten);
        $teneng = $this->convert->convert_vi_to_en($teneng);
        $tinh = [
            'id'        => $request->id,
            'ten'       => $ten,
            'ten_eng'   => $teneng,
            'mbc'       => $request->mbc,
            'dienthoai' => $request->dienthoai,
            'diachi'    => $request->diachi,
            'email'     => $request->email,
            'website'   => $request->website,
            'ghichu'    => $request->ghichu
        ];

        Tinh::insert($tinh);

        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Thêm: ' . $request->ten . ' - mã: ' . $request->mbc;
        $diary->save();
        return redirect('admin/tinh')->with('thanhcong', 'Thêm mới tỉnh thành công');
    }


    public function editTinh($id)
    {
        $tinh = tinh::findORFail($id);
        return view('backend.editTinh', compact('tinh'));
    }



    public function postEditTinh($id, request $request)
    {
        $tinh = Tinh::findORFail($id);
        $data = $request->only('id', 'ten', 'ten_eng', 'mbc', 'dienthoai', 'diachi', 'email', 'website', 'ghichu');
        $tinh->update($data);

        // todo: sửa mã cha -> mã con sửa theo 

        // if (strlen($request->mabc) == 2) {
        //     $data2 = TinhChitiet::where('id_tinh', $id)->get()->toArray();
        //     $count = count($data2);
        //     for ($i = 0; $i < $count; $i++) {
        //         $id2 = $data2[$i]['id'];
        //         $mabc = $data2[$i]['mabc'];
        //         $num = intval(substr($mabc, 2, 4));
        //         $newnum = $request->mabc * 1000 + $num;
        //         TinhChitiet::where('id', $id2)->update(['mabc' => $newnum]);
        //     }

        //     $data3 = huyen::where('id_tinh', $id)->get()->toArray();
        //     $count2 = count($data3);
        //     for ($i = 0; $i < $count2; $i++) {
        //         $id3 = $data3[$i]['id'];
        //         $mabc = $data3[$i]['mabc'];
        //         $newnum = str_replace($request->code, $request->mabc, $mabc);
        //         huyen::where('id', $id3)->update(['mabc' => $newnum]);
        //     }

        //     for ($i = 0; $i < $count2; $i++) {
        //         $idhuyen = $data3[$i]['id'];
        //         $data = chitiet::where('id_huyen', $idhuyen)->get()->toArray();
        //         $count = count($data);
        //         for ($j = 0; $j < $count; $j++) {
        //             $idchitiet = $data[$j]['id'];
        //             $mabc = $data[$j]['mabc'];
        //             $newnum = str_replace($request->code, $request->mabc, $mabc);
        //             chitiet::where('id', $idchitiet)->update(['mabc' => $newnum]);
        //         }
        //     }
        // } elseif (strlen($request->mabc) > 2) {

        //     $arr = explode('-', $request->mabc);
        //     $data = TinhChitiet::where('id_tinh', $id)->get()->toArray();
        //     $count = count($data);
        //     $code = round(count($data) / 10000);
        //     for ($j = 0; $j < count($arr); $j++) {
        //         $mbc = $arr[$j];
        //         for ($i = 0; $i < 10000; $i++) {
        //             $id2 = $data2[$i]['id'];
        //             $mabc = $data2[$i]['mabc'];
        //             $num = intval(substr($mabc, 2, 4));
        //             $newnum = $mbc * 1000 + $num;
        //             TinhChitiet::where('id', $id2)->update(['mabc' => $newnum]);
        //         }
        //     }
        // }


        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Cập nhât: ' . $request->ten . ' - mã: ' . $request->mbc;
        $diary->save();

        return redirect('admin/tinh');
    }

    public function deleteTinh($id)
    {
        $tinh = tinh::where('id', $id)->get()->toArray();
        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Xóa:' . $tinh[0]['ten'] . ' - mã: ' . $tinh[0]['mbc'];
        $diary->save();
        tinh::destroy($id);

        return redirect('admin/tinh');
    }


    //huyen
    public function getHuyen(request $request)
    {

        if (isset($request->search)) {

            $value = $request->search;
            $arr = explode('-', $value);
            $value = $arr[count($arr) - 1];
            $value2 = $arr[0];
            $huyens = Huyen::where('mabc', 'LIKE', "%" . $value2 . "%")->orWhere('mabc', $value2)->paginate(20);
            dd($huyens);
        } else {

            $arrTinhSelect = Tinh::orderBy('id', 'asc')->get();
            if (isset($request->fillter_huyen)) {
                $value = $request->fillter_huyen;
                dd($value);
            }
            $arrHuyen = Huyen::orderBy('id_tinh', 'asc')->paginate(20);
        }
        return view('backend.huyen')->with([
            'arrTinh' => $arrTinhSelect,
            'arrHuyen' => $arrHuyen
        ]);
    }

    /**
     * Lọc Huyện theo Tỉnh
     */
    function getHuyenFetch(Request $reques)
    {
        $idTinh = $reques->id_tinh;
        $arrHuyen = Huyen::where('id_Tinh', $idTinh)
            ->get();

        return response()->json($arrHuyen);

        // return view('backend.huyen_data')->with('arrHuyen', $arrHuyen)->render();
        // echo $arrHuyen;

        // $output = "";
        // $stt = 1;
        // foreach ($arrHuyen as $huyen) {
        //     $output .=
        //     ' <tr>
        //         <td style= "text-align:center;">' .$stt .'</td>
        //         <td style= "text-align:center;">' .$huyen->ten .'</td>
        //         <td style= "text-align:center;">' .$huyen->mbc .'</td>
        //         <td style= "text-align:center;">' .$huyen->dienthoai .'</td>
        //         <td style= "text-align:center;">' .$huyen->diachi .'</td>
        //         <td style= "text-align:center;">' .$huyen->email .'</td>
        //         <td style= "text-align:center;">' .$huyen->website .'</td>
        //         <td style= "text-align:center;">' .$huyen->ghichu .'</td>
        //         <td style="text-align:center;">
        //             <a href='.url('/')."/admin/huyen/edit/".$huyen->id.' class="btn btn-warning"> Sửa</a>
        //             <a href='.url('/')."/admin/huyen/delete/".$huyen->id.' class="btn btn-danger" onclick="return confirmAction();"> Xóa</a>
        //         </td>

        //     </tr>';
        //     $stt++;
        // }

        // echo $output;
    }

    public function editHuyen($id)
    {

        $huyen = huyen::findORFail($id);
        return view('backend.editHuyen', compact('huyen'));
    }
    public function postEditHuyen($id, request $request)
    {
        $request->validate([
            'id_tinh' => 'required',
        ], [
            'id_tinh.required' => 'Nhập đúng tên tỉnh',
        ]);
        $value = $request->id_tinh;
        $arr = explode('-', $value);
        $value = $arr[count($arr) - 1];
        $value2 = $arr[0];
        $data1 = tinh::where('ten', $value)->orWhere('mabc', $value2)->firstOrFail();

        $huyen = huyen::findORFail($id);
        $data = $request->only('quan', 'ten', 'ten_eng', 'mabc', 'data1', 'data2', 'data3', 'data4', 'data5');
        $data['id_tinh'] = $data1->id;
        $huyen->update($data);
        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Đã cập nhật thông tin huyện ' . $request->ten . ' mã bưu chính ' . $request->mabc;
        $diary->save();
        return redirect('admin/huyen');
    }
    public function deleteHuyen($id)
    {
        $huyen = Huyen::where('id', $id)->get()->toArray();
        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Xóa: ' . $huyen[0]['ten'] . ' - mã:' . $huyen[0]['mbc'];
        $diary->save();
        Huyen::destroy($id);
        return redirect('admin/huyen');
    }
    public function addHuyen()
    {
        return view('backend.addHuyen');
    }
    public function PostaddHuyen(request $request)
    {
        $request->validate([
            'id_tinh' => 'required',
        ], [
            'id_tinh.required' => 'Nhập đúng tên tỉnh',
        ]);

        $value = $request->id_tinh;
        $arr = explode('-', $value);
        $value = $arr[count($arr) - 1];
        $value2 = $arr[0];
        $data1 = tinh::where('ten', $value)->orWhere('mabc', $value2)->firstOrFail();

        $data = $request->only('quan', 'ten', 'mabc', 'data1', 'data2', 'data3', 'data4', 'data5');
        $data['id_tinh'] = $data1->id;
        huyen::create($data);
        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Đã thêm huyện ' . $request->ten . ' mã bưu chính ' . $request->mabc;
        $diary->save();
        return redirect('admin/huyen');
    }


    /********************* Đối tượng gắn mã */
    public function getDoiTuongGanMa(request $request)
    {
        if (isset($request->search)) {
            $tinh = tinh::all();
            $value = $request->search;
            $arr = explode('-', $value);
            $value = $arr[count($arr) - 1];
            $value2 = $arr[0];
            $chitiets = chitiet::where('ten_eng', 'LIKE', "%" . $value . "%")->orWhere('mabc', $value2)->get()->toArray();
            $chitiets2 = TinhChitiet::where('ten_eng', 'LIKE', "%" . $value . "%")->orWhere('mabc', $value2)->get()->toArray();
            if ($chitiets != null || $chitiets2 != null) {
                return view('backend.huyenchitiet', compact('chitiets', 'chitiets2', 'tinh'));
            } else {
                return redirect()->back();
            }
        } else {
            $arrTinhSelect = Tinh::orderBy('id', 'asc')->get();
            $idTinhFirst = $arrTinhSelect[0]->id;
            // todo
            $arrHuyenSelect = Huyen::orderBy('id', 'asc')
                ->where('id_tinh', $idTinhFirst)->get();
            $arrDtgm = Dtgm::orderBy('id_tinh', 'asc')
                ->where('id_tinh', $idTinhFirst)->paginate(20);
            return view('backend.doituongganma')->with([
                'arrTinh' => $arrTinhSelect,
                'arrHuyen' => $arrHuyenSelect,
                'arrDtgm' => $arrDtgm
            ]);

            $tinh = Tinh::all();
            if (!isset($request->id_tinh)) {
                $value = 1;
            } else {
                $value = $request->id_tinh;
            }

            $id_tinh = tinh::where('id', $value)->get()->toArray();
            $ten_tinh = $id_tinh[0]['ten'];
            $arrhuyen = [];
            $arrtinh = [];
            $arr = [];

            $tinhchitiet = Dtgm::where('id_tinh', $value)->orderBy('mbc', 'asc')->get()->toArray();
            array_push($arrtinh, $tinhchitiet);
            $id_huyen = huyen::select('id')->where('id_tinh', $value)->get()->toArray();
            for ($j = 0; $j < count($id_huyen); $j++) {
                $huyenchitiet = chitiet::where('id_huyen', $id_huyen[$j]['id'])->orderBy('mabc', 'asc')->get()->toArray();
                array_push($arrtinh, $huyenchitiet);
            }

            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $itemCollection = collect($arrtinh);

            $perPage = 1;

            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

            $paginatedItems->setPath($request->url());

            return view('backend.huyenchitiet', ['arrtinh' => $paginatedItems], compact('tinh', 'ten_tinh'));
        }
    }

    /**
     * Lọc tỉnh, huyện bằng select option
     */
    public function dtgmGetTinhFetch(Request $reques)
    {
        if ($reques->ajax()) {
            $output = array();

            $idTinh = $reques->id_tinh;
            $arrHuyen = Huyen::where('id_Tinh', $idTinh)
                ->get();
            $output['option'] = '<option value="0">Chọn Huyện</option>';
            foreach ($arrHuyen as $v) {
                $output['option'] .= '<option value="' . $v->id . '">' . $v->ten . '</option>';
            }

            $arrDtgm = Dtgm::where('id_tinh', $idTinh)
                ->get();

            $output['dtgm_data'] = '';
            $stt = 1;
            foreach ($arrDtgm as $v) {
                $output['dtgm_data'] .=
                '<tr>
                    <td style="text-align:center;">' . $stt . '</td>
                    <td style="text-align:center;">' . $v->ten . '</td>
                    <td style="text-align:center;">' . $v->mbc . '</td>
                    <td style="text-align:center;">' . $v->dienthoai . '</td>
                    <td style="text-align:center;">' . $v->diachi . '</td>
                    <td style="text-align:center;">' . $v->email . '</td>
                    <td style="text-align:center;">' . $v->website . '</td>
                    <td style="text-align:center;">' . $v->ghichu . '</td>
                    <td style="text-align:center;">
                        <a href=' . url('/') . "/admin/huyen/edit/" . $v->id . ' class="btn btn-warning"> Sửa</a>
                        <a href=' . url('/') . "/admin/huyen/edit/" . $v->id . ' class="btn btn-danger" onclick="return confirmAction();"> Xóa</a>
                    </td>
                </tr>';
                $stt++;
            }
            echo json_encode($output);
        }
    }

    public function getHuyenById(Request $request)
    {
        $data = huyen::where('id_tinh', $request->tinh)->get()->toArray();
        echo '<option value="">Chọn huyện</option>';
        foreach ($data as $v) {
            echo ' <option value="' . $v['id'] . '">' . $v['ten'] . '</option>';
        }
    }

    public function addHuyenChiTiet()
    {
        $data = tinh::all();
        return view('backend.addHuyenchitiet', compact('data'));
    }
    public function PostaddHuyenChiTiet(request $request)
    {
        $request->validate([
            'id_huyen' => 'required',
        ], [
            'id_huyen.required' => 'Nhập đúng tên huyện',
        ]);

        $value = $request->id_huyen;
        $arr = explode('-', $value);
        $value = $arr[count($arr) - 1];
        $value2 = $arr[0];
        $data1 = huyen::where('ten', $value)->orWhere('mabc', $value2)->firstOrFail();

        $data = $request->only('doi_tuong_gan', 'ten', 'mabc', 'data1', 'data2', 'data3', 'data4', 'data5');
        $data['id_huyen'] = $data1->id;
        chitiet::create($data);
        return redirect('admin/huyenchitiet');
    }
    public function editHuyenChiTiet($id)
    {
        $chitiet = chitiet::where('mabc', $id)->firstOrFail();
        return view('backend.editHuyenchitiet', compact('chitiet'));
    }
    public function postEditHuyenChiTiet($id, request $request)
    {
        $request->validate([
            'id_huyen' => 'required',
        ], [
            'id_huyen.required' => 'Nhập đúng tên huyện',
        ]);

        $value = $request->id_huyen;
        $arr = explode('-', $value);
        $value = $arr[count($arr) - 1];
        $value2 = $arr[0];
        $data1 = huyen::where('ten', $value)->orWhere('mabc', $value2)->firstOrFail();

        $chitiet = chitiet::where('mabc', $id)->firstOrFail();
        $data = $request->only('doi_tuong_gan', 'ten', 'mabc', 'data1', 'data2', 'data3', 'data4', 'data5');
        $data['id_huyen'] = $data1->id;


        $chitiet->update($data);
        return redirect('admin/doi-tuong-gan-ma');
    }
    public function deleteHuyenChiTiet($id)
    {
        chitiet::where('mabc', $id)->delete();
        return redirect('admin/huyenchitiet');
    }


    //Tỉnh chi tiết
    public function getTinhChiTiet(request $request)
    {
        if (isset($request->search)) {

            $value = $request->search;
            $arr = explode('-', $value);
            $value = $arr[count($arr) - 1];
            $value2 = $arr[0];
            // $chitiets= DB::select("select * from bc_chitiet ,bc_tinh_chitiet where bc_chitiet.ten LIKE ? OR bc_tinh_chitiet.ten LIKE ?", [$serach,$serach]);
            // dd($chitiets);
            // $chitiethuyen=chitiet::where('ten','LIKE',"%".$serach."%")->orWhere('mabc','LIKE',"%".$serach."%")->paginate(20);
            $chitiets = TinhChitiet::where('ten_eng', 'LIKE', "%" . $value . "%")->orWhere('mabc', 'LIKE', "%" . $value2 . "%")->paginate(20);
        } else {
            //$chitiethuyen=
            $chitiets = TinhChitiet::with('tinh')->paginate(20);
            // dd($chitiets[0]->toArray());
        }
        return view('backend.tinhchitiet', compact('chitiets'));
    }
    public function editTinhChiTiet($id)
    {
        $chitiet = TinhChitiet::where('mabc', $id)->firstOrFail();
        // dd($chitiet);
        return view('backend.editTinhchitiet', compact('chitiet'));
    }
    public function postEditTinhChiTiet($id, request $request)
    {
        $request->validate([
            'id_tinh' => 'required',
        ], [
            'id_tinh.required' => 'Hãy nhập tên tỉnh',
        ]);

        $value = $request->id_tinh;
        $arr = explode('-', $value);
        $value = $arr[count($arr) - 1];
        $value2 = $arr[0];
        $data1 = tinh::where('ten', $value)->orWhere('mabc', $value2)->firstOrFail();

        $chitiet = TinhChitiet::where('mabc', $id)->firstOrFail();
        $data = $request->only('dt_gan_ma', 'ten', 'ten_eng', 'mabc', 'data1', 'data2', 'data3', 'data4', 'data5');
        $data['id_tinh'] = $data1->id;
        // dd($data);
        $chitiet->update($data);
        return redirect('admin/doi-tuong-gan-ma');
    }
    public function addTinhChiTiet()
    {
        return view('backend.addTinhchitiet');
    }
    public function PostaddTinhChiTiet(request $request)
    {
        $tinh = $request->tinh;
        $huyen = $request->huyen;


        if ($tinh != null && $huyen == null) {
            $mabc = TinhChitiet::where('mabc', $request->mabc)->get();
            if (count($mabc) > 0) {
                return redirect()->back()->with('loi', 'Mã bưu chính đã tồn tại');
            }
            $data = $request->only('dt_gan_ma', 'ten', 'ten_eng', 'mabc', 'data1', 'data2', 'data3', 'data4', 'data5');
            $data['id_tinh'] = $tinh;
            TinhChitiet::create($data);
        } elseif ($tinh != null && $huyen != null) {
            $mabc = chitiet::where('mabc', $request->mabc)->get();
            if (count($mabc) > 0) {
                return redirect()->back()->with('loi', 'Mã bưu chính đã tồn tại');
            }
            $data = $request->only('doi_tuong_gan', 'ten', 'mabc', 'data1', 'data2', 'data3', 'data4', 'data5');
            $data['id_huyen'] = $huyen;
            chitiet::create($data);
        }
        return redirect('admin/huyenchitiet');
    }
    public function deleteTinhChiTiet($id)
    {
        TinhChitiet::where('mabc', $id)->delete();
        return redirect('admin/huyenchitiet');
    }
}
