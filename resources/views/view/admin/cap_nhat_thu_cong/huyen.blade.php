@extends('layout.admin.AdminMaster')
@section('content')
<script>
    function confirmAction() {
        return confirm("Bạn có chắc chắn muốn xóa");
    }
</script>
<!--main-->
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <!-- Link -->
    <div class="row" style="margin-top: 20px;">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active"> Quận, Huyện và đơn vị tương đương</li>
        </ol>
    </div>
    <!--End Link -->

    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">

            <div class="panel panel-primary">
                <div class="panel-heading" style="text-align: center;"><b><i class="fas fa-list-alt"></i> DANH SÁCH HUYỆN VÀ CÁC ĐƠN VỊ TƯƠNG ĐƯƠNG</b></div>
                <div class="panel-body">
                    <div class="bootstrap-table">
                        <div class="table-responsive">
                            <div>
                                <a class="btn btn-success " href="{{ Route('Admin.add_huyen')}}" role="button" style="float:left; margin-right:50px"><i class="fa fa-plus"></i> Thêm Quận / Huyện</a>
                                <select name="fillter_huyen" class="form-control fillter" style="width: 25%;float: left;">
                                    @foreach($arrTinh as $v)
                                    <option value="{{$v->id}}">{{$v->ten}}</option>
                                    @endforeach
                                </select>&nbsp;
                            </div>
                            @php
                            $stt = 1;
                            if(isset($_GET['page'])) {
                            $page = $_GET['page'];
                            } else {
                            $page = 1;
                            }
                            $stt += ($page - 1) * 20;
                            @endphp
                            <div class="table-content">
                                <table class="table table-bordered table-responsive table-hover table-condensed" style="margin-top:20px;">
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
                                        @foreach($data as $huyen)
                                        <tr>
                                            <td style="text-align:center;">{{$stt++}}</td>
                                            <td style="text-align:center;">{{$huyen->ten}}</td>
                                            <td style="text-align:center;">{{$huyen->mbc}}</td>
                                            <td style="text-align:center;">{{$huyen->dienthoai}}</td>
                                            <td style="text-align:center;">{{$huyen->diachi}}</td>
                                            <td style="text-align:center;">{{$huyen->email}}</td>
                                            <td style="text-align:center;">{{$huyen->website}}</td>
                                            <td style="text-align:center;">{{$huyen->ghichu}}</td>
                                            <td style="text-align:center;">
                                                <a href="{{ Route('Admin.edit_huyen', $huyen->id )}}" class="btn btn-warning"> Sửa</a>
                                                <a href="{{ Route('Admin.delete_huyen', $huyen->id)}}" class="btn btn-danger" onclick="return confirmAction();"> Xóa</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$data->links()}}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>


</div>
<!--end main-->
<script>
    $(document).ready(function() {
        /**
         * Ajax lọc huyện theo tỉnh
         */
        $('.fillter').change(function() {
            if ($(this).val() != '') {
                var id = $(this).val();
                var _token = $('input[name="_token"]').val();
                // ajax
                $.ajax({
                    url: "/admin/huyen/filter",
                    data: {
                        id_tinh: id,
                        _token: _token
                    },
                    success: function(data) {
                        console.log(data);
                        $('.table-content').html(data);
                        // $('.pagination').hide();
                    }
                })

            } else {
                alert('false');
            }
        });
    });
</script>
@endsection