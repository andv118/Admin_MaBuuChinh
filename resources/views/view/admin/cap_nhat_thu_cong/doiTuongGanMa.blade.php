@extends('layout.backend.masterLayout')
@section('content')
<!--main-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb" style="margin-top: 20px;">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active"> Đối tượng gắn mã </li>
        </ol>
    </div>
    <!--/.row-->
    <div class="panel panel-primary">
        <div class="panel-heading" style="text-align: center;"><b><i class="fas fa-list-alt"></i> DANH SÁCH ĐỐI TƯỢNG GẮN MÃ</b></div>
        <div class="panel-body">
            <div class="bootstrap-table">
                <div class="table-responsive">

                    <!-- Thêm đtgm -->
                    <a class="btn btn-success" href="{{route('admin.add_huyenchitiet')}}" role="button" style="float:left; margin-right:50px"><i class="fa fa-plus"></i> Thêm đối tượng gắn mã
                    </a>
                    <!--End Thêm đtgm -->

                    <!-- Select -->
                    <!-- Select Tinh -->
                    <form action="" method="get" class="form-search" style="width: 25%;float: left;display:block-inline;margin-right: 20px">
                        <input type="hidden" name="page" value="1">
                        <select id="select-fetch-tinh" name="id_tinh" class="form-control">
                            @foreach($arrTinh as $v)
                            <option value="{{$v->id}}">{{$v->ten}}</option>
                            @endforeach
                        </select>&nbsp;
                    </form>
                    <!--End Select Tinh -->
                    <!-- Select Huyen -->
                    <form action="" method="get" class="form-search" style="width: 25%;float: left;display:block-inline">
                        <input type="hidden" name="page" value="1">
                        <select id="select-fetch-huyen" name="id_tinh" class="form-control">
                            <option value="0">Chọn Huyện</option>
                            @foreach($arrHuyen as $v)
                            <option value="{{$v->id}}">{{$v->ten}}</option>
                            @endforeach
                        </select>&nbsp;
                    </form>
                    <!--End Select Huyen -->
                    <!--End Select -->

                    <!-- Table -->
                    <div class="table-content">
                        @include('backend.table_data');
                        <!-- <table class="table table-bordered table-responsive table-hover table-condensed" style="margin-top:20px;">
                            <thead>
                                <tr class="bg-primary">
                                    <th style="text-align: center;">STT</th>
                                    <th style="text-align: center;">Tên</th>
                                    <th style="text-align: center;">Mã bưu chính</th>
                                    <th style="text-align: center;">Điện thoại</th>
                                    <th style="text-align: center;">Địa chỉ</th>
                                    <th style="text-align: center;">Email</th>
                                    <th style="text-align: center;">Website</th>
                                    <th style="text-align: center;">Ghi chú</th>
                                    <th style="text-align: center;">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody class="append-data">
                                <?php $stt = 1; ?>
                                @foreach($arrDtgm as $dtgm)
                                <tr>
                                    <td style="text-align:center;">{{$stt}}</td>
                                    <td style="text-align:center;">{{$dtgm->ten}}</td>
                                    <td style="text-align:center;">{{$dtgm->mbc}}</td>
                                    <td style="text-align:center;">{{$dtgm->dienthoai}}</td>
                                    <td style="text-align:center;">{{$dtgm->diachi}}</td>
                                    <td style="text-align:center;">{{$dtgm->email}}</td>
                                    <td style="text-align:center;">{{$dtgm->website}}</td>
                                    <td style="text-align:center;">{{$dtgm->ghichu}}</td>
                                    <td style="text-align:center;">
                                        <a href="{{ route('admin.edit_huyen', $dtgm->id )}}" class="btn btn-warning"> Sửa</a>
                                        <a href="{{ route('admin.delete_huyen', $dtgm->id)}}" class="btn btn-danger" onclick="return confirmAction();"> Xóa</a>
                                    </td>
                                </tr>
                                {{$stt++}}
                                @endforeach
                            </tbody>
                        </table>
                        {{$arrDtgm->links()}} -->
                    </div> <!-- End Table -->
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

</div>
<!--end main-->
<script>
    function confirmAction() {
        return confirm("Bạn có chắc chắn muốn xóa");
    }

    $(document).ready(function() {
        $('#select-fetch-tinh').change(function() {
            var idTinh = $(this).val();
            var _token = $('input[name="_token"]').val();
            // ajax
            $.ajax({
                url: "{{Route('admin.doiTuongGanMa.fetch_tinh')}}",
                method: "POST",
                dataType: "json",
                data: {
                    id_tinh: idTinh,
                    _token: _token
                },
                success: function(data) {
                    console.log(data);
                    $('#select-fetch-huyen').html(data['option']);
                    $('.append-data').html(data['dtgm_data']);
                }
            })
        });
    });
</script>
@endsection