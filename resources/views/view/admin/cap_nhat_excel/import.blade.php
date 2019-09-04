@extends('layout.backend.masterLayout')
@section('content')

<!-- Start Main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <!-- Start đường dẫn -->
    <div class="row" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active"> Cập nhật excel</li>
        </ol>
    </div> <!-- End đường dẫn -->

    <!-- Start Content -->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;"><b>CẬP NHẬT EXCEL</b></div>
                <div class="panel-body">
                    <button data-toggle="modal" data-target="#import_file" class="btn btn-primary" role="button"><i class="fa fa-file-import"></i> Cập nhật bằng excel</button>
                    <!------------------Modal box --------------------------------->
                    <div id="import_file" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3 class="modal-title" style="color: green;text-align: center;"><b>NHẬP FILE EXEL</b></h3>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.import_excel')}}" enctype="multipart/form-data" method="post">
                                        @csrf
                                        <label for="">Chọn file :</label>
                                        <input type="file" name="select_file" value="Chọn file" class="form-control" placeholder="Chọn file" required="required"><br>
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-upload" style="padding-right:5px"></i>OK</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Sau khi đẩy file Excel lên để cập nhật
                    kiểm tra lỗi hoặc thành công từ controller-->
                    @if(count($errors)>0)
                    <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @foreach($errors->all() as $err)
                        {{$err}} <br>
                        @endforeach
                    </div>
                    @endif

                    <!-- Kiểm tra lỗi import excel -->
                    @if(isset($error))
                    <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>Cập nhật thất bại</h5>
                        {{$error}}
                    </div>
                    @endif 

                    <!-- In ra array -->
                    @if(isset($dataExcel))
                    {{print_r($dataExcel)}}
                    
                    @endif

                    <!-- In ra array -->
                    @if(isset($sua))
                    {{$sua}}
                    @endif

                    <!-- In ra array -->
                    @if(isset($huyen))
                    {{$huyen}}
                    @endif

                    <!-- In ra array -->
                    @if(isset($arrDb))
                        @if(is_array($arrDb)) 
                        {{
                            print_r($arrDb)
                        }}
                        @else
                        {{
                            $arrDb
                        }}
                        @endif
                    @endif
                    <!-- In ra array -->
                    @if(isset($count))
                        @if(is_array($count)) 
                        {{
                            print_r($count)
                        }}
                        @else
                        {{
                            $count
                        }}
                        @endif
                    @endif

                    <!-- @if(isset($arraydata))
                        <h1>dkm</h1>
                    @endif -->
                    <!-- @if(Session::has('thanhcong'))
                   
                    <!-- {{Session::get('thanhcong')}} -->
                    <!-- <div class="alert alert-success">{{Session::get('thanhcong')}}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div> -->
                    <!-- @endif --> 
                    <!---------------------------------------------------------->

                </div>
            </div>
        </div>
    </div> <!-- End Content -->

</div> <!--End Main-->

@endsection