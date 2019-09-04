<?php

namespace App\Http\Controllers\Backend;
use App\Models\tinh;
use App\Models\huyen;
use App\Models\TinhChitiet;
use App\Models\chitiet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HandleAjax extends Controller
{
    public function ajaxTinh(request $request){
        if($request->get('query')){
            $value=$request->get('query');
            $data=tinh::where('ten_eng','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('id','ten','mabc')->limit(10)->get();
                $output = '<ul id="mbc-list">';
                
            foreach($data as $row)
            {
               $output .= '<li class="autocomplete" menu-item> <a id="id-91" tabindex="-1" class="ui-menu-item-wrapper">'.$row->mabc.'-'.$row->ten.'</a> </li>';
           }
           $output .= '</ul>';
           echo $output;

            }
    }
    public function ajaxHuyen(request $request){
        if($request->get('query')){
            $value=$request->get('query');
            $data=huyen::where('ten_eng','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('id','ten','mabc')->limit(10)->get();
                $output = '<ul id="mbc-list">';
                
            foreach($data as $row)
            {
               $output .= '<li class="autocomplete" menu-item> <a id="id-91" tabindex="-1" class="ui-menu-item-wrapper">'.$row->mabc.'-'.$row->ten.'</a> </li>';
           }
           $output .= '</ul>';
           echo $output;

            }
    }
    public function ajaxSearch(Request $request){
        if($request->get('query')){
            $value=$request->get('query');
            $TinhChitiet=TinhChitiet::where('ten_eng','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc');
            $chitiet=chitiet::where('ten_eng','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc');
            $huyens=huyen::where('ten_eng','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc');
            $data=tinh::where('ten_eng','LIKE','%'.$value.'%')->orWhere('mabc','LIKE','%'.$value.'%')->select('ten','mabc')->union($huyens)->union($TinhChitiet)->union($chitiet)->limit(20)->get();
                $output = '<ul id="mbc-list" style="padding:2px;">';
                
            foreach($data as $row)
            {
               $output .= '<li class="autocomplete" menu-item> <a id="id-91" tabindex="-1" class="ui-menu-item-wrapper" style="font-size:12px;padding:3px 2px 3px .4em;">'.$row->mabc.' - '.$row->ten.'</a> </li>';
           }
           $output .= '</ul>';
           echo $output;

            }
    }
    
}