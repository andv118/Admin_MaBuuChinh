@extends('layout.backend.masterLayout')
@section('content')
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row"  style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active"> Nhật ký hoạt động</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            
            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;"><b>DANH SÁCH HOẠT ĐỘNG</b></div>
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">
                           
                            <table class="table table-bordered table-responsive table-hover table-condensed" style="margin-top:20px;">				
                                <thead>
                                    <tr class="bg-primary">
                                        <th style="text-align: center;">STT</th>
                                        <th style="text-align: center;">Tên</th>
                                        <th style="text-align: center;">Email</th>
                                        <th style="text-align: center;">Hành động</th>
                                        <th style="text-align: center;">Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt=0; ?>
                                @foreach($data as $v)
                                        
                                    <tr>
                                       <td style="text-align: center;"><?php $stt+=1; echo $stt; ?></td>
                                       <td style="text-align: center;">{{$v->name}}</td>
                                       <td style="text-align: center;">{{$v->email}}</td>
                                       <td style="text-align: center;">{{$v->action}}</td>
                                       <td style="text-align: center;">{{$v->time}}</td>

                                @endforeach
                                </tbody>
                            </table>
                            {{$data->links()}}							
                        </div>
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
              return confirm("Bạn có chắc chắn muốn xóa");
            }
       
        </script>
@endsection