@extends('layout.backend.masterLayout')
@section('content')
<!--main-->
<style>
  .fa-cog {
  animation: App-logo-spin infinite 10s linear;
  pointer-events: none;
  font-size: 20px;
  color: black;
}

@keyframes App-logo-spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Cài đặt tài khoản</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;"><i class="fas fa-cog"></i> <b>CÀI ĐẶT TÀI KHOẢN</b></div>
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="container-fluid">
                            <div class="row" style="border:1px solid grey; padding: 10px 10px;border-radius: 5px;box-shadow: 3px 3px black;">
                               <div class="page-header">
                                   <h3 style="padding-bottom: 10px;color: #3ea731;"><b><i class="fas fa-user-circle"></i> Đổi thông tin cá nhân</b></h3>
                               </div>
                               @if(count($errors)>0)
                               <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                @foreach($errors->all() as $err)
                                {{$err}} <br>
                                @endforeach
                              </div>
                              @endif
                              <div class="col-lg-3 col-md-3 col-sm-3" style="border-right: 2px solid grey;">
                                <img src="img/user.png" alt="" width="100px" height="100px" style="border-radius: 50%;margin-left: 32%;border: 2px solid black;">
                                <br>
                                <br> 
                                <div style="text-align: center;">Họ và tên : <b style="color: red;">{{Auth::user()->name}}</b></div>
                                <br>
                                <div style="text-align: center;">Email : <b style="color: red;">{{Auth::user()->email}}</b></div>
                                <br>
                                <div style="text-align: center;">Quyền hạn : <b style="color: red;">
                                  @if(Auth::user()->role==1)
                                  {{'Admin'}}
                                  @else
                                  {{'Manager'}}
                                  @endif
                                </b></div>
                              </div>
                              <div class="col-lg-9 col-md-9 col-sm-9">
                                  <form action="{{route('admin.update_account')}}" method="post">
                                    <div class="form-group">
                                      @csrf
                                      <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                      <label for="pwd">Tên:</label>
                                      <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}" id="pwd" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="email">Email :</label>
                                      <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}" id="email" required>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success"><i class="fas fa-redo-alt"></i> Cập nhật</button>
                                  </form>
                              </div>
                            </div>

                            <div class="row" style="border:1px solid grey; padding: 10px 10px;border-radius: 5px;box-shadow: 3px 3px black;margin-top: 20px;">
                             <div class="page-header">
                              <h3 style="padding-bottom: 10px;color: #3ea731;"><b><i class="fas fa-key"></i> Đổi mật khẩu</b></h3>
                             </div>

                             @if(count($errors)>0)
                             <div class="alert alert-danger" style="margin: 20px 0;text-align: center;">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              @foreach($errors->all() as $err)
                              {{$err}} <br>
                              @endforeach
                            </div>
                            @endif

                            @if(Session::has('thanhcong'))
                            <div class="alert alert-success">{{Session::get('thanhcong')}}
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            </div>
                            @endif
                            <!---------------------------------------------------------->
                            <div class="col-lg-12 col-md-12 col-sm-12">
                              <form action="{{route('admin.changePass')}}" method="post">
                                 @csrf
                                <div class="form-group">
                                  <label for="pwd">Mật khẩu cũ:</label>
                                  <input type="password" name="current-password" placeholder="Nhập mật khẩu cũ" class="form-control" id="pwd" required>
                                  @if ($errors->has('current-password'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label for="email">Mật khẩu mới :</label>
                                  <input type="password" name="new-password" placeholder="Nhập mật khẩu mới" class="form-control"  id="email" required>
                                  @if ($errors->has('new-password'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                  </span>
                                  @endif
                                </div>
                                <div class="form-group">
                                  <label for="email"> Nhập lại mật khẩu mới :</label>
                                  <input type="password" name="new-password_confirmation" placeholder="Nhập lại mật khẩu" class="form-control"  id="email" required>
                                </div>

                                <button type="submit" class="btn btn-success"><i class="fas fa-redo-alt"></i> Cập nhật</button>
                              </form>
                            </div>
                          </div>
                            
                           						
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
        
    
</div>	
 <script>
            function confirmAction() {
              return confirm("Bạn có chắc chắn muốn xóa");
            }
       
        </script>
@endsection