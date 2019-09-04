@extends('layout.admin.adminMaster')
@section('content')

<script src="/plugins/ckeditor/ckeditor.js"></script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Sửa Tỉnh / Thành phố và các đơn vị tương đương</h3>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <form class="col-sm-8 form-horizontal col-sm-offset-2" method="POST" action="{{Route('Admin.update_tinh', $tinh->id)}}">
                @csrf
                <!-- <h3 style="text-align: center;"><b>Sửa thông tin</b></h3> -->
                <!-- ID -->
                <div class="form-group" style="display:none">
                    <label for="mst" class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-8">
                        <input disabled="true" name="id" value="{{$tinh->id}}" class="form-control" id="mst" placeholder="ID" required>
                    </div>
                </div>
                <!--End ID -->

                <!-- Tên -->
                <div class="form-group">
                    <label for="CMT" class="col-sm-2 control-label">Tên</label>
                    <div class="col-sm-8">
                        <input name="ten" type="text" value="{{$tinh->ten}}" class="form-control" id="ten" placeholder="Tên" required>
                    </div>
                </div> <!-- End Tên -->

                <!-- Mã -->
                <div class="form-group {{ $errors->has('mbc') ? 'has-error' : ''}}">
                    <label for="name" class="col-sm-2 control-label">Mã bưu chính</label>
                    <div class="col-sm-8">
                        <input name="mbc" value="{{old('mbc', $tinh->mbc)}}" class="form-control" id="name" placeholder="Mã" type="text" required pattern="([0-9]{2})|([0-9]{2} - [0-9]{2})" title="Mã tỉnh có dạng: xx hoặc xx - yy / vd: 10 hoặc 10 - 14">
                        {!! $errors->first('mbc', '<p class="help-block">:message</p>') !!}
                        <!-- mbc cũ -->
                        <input name="mbc_old" value="{{ $tinh->mbc, old('mbc') }}" type="hidden" class="form-control" id="name" placeholder="Mã cũ" required>
                    </div>
                </div> <!-- End Mã -->

                <!-- Điện Thoại -->
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-2 control-label">Điện thoại</label>
                    <div class="col-sm-8">
                        <input name="dienthoai" type="text" class="form-control" id="phoneNumber" placeholder="Điện thoại" value="{{$tinh->dienthoai}}">
                    </div>
                </div> <!-- End Điện Thoại -->

                <!-- Địa Chỉ -->
                <div class="form-group">
                    <label for="addressTd" class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-8">
                        <input name="diachi" type="text" class="form-control" id="addressTd" placeholder="Địa chỉ" value="{{$tinh->diachi}}">
                    </div>
                </div> <!-- End Địa Chỉ -->

                <!-- Email -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input name="email" type="text" class="form-control" placeholder="Email" value="{{$tinh->email}}">
                    </div>
                </div> <!-- End Email -->

                <!-- Website -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-8">
                        <input name="website" type="text" class="form-control" placeholder="Website" value="{{$tinh->website}}">
                    </div>
                </div> <!-- End Website -->

                <!-- Ghi chú -->
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <input name="ghichu" type="text" class="form-control" id="email" placeholder="Ghi chú" value="{{$tinh->ghichu}}">
                    </div>
                </div> <!-- End Ghi chú -->

                <!-- Submit -->
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8" style="text-align: center;">
                        <button type="submit" class="btn btn-success" style="width:200px" onclick="return convert();">Sửa</button>
                    </div>
                </div> <!-- End Submit -->
            </form>
        </div>
    </div>

</div>
<!--end main-->
@endsection
@section('custom-script')
<script>

</script>
@endsection