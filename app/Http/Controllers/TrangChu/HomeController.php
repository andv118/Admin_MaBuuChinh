<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Models\tinh;
use App\Models\huyen;
use App\Models\chitiet;
use App\Models\TinhChitiet;
use function GuzzleHttp\json_encode;

class homeController extends Controller
{
    public function getIndex()
    {
        return view('frontend.index');
    }
    public function getGt()
    {
        return view('frontend.about');
    }
    public function getVb()
    {
        return view('frontend.vb');
    }
    public function getHd()
    {
        return view('frontend.hd');
    }
    public function postSearch(Request $request)
    {
        $value = $request->input_timKiem;
        $arr = explode('-', $value);
        $value = $arr[count($arr) - 1];
        $value2 = $arr[0];
        $data = tinh::where('ten', $value)->orWhere('mabc', $value2)->get();

        if ($data->count() > 0) {
            $TinhChitiet = $data[0]->tinh_chitiet()->paginate(10);
            // dd($TinhChitiet);
            $TinhChitiet->appends(['_token' => $request->_token, 'input_timKiem' => $request->input_timKiem, 'btn_timKiem' => $request->btn_timKiem]);
            return view('frontend.searchMBC', compact('data', 'TinhChitiet'));
        }
        $data2 = huyen::where('ten', $value)->orWhere('mabc', $value2)->get();
        if ($data2->count() > 0) {
            // dd($data2[0]->chitiet->toArray());
            $Chitiet = $data2[0]->chitiet()->paginate(10);
            $Chitiet->appends(['_token' => $request->_token, 'input_timKiem' => $request->input_timKiem, 'btn_timKiem' => $request->btn_timKiem]);
            return view('frontend.searchMBC', compact('data2', 'Chitiet'));
        }
        $data3 = chitiet::where('ten', $value)->orWhere('mabc', $value2)->get();
        if ($data3->count() > 0) {
            return view('frontend.searchMBC', compact('data3'));
        }
        $data4 = TinhChitiet::where('ten', $value)->orWhere('mabc', $value2)->get();
        if ($data4->count() > 0) {
            return view('frontend.searchMBC', compact('data4'));
        }
        echo "Khong tim thay ket qua";
    }
    public function handleAjax(Request $request)
    {
        if ($request->get('query')) {
            $value = $request->get('query');
            $TinhChitiet = TinhChitiet::where('ten', 'LIKE', '%' . $value . '%')->orWhere('mabc', 'LIKE', '%' . $value . '%')->select('ten', 'mabc');
            $chitiet = chitiet::where('ten', 'LIKE', '%' . $value . '%')->orWhere('mabc', 'LIKE', '%' . $value . '%')->select('ten', 'mabc');
            $huyens = huyen::where('ten', 'LIKE', '%' . $value . '%')->orWhere('mabc', 'LIKE', '%' . $value . '%')->select('ten', 'mabc');
            $data = tinh::where('ten', 'LIKE', '%' . $value . '%')->orWhere('mabc', 'LIKE', '%' . $value . '%')->select('ten', 'mabc')->union($huyens)->union($TinhChitiet)->union($chitiet)->limit(10)->get();
            $output = '<ul id="mbc-list">';

            foreach ($data as $row) {
                $output .= '<li class="autocomplete" menu-item> <a id="id-91" tabindex="-1" class="ui-menu-item-wrapper">' . $row->mabc . '-' . $row->ten . '</a> </li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function handleAjax2(Request $request)
    {
        if ($request->get('id') && $request->get('donvi') == 'tinh') {
            $id = $request->get('id');
            $data = tinh::with(['huyens', 'tinh_chitiet'])->where('id', $id)->get();
            return response()->json($data->toArray());
        }
        if ($request->get('id') && $request->get('donvi') == 'huyen') {
            $id = $request->get('id');
            $data = huyen::with('chitiet')->where('id', $id)->get();
            return response()->json($data->toArray());
        }
        if ($request->get('id') && $request->get('donvi') == 'tinh_chitiet') {
            $id = $request->get('id');
            $data = TinhChitiet::where('id', $id)->get();
            return response()->json($data->toArray());
        }
        if ($request->get('id') && $request->get('donvi') == 'huyen_chitiet') {
            $id = $request->get('id');
            $data = chitiet::where('id', $id)->get();
            return response()->json($data->toArray());
        }
    }
    public function handleAjax3(Request $request)
    {
        if ($request->get('query')) {
            $value = $request->get('query');
            $data = [];
            $data['tinh'] = tinh::where('ten', 'LIKE', '%' . $value . '%')->get();
            $data['huyen'] = huyen::where('ten', 'LIKE', '%' . $value . '%')->get();
            $data['chitiet'] = chitiet::where('ten', 'LIKE', '%' . $value . '%')->get();
            $data['tinhchitiet'] = TinhChitiet::where('ten', 'LIKE', '%' . $value . '%')->get();
            return response()->json($data);
        }
        if ($request->get('query') == "") {
            $data = [];
            $data['tinh'] = tinh::get();
            return response()->json($data);
        }
    }
}
