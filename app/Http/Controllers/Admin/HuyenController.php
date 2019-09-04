<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

class HuyenController extends Controller
{
    /**
     * Lấy data Huyện
     */
    public function getHuyen(request $request)
    {

        $arrTinh = Tinh::orderBy('id', 'asc')->get();
        $idTinhFirst = $arrTinh[0]->id;
        $data = Huyen::where('id_tinh', $idTinhFirst)
            ->orderBy('id_tinh', 'asc')->paginate(20);

        return view('view.admin.cap_nhat_thu_cong.huyen')->with([
            'arrTinh' => $arrTinh,
            'data' => $data
        ]);
    }

    /**
     * Lọc Huyện theo Tỉnh
     */
    function getHuyenFilter(Request $request)
    {
        // if ($request->ajax()) {
        //     // if (isset($request->fillter_huyen)) {
        //     $idTinh = $request->get('fillter_huyen');
        //     // $data = Huyen::where('id_tinh', $idTinh)
        //     //     ->orderBy('id_tinh', 'asc')->paginate(20);
        //     $data = "123ok";

        //     return view('view.admin.cap_nhat_thu_cong.huyen')->with(['data' => $data])->render();
        //     // }
        // }

        $data = "123ok";
        return view('view.admin.cap_nhat_thu_cong.huyen')->with(['data' => $data])->render();
    }

    /**
     * Sửa 1 Huyện
     */
    public function editHuyen($id)
    {
        $huyen = huyen::findORFail($id);
        return view('view.admin.cap_nhat_thu_cong.editHuyen', compact('huyen'));
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
        return view('view.admin.cap_nhat_thu_cong.addHuyen');
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
}
