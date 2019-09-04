@extends('layout.frontend.master')
@section('content')
<div class="row margin0">
    <div id="ctl00_DefaultZone">
        <div class="container text-center">
            <img class="logo" src="imgs/logobotttt.jpg" alt="logo" />
            <h1 class="TitleMBC" style="font-family: inherit">MÃ BƯU CHÍNH QUỐC GIA VIỆT NAM</h1>
            <div class="row">
                <div class="col-lg-9 col-lg-offset-2 tim-kiem-input">
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
                        
                    <div class="list-mbc">
                        
                        <div id="download-mbc" style="display:block">
                            <a download href="Images/danhbamabuuchinhquocgia.pdf">Tải về bộ mã tại đây</a>
                        </div> <!-- End tai ve bo ma -->
                        <div class="danh-sach-mbc" style="display: none">
                                <div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection