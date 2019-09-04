@extends('layout.admin.AdminMaster')
@section('content')
<script src="/plugins/ckeditor/ckeditor.js"></script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">


    <!-- Title -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Thêm Quận / Huyện</h3>
        </div>
    </div>
    <!--End Title -->

    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <form class="col-sm-8 form-horizontal col-sm-offset-2" method="POST" action="">
                @csrf
                <!-- <h3><b>Thêm thông tin quận huyện</b></h3> -->
                <!-- Stt -->
                <div class="form-group">
                    <label for="mst" class="col-sm-2 control-label">STT</label>
                    <div class="col-sm-8">
                        <input name="quan" type="text" class="form-control" id="mst" placeholder="Số thứ tự">
                    </div>
                </div> <!-- End STT -->

                <!-- Tên -->
                <div class="form-group">
                    <label for="CMT" class="col-sm-2 control-label">Tên</label>
                    <div class="col-sm-8">
                        <input name="ten" type="text" class="form-control" id="address" placeholder="Tên">
                    </div>
                </div> <!-- End Tên -->

                <!-- Mã -->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Mã bưu chính</label>
                    <div class="col-sm-8">
                        <input name="mbc" type="text" class="form-control" id="name" placeholder="Mã">
                    </div>
                </div> <!-- End Mã -->

                <!-- Điện Thoại -->
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-2 control-label">Điện thoại</label>
                    <div class="col-sm-8">
                        <input name="dienthoai" type="text" class="form-control" id="phoneNumber" placeholder="Điện thoại">
                    </div>
                </div> <!-- End Điện Thoại -->

                <!-- Địa Chỉ -->
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-8">
                        <input name="diachi" type="text" class="form-control" id="email" placeholder="Địa chỉ">
                    </div>
                </div> <!-- End Địa Chỉ -->

                <!-- Email -->
                <div class="form-group">
                    <label for="addressTd" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input name="email" type="text" class="form-control" id="addressTd" placeholder="Email">
                    </div>
                </div> <!-- End Email -->

                <!-- Website -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-8">
                        <input name="website" type="text" class="form-control" placeholder="Website">
                    </div>
                </div> <!-- End Website -->

                <!-- Ghi chú -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <input name="ghichu" type="text" class="form-control" placeholder="Ghi chú">
                    </div>
                </div> <!-- End Ghi chú -->

                <!-- Tỉnh/Thành phố -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tỉnh / Thành phố</label>
                    <div class="col-sm-8">
                        <input name="id_tinh" type="text" class="form-control input_tinh" placeholder="Tỉnh" autocomplete="off">
                        @if ($errors->has('id_tinh'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('id_tinh') }}</strong>
                        </span>
                        @endif
                        <div class="danh-sach-mbc" style="display: none">
                            <div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Tỉnh/Thành phố -->
                <!-- Submit -->
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                        <button type="submit" class="btn btn-success" style="width:200px">Thêm</button>
                    </div>
                </div>
                <!--End Submit -->
            </form>
        </div>
    </div>

</div>
<!--End main-->

@endsection
@section('custom-script')
<script>
    $('#calendar').datepicker({});
    ! function($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function() {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function() {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function() {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    });

    function changeImg(input) {
        //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            //Sự kiện file đã được load vào website
            reader.onload = function(e) {
                //Thay đổi đường dẫn ảnh
                $('#avatar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('#avatar').click(function() {
            $('#img').click();
        });
    });


    var lineChartData = {
        labels: [


        ],
        datasets: [

            {
                label: "My Second dataset",
                fillColor: "rgba(48, 164, 255, 0.2)",
                strokeColor: "rgba(48, 164, 255, 1)",
                pointColor: "rgba(48, 164, 255, 1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(48, 164, 255, 1)",
                data: []
            }
        ]

    }

    window.onload = function() {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true
        });
        var chart2 = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(chart2).Bar(barChartData, {
            responsive: true
        });
        var chart3 = document.getElementById("doughnut-chart").getContext("2d");
        window.myDoughnut = new Chart(chart3).Doughnut(doughnutData, {
            responsive: true
        });
        var chart4 = document.getElementById("pie-chart").getContext("2d");
        window.myPie = new Chart(chart4).Pie(pieData, {
            responsive: true
        });

    };
</script>
<script>
    $(document).ready(function() {

        $('.input_tinh').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var query = $('input[name="id_tinh"]').val();; //lấy gía trị ng dùng gõ
            if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                console.log(query);
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url: "{{route('ajaxtinh')}}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
                    method: "POST", // phương thức gửi dữ liệu.
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) { //dữ liệu nhận về
                        console.log(data);
                        $('.danh-sach-mbc').fadeIn();
                        $('.btn-success').fadeOut();
                        $('.danh-sach-mbc').html(data);
                    }
                });
            } else {
                $('.danh-sach-mbc').fadeOut();
                $('.btn-success').fadeIn();
            }
        });

        $(document).on('click', '.autocomplete', function() {
            $('.input_tinh').val($(this).text());
            $('.btn-success').fadeIn();
            $('.danh-sach-mbc').fadeOut();
        });

    });
</script>
@endsection