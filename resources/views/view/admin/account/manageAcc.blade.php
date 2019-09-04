@extends('layout.backend.masterLayout')
@section('content')
<!--main-->
<style> 
#searchAcc {
  width: 200px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  box-shadow: 2px 2px black;
  font-size: 16px;
  background-color: white;
  background-image: url('img/searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

#searchAcc:hover {
  width: 600px;
  border-color: red;
}

.fa-sync-alt {
  animation: App-logo-spin infinite 10s linear;
  pointer-events: none;
  font-size: 20px;
  color: black;
}
.fa-lock {
    display: none;
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
    <div class="row"  style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"> Quản lý tài khoản</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;"><b><i class="fas fa-list"></i> DANH SÁCH TÀI KHOẢN</b></div>
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <a style="margin: 20px 0;" href="{{route('admin.add_account')}}" class="btn btn-success"><i class="fas fa-user-plus"></i> Thêm mới tài khoản</a>
                        <form action="{{route('admin.searchAcc')}}" method="post">

                              <input type="text" id="searchAcc" name="keyword" placeholder="Tìm kiếm tài khoản...">
                               <input type="hidden" name="_token" value="{{csrf_token()}}">
                        </form>

                        <script>
                            $(document).ready(function () {
                                 var _token = $('input[name="_token"]').val();
                                $('#searchAcc').typeahead({
                                    source: function (query, result) {
                                        $.ajax({
                                            url: "{{route('admin.getAcc')}}",
                                            data: 'query=' + query,            
                                            dataType: "json",
                                            type: "POST",
                                            success: function (data) {
                                                result($.map(data, function (item) {
                                                    return item;
                                                }));
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
                        <table class="table table-responsive table-hover table-condensed table-bordered" style="margin-top: 20px;">
                            <thead>
                                <tr style="background: #f1f1f1;">
                                    <th style="text-align: center;">STT</th>
                                    <th style="text-align: center;">Họ và tên</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Quyền</th>
                                    <th style="text-align: center;">Khóa</th>
                                    <th style="text-align: center;">Xóa</th>
                                    <th style="text-align: center;">Cập nhật quyền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt=0; ?>
                                @foreach($data as $v)
                                <tr>
                                    <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                    <td style="text-align: center;">{{$v->name}}</td>
                                    <td style="text-align: center;">{{$v->email}}</td>
                                    <td style="text-align: center;">
                                        @if($v->role==1)
                                        {{'Admin'}}
                                        @else
                                        {{'Manager'}}
                                        @endif
                                    </td>
                                    <td style="text-align: center;"><button class="btn btn-warning"><i class="fas fa-lock"></i> <i class="fas fa-lock-open"></i></button></td>
                                    <td style="text-align: center;">
                                        <form action="{{route('admin.deleteAcc')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$v->id}}">
                                            <button type="submit" onclick="return confirmAction();" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                    <td style="text-align: center;"><button data-toggle="modal" data-target="#updaterole{{$v->id}}" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button></td>
                                    
                                    <div id="updaterole{{$v->id}}" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                  <!-- Modal content-->
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h3 class="modal-title" style="color: green;text-align: center;"><b>CẬP NHẬT QUYỀN</b></h3>
                                                  </div>
                                                  <div class="modal-body">
                                                   <form action="{{route('admin.updateRole')}}" method="post">
                                                      @csrf
                                                      <label for="fullname">Tên : {{$v->name}}</label>
                                                      <br>
                                                      <label for="email">Email : {{$v->email}}</label> 
                                                      <br>
                                                      <label for="email">Quyền :</label>
                                                      <br>
                                                      <input type="hidden" name="id" value="{{$v->id}}">
                                                      <select name="role" class="form-control" required>
                                                          <option value="">Chọn quyền</option>
                                                          <option value="1">Admin</option>
                                                          <option value="0">Manager</option>
                                                      </select>
                                                      <br>
                                                      <br>
                                                      <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-refresh"></span> Cập nhật</button>
                                                  </form> 
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$data->links()}}
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div>	
<!--end main-->
<script>
    function confirmAction() {
      return confirm("Bạn có chắc chắn muốn xóa tài khoản này");
  }

</script>
@endsection