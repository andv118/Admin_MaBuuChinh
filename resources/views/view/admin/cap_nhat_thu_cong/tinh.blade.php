@extends('layout.admin.adminMaster')
@section('content')

<!--Main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <!-- Link -->
    <div class="row" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Tỉnh, Thành phố và các đơn vị tương đương</li>
        </ol>
    </div>
    <!--End Link -->


    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <!-- Heading -->
                <div class="panel-heading" style="text-align: center;"><b><i class="fas fa-list-alt"></i> DANH SÁCH TỈNH VÀ CÁC ĐƠN VỊ TƯƠNG ĐƯƠNG</b>
                </div> <!-- End Heading -->

                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">

                            <a class="btn btn-success " href="{{route('Admin.add_tinh')}}" role="button"><i class="fa fa-plus"></i> Thêm Tỉnh / Thành phố</a>

                            <!-- Error -->
                            @if(count($errors)>0)
                            <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                @foreach($errors->all() as $err)
                                {{$err}} <br>
                                @endforeach
                            </div>
                            @endif
                            <!--End Error -->

                            <!-- Success -->
                            @if(Session::has('thanhcong'))
                            <div class="alert alert-success">{{Session::get('thanhcong')}}
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            </div>
                            @endif
                            <!--End Success -->

                            <!---------------------- Table ----------------------->
                            <table class="table table-bordered table-responsive table-hover table-condensed" style="margin-top:20px;">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Mã bưu chính</th>
                                        <th>Điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Ghi chú</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($arrTinh as $tinh)
                                    <tr>
                                        <td>{{$tinh->id}}</td>
                                        <td>{{$tinh->ten}}</td>
                                        <td>{{$tinh->mbc}}</td>
                                        <td>{{$tinh->dienthoai}}</td>
                                        <td>{{$tinh->diachi}}</td>
                                        <td>{{$tinh->email}}</td>
                                        <td>{{$tinh->website}}</td>
                                        <td>{{$tinh->ghichu}}</td>
                                        <td>
                                            <a href="{{ Route('Admin.edit_tinh', $tinh->id )}}" class="btn btn-warning"> Sửa</a>
                                            <a href="{{ Route('Admin.delete_tinh', $tinh->id )}}" class="btn btn-danger" onclick="return confirmAction()"> Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> <!-- End Table -->

                            {{$arrTinh->links()}}

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Main-->

<script>
    function confirmAction() {
        return confirm("Bạn có chắc chắn muốn xóa");
    }
</script>
@endsection