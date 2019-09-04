<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Pagination\LengthAwarePaginator;

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


use Auth;
use Session;
use Hash;

use App\Lib\CheckMbc;
use App\Lib\ConvertAndUnicode;
use App\Rules\CheckMbcExist;

class TinhController extends Controller
{


    private $convert;
    private $checkMbc;

    public function __construct()
    {
        $this->convert = new ConvertAndUnicode();
        $this->checkMbc = new CheckMbc();
    }

    /**
     * Lấy data Tỉnh
     */
    public function getTinh(request $request)
    {
        if (isset($request->search)) {

            $value = $request->search;
            $arr = explode('-', $value);
            $value1 = $arr[count($arr) - 1];
            $value2 = $arr[0];
            $arrTinh = tinh::where('mabc', 'LIKE', "%" . $value2 . "%")
                ->orWhere('mabc', $value2)->paginate(20);
        } else {
            $arrTinh = Tinh::orderBy('id', 'asc')
                ->paginate(20);
        }
        return view('view.admin.cap_nhat_thu_cong.tinh')->with('arrTinh', $arrTinh);
    }

    /**
     * Thêm Tỉnh
     */
    public function addTinh()
    {
        return view('view.admin.cap_nhat_thu_cong.addTinh');
    }

    /**
     * Thêm mới 1 Tỉnh
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


    /**
     * Sửa Tỉnh
     */
    public function editTinh($id)
    {
        $tinh = tinh::findORFail($id);
        return view('view.admin.cap_nhat_thu_cong.editTinh', compact('tinh'));
    }

    /**
     * Sửa 1 Tỉnh
     */
    public function postEditTinh($id, request $request)
    {
        // check mbc đã tồn tại    
        $mbcOld = (int) $request->mbc_old;
        $mbc    = (int) $request->mbc;
        if ($mbc != $mbcOld) {
            $validator = $this->validate(
                $request,
                [
                    'mbc'   => new CheckMbcExist,
                ]
            );
        }

        $id = $request->id;
        $ten = $request->ten;
        $teneng = $this->convert->toHop2DungSan($ten);
        $teneng = $this->convert->convert_vi_to_en($teneng);
        $tinh = [
            'ten'       => $ten,
            'ten_eng'   => $teneng,
            'mbc'       => $request->mbc,
            'dienthoai' => $request->dienthoai,
            'diachi'    => $request->diachi,
            'email'     => $request->email,
            'website'   => $request->website,
            'ghichu'    => $request->ghichu
        ];

        // dd($tinh);

        DB::table('bc_tinh')
            ->where('id', $id)
            ->update($tinh);

        $diary = new nhatky();
        $diary->name = Auth::user()->name;
        $diary->email = Auth::user()->email;
        $diary->action = 'Cập nhât: ' . $request->ten . ' - mã: ' . $request->mbc;
        $diary->save();

        return redirect('admin/tinh');
    }

    /**
     * Xóa 1 Tỉnh
     */
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

    /**
     * 
     */
    function doiDauSoDonViCon($mbcTinh) {

    }
}
