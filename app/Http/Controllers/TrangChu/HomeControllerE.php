<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\tinh;
use App\Models\huyen;
use App\Models\chitiet;
use App\Models\TinhChitiet;
class homeControllerE extends Controller
{
    public function getIndex(){
        return view('frontendE.index');
    }
    public function getGt(){
        return view('frontendE.about');
    }
    public function getVb(){
        return view('frontendE.vb');
    }
    public function getHd(){
        return view('frontendE.hd');
    }
    public function postSearch(Request $request){
        $value=$request->input_timKiem;
        $arr=explode('-',$value);
        $value=$arr[count($arr)-1];
        $value2=$arr[0];
        $data=tinh::where('ten',$value)->orWhere('mabc',$value2)->get();
        
        if($data->count()>0){
            $TinhChitiet=$data[0]->tinh_chitiet()->paginate(10);
            // dd($TinhChitiet);
            $TinhChitiet->appends(['_token'=>$request->_token,'input_timKiem'=>$request->input_timKiem,'btn_timKiem'=>$request->btn_timKiem]);
                return view('frontendE.searchMBC',compact('data','TinhChitiet'));
             }
        $data2=huyen::where('ten',$value)->orWhere('mabc',$value2)->get();
        if($data2->count()>0){
            $Chitiet=$data2[0]->chitiet()->paginate(10);
            $Chitiet->appends(['_token'=>$request->_token,'input_timKiem'=>$request->input_timKiem,'btn_timKiem'=>$request->btn_timKiem]);
            return view('frontendE.searchMBC',compact('data2','Chitiet'));
        }
        $data3=chitiet::where('ten',$value)->orWhere('mabc',$value2)->get();
        if($data3->count()>0) {
            return view('frontendE.searchMBC',compact('data3'));
        }
        $data4=TinhChitiet::where('ten',$value)->orWhere('mabc',$value2)->get();
        if($data4->count()>0){
            return view('frontendE.searchMBC',compact('data4'));
        }
        echo "Khong tim thay ket qua";


    }
    public function handleAjax(Request $request){
        if($request->get('query')){
            $value=$request->get('query');
            $TinhChitiet=TinhChitiet::where('ten','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc');
            $chitiet=chitiet::where('ten','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc');
            $huyens=huyen::where('ten','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc');
            $data=tinh::where('ten','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc')->union($huyens)->union($TinhChitiet)->union($chitiet)->limit(10)->get();
                $output = '<ul id="mbc-list">';
                
            foreach($data as $row)
            {
               $output .= '<li class="autocomplete" menu-item> <a id="id-91" tabindex="-1" class="ui-menu-item-wrapper">'.$row->mabc.'-'.$row->ten.'</a> </li>';
           }
           $output .= '</ul>';
           echo $output;

            }
        }
}
