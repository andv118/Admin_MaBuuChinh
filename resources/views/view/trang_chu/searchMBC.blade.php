@extends('layout.frontend.master')
@section('content')
<div class="container" >
        <div class="row margin0" style="margin: 30px 0">
            <div class="col-lg-12 padding0">
                    <form action="{{route('search')}}" method="get">
                            @csrf
                            <div class="row margin0 tk-input">
                                <div class="MBC-input-search">
                                    <input autocomplete="off" id="input_timKiem"type="text" name="input_timKiem" class="form-control" />
                                    
                                </div>
                                <input id="btn_timKiem" type="submit" name="btn_timKiem" value="Tìm kiếm" class="btn MBC-button" />
                            </div> <!-- End tim kiem -->
                            
                        </form>
            </div>
            <div class="col-lg-9 col-lg-offset-2 tim-kiem">
                        
                    <div class="list-mbc2">
                        <div class="danh-sach-mbc" style="display: none">
                            <div>
                    </div>
                </div>
        </div>
        @if (isset($data))
            <div class='detailLV1' >
                <h4><span id="ctl00_ctl06_rptMBC_ctl00_MBC_POSTCODE">{{$data[0]->mabc}}</span> - <span id="ctl00_ctl06_rptMBC_ctl00_MBC_Name">{{$data[0]->ten}}</span></h4>
                <div class="subDetail">
                    <div class="detailPanel"><i class="fa fa-phone" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl00_MBC_PHONE">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-map-marker" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl00_MBC_LOCATION">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-location-arrow" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl00_Label1">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-envelope" aria-hidden="true" style="width:20px; margin-top: 2px;margin-bottom: 3px"></i><span id="ctl00_ctl06_rptMBC_ctl00_Label2">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-link" aria-hidden="true" style="width:20px"></i><a href="http://gialai.gov.vn" target="_blank"><span id="ctl00_ctl06_rptMBC_ctl00_Label3">http://gialai.gov.vn</span></a></div>
                </div>
            </div>
            
                
            
            
            @foreach ($TinhChitiet as $tinh_chitiet)
            {{--  @foreach ($huyen as $chitiet)  --}}
            <div class='detailLV2' >
                    <h4><span id="ctl00_ctl06_rptMBC_ctl01_MBC_POSTCODE">{{$tinh_chitiet->mabc}}</span> - <span id="ctl00_ctl06_rptMBC_ctl01_MBC_Name">{{$tinh_chitiet->ten}}</span></h4>
                    <div class="subDetail">
                        <div class="detailPanel"><i class="fa fa-phone" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_PHONE">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-map-marker" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_LOCATION">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-location-arrow" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label1">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-envelope" aria-hidden="true" style="width:20px; margin-top: 2px;margin-bottom: 3px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label2">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-link" aria-hidden="true" style="width:20px"></i><a href="#" target="_blank"><span id="ctl00_ctl06_rptMBC_ctl01_Label3">Đang cập nhật</span></a></div>
                    </div>
                </div>
            {{--  @endforeach  --}}
        @endforeach
        <div class="text-center pagination" style="margin-bottom: 20px">
            
            {{$TinhChitiet->links()}}
        
</div>
        @endif
        @if (isset($data2))
        <div class='detailLV1' >
                <h4><span id="ctl00_ctl06_rptMBC_ctl00_MBC_POSTCODE">{{$data2[0]->mabc}}</span> - <span id="ctl00_ctl06_rptMBC_ctl00_MBC_Name">{{$data2[0]->ten}}</span></h4>
                <div class="subDetail">
                    <div class="detailPanel"><i class="fa fa-phone" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl00_MBC_PHONE">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-map-marker" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl00_MBC_LOCATION">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-location-arrow" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl00_Label1">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-envelope" aria-hidden="true" style="width:20px; margin-top: 2px;margin-bottom: 3px"></i><span id="ctl00_ctl06_rptMBC_ctl00_Label2">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-link" aria-hidden="true" style="width:20px"></i><a href="http://gialai.gov.vn" target="_blank"><span id="ctl00_ctl06_rptMBC_ctl00_Label3">http://gialai.gov.vn</span></a></div>
                </div>
            </div>
            @foreach ($Chitiet as $chitiet)
            {{--  @foreach ($huyen as $chitiet)  --}}
            <div class='detailLV2' >
                    <h4><span id="ctl00_ctl06_rptMBC_ctl01_MBC_POSTCODE">{{$chitiet->mabc}}</span> - <span id="ctl00_ctl06_rptMBC_ctl01_MBC_Name">{{$chitiet->ten}}</span></h4>
                    <div class="subDetail">
                        <div class="detailPanel"><i class="fa fa-phone" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_PHONE">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-map-marker" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_LOCATION">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-location-arrow" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label1">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-envelope" aria-hidden="true" style="width:20px; margin-top: 2px;margin-bottom: 3px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label2">Đang cập nhật</span></div>
                        <div class="detailPanel"><i class="fa fa-link" aria-hidden="true" style="width:20px"></i><a href="#" target="_blank"><span id="ctl00_ctl06_rptMBC_ctl01_Label3">Đang cập nhật</span></a></div>
                    </div>
                </div>
            {{--  @endforeach  --}}
        @endforeach
        <div class="text-center pagination" style="margin-bottom: 20px">
            
            {{$Chitiet->links()}}
        
        </div>
        @endif
        @if (isset($data3))
        <div class='detailLV2' >
                <h4><span id="ctl00_ctl06_rptMBC_ctl01_MBC_POSTCODE">{{$data3[0]->mabc}}</span> - <span id="ctl00_ctl06_rptMBC_ctl01_MBC_Name">{{$data3[0]->ten}}</span></h4>
                <div class="subDetail">
                    <div class="detailPanel"><i class="fa fa-phone" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_PHONE">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-map-marker" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_LOCATION">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-location-arrow" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label1">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-envelope" aria-hidden="true" style="width:20px; margin-top: 2px;margin-bottom: 3px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label2">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-link" aria-hidden="true" style="width:20px"></i><a href="#" target="_blank"><span id="ctl00_ctl06_rptMBC_ctl01_Label3">Đang cập nhật</span></a></div>
                </div>
            </div>
        @endif
        @if (isset($data4))
        <div class='detailLV2' >
                <h4><span id="ctl00_ctl06_rptMBC_ctl01_MBC_POSTCODE">{{$data4[0]->mabc}}</span> - <span id="ctl00_ctl06_rptMBC_ctl01_MBC_Name">{{$data4[0]->ten}}</span></h4>
                <div class="subDetail">
                    <div class="detailPanel"><i class="fa fa-phone" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_PHONE">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-map-marker" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_MBC_LOCATION">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-location-arrow" aria-hidden="true" style="width:20px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label1">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-envelope" aria-hidden="true" style="width:20px; margin-top: 2px;margin-bottom: 3px"></i><span id="ctl00_ctl06_rptMBC_ctl01_Label2">Đang cập nhật</span></div>
                    <div class="detailPanel"><i class="fa fa-link" aria-hidden="true" style="width:20px"></i><a href="#" target="_blank"><span id="ctl00_ctl06_rptMBC_ctl01_Label3">Đang cập nhật</span></a></div>
                </div>
            </div>
        @endif
            
            
        
        
    </div>
    </div>
        </div>
    
@endsection