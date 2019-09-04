@extends('layout.backend.masterLayout')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row"  style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"> Tạo tài khoản</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;"><b><i class="fas fa-user-plus"></i> TẠO TÀI KHOẢN</b></div>
                <div class="panel-body">
                    <div class="bootstrap-table">
                      @if(count($errors)>0)
                       <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @foreach($errors->all() as $err)
                         <b style="color: red;"> {{$err}}</b> <br>
                        @endforeach
                      </div>
                      @endif

                      @if(Session::has('thanhcong'))
                      <div class="alert alert-success">{{Session::get('thanhcong')}}
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     </div>
                     @endif
                      <form class="form-horizontal" action="{{route('admin.createAcc')}}" method="post">
                          @csrf
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Họ và tên:</label>
                            <div class="col-sm-10">
                              <input type="text" name="name" class="form-control" id="email" placeholder="Nhập họ và tên..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                              <input type="email" name="email" class="form-control" id="email" placeholder="Nhập địa chỉ email..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Mật khẩu:</label>
                            <div class="col-sm-10"> 
                              <input type="password" name="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Nhập lại mật khẩu:</label>
                            <div class="col-sm-10"> 
                              <input type="password" name="repassword" class="form-control" id="pwd" placeholder="Nhập lại mật khẩu..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Quyền hạn:</label>
                            <div class="col-sm-10"> 
                               <select name="role" class="form-control" name="role" required>
                                  <option value="">Chọn quyền</option>
                                  <option value="1">Người quản trị</option>
                                  <option value="0">Nhân viên</option>
                               </select>
                            </div>
                          </div>
                          <div class="form-group"> 
                            <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-danger">Thêm mới</button>
                            </div>
                          </div>
                      </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>	
<!--end main-->

@endsection