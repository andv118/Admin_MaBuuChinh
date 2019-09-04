@extends('layout.admin.adminMaster')
@section('content')
<script src="/plugins/ckeditor/ckeditor.js"></script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <!-- Title -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Thêm Tỉnh / Thành phố</h3>
        </div>
    </div>
    <!--End Title -->

    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <!-- Form -->
            <form class="col-sm-8 form-horizontal col-sm-offset-2" method="POST" action="{{Route('Admin.create_tinh')}}">
                @csrf
                <!-- <h3><b>Thêm thông tin tỉnh</b></h3> -->

                <!-- ID -->
                <div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
                    <label for="mst" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-8">
                        <input name="id" value="{{ old('id') }}" type="text" class="form-control" id="mst" placeholder="ID">
                        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div> <!-- End ID -->

                <!-- Ten -->
                <div class="form-group {{ $errors->has('ten') ? 'has-error' : ''}}">
                    <label for="CMT" class="col-sm-2 control-label">Tên</label>
                    <div class="col-sm-8">
                        <input name="ten" value="{{ old('ten') }}" type="text" class="form-control" id="address" placeholder="Tên">
                        {!! $errors->first('ten', '<p class="help-block">:message</p>') !!}
                    </div>
                </div> <!-- End Ten -->

                <!-- Mbc -->
                <div class="form-group {{ $errors->has('mbc') ? 'has-error' : ''}}">
                    <label for="name" class="col-sm-2 control-label">Mã bưu chính</label>
                    <div class="col-sm-8">
                        <input name="mbc" value="{{ old('mbc') }}" type="text" class="form-control" id="name" placeholder="Mã">
                        {!! $errors->first('mbc', '<p class="help-block">:message</p>') !!}
                    </div>
                </div> <!-- End Mbc -->

                <!-- DienThoai -->
                <div class="form-group {{ $errors->has('dienthoai') ? 'has-error' : ''}}">
                    <label for="phoneNumber" class="col-sm-2 control-label">Điện thoại</label>
                    <div class="col-sm-8">
                        <input name="dienthoai" value="{{ old('dienthoai') }}" type="text" class="form-control" id="phoneNumber" placeholder="Điện thoại">
                        {!! $errors->first('dienthoai', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <!--End DienThoai -->

                <!-- DiaChi -->
                <div class="form-group {{ $errors->has('diachi') ? 'has-error' : ''}}">
                    <label for="email" class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-8">
                        <input name="diachi" value="{{ old('diachi') }}" type="text" class="form-control" id="email" placeholder="Địa chỉ">
                        {!! $errors->first('diachi', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <!--End DiaChi -->

                <!-- Email -->
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for="addressTd" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input name="email" value="{{ old('email') }}" type="text" class="form-control" id="addressTd" placeholder="Email">
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                </div> <!-- End Email -->

                <!-- Website -->
                <div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
                    <label class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-8">
                        <input name="website" value="{{ old('website') }}" type="text" class="form-control" placeholder="Website">
                        {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                    </div>
                </div> <!-- End Website -->

                <!-- GhiChu -->
                <div class="form-group {{ $errors->has('ghichu') ? 'has-error' : ''}}">
                    <label class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <input name="ghichu" value="{{ old('ghichu') }}" type="text" class="form-control" placeholder="Ghi chú">
                        {!! $errors->first('ghichu', '<p class="help-block">:message</p>') !!}
                    </div>
                </div> <!-- End GhiChu -->

                <!-- Submit -->
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                        <button type="submit" class="btn btn-success" style="width:200px">Thêm</button>
                    </div>
                </div>
                <!--End Submit -->

            </form>
            <!--End Form -->
        </div>
    </div>

</div>
<!--end main-->
@endsection
