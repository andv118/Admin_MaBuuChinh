@extends('layout.backend.masterLayout')
@section('content')
<script src="/plugins/ckeditor/ckeditor.js"></script>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <!-- Start title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <ol class="breadcrumb" style="margin-top: 20px;">
                    <li><a href="#"><svg class="glyph stroked home">
                                <use xlink:href="#stroked-home"></use>
                            </svg></a></li>
                    <li class="active">Cập nhật đối tượng gắn mã </li>
                </ol>
            </div>
        </div>
    </div> <!-- End title -->

    <!-- Start Container -->
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            <!-- Start form -->
            <form class="col-sm-8 form-horizontal col-sm-offset-2" method="POST" action="">
                @csrf
                <h3 style="text-align: center;padding: 20px;color: green;"><b>CẬP NHẬT ĐỐI TƯỢNG GÁN MÃ</b></h3>
                
                <!-- <div class="form-group">
                      <label for="mst" class="col-sm-2 control-label">Đối tượng gán mã</label>
                      <div class="col-sm-8">
                        <input name="doi_tuong_gan" type="text" class="form-control" id="mst" placeholder="Đối tượng gán mã" value="{{$chitiet->doi_tuong_gan}}">
                      </div>
                </div> -->

                <!-- Start ten -->
                <div class="form-group">
                    <label for="CMT" class="col-sm-2 control-label">Tên</label>
                    <div class="col-sm-8">
                        <input name="ten" type="text" class="form-control" id="address" placeholder="Tên" required value="{{$chitiet->ten}}">
                    </div>
                </div> <!-- End ten -->

                <!-- Start Ma buu chinh -->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Mã bưu chính</label>
                    <div class="col-sm-8">
                        <input name="mabc" type="text" class="form-control" id="name" placeholder="mabc" required value="{{$chitiet->mabc}}">
                    </div>
                </div> <!-- End Ma buu chinh -->

                <!-- Start Dien thoai -->
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-2 control-label">Điện thoại</label>
                    <div class="col-sm-8">
                        <input name="data1" type="text" class="form-control" id="phoneNumber" placeholder="Điện thoại" value="{{$chitiet->data1}}">
                    </div>
                </div> <!-- End Dien thoai -->

                <!-- Start Dia chi -->
                <div class="form-group">
                    <label for="addressTd" class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-8">
                        <input name="data3" type="text" class="form-control" id="addressTd" placeholder="Địa chỉ" value="{{$chitiet->data3}}">
                    </div>
                </div> <!-- End Dia chi -->

                <!-- Start Email -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input name="data4" type="text" class="form-control" placeholder="Email" value="{{$chitiet->data4}}">
                    </div>
                </div> <!-- End Email -->

                <!-- Start Website -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-8">
                        <input name="data5" type="text" class="form-control" placeholder="Website" value="{{$chitiet->data5}}">
                    </div>
                </div> <!-- End Website -->

                <!-- Start Ghi chu -->
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <input name="data2" type="text" class="form-control" id="email" placeholder="Ghi chú" value="{{$chitiet->data2}}">
                    </div>
                </div> <!-- End Ghi chu -->

                <!-- Start Huyen -->
                <div class="form-group">
                    <!-- <label class="col-sm-2 control-label">Huyện</label> -->
                    <div class="col-sm-8">
                        <input name="id_huyen" type="hidden" class="form-control input_huyen" placeholder="Huyện" value="{{$chitiet->huyen->ten}}" autocomplete="off">
                        @if ($errors->has('id_huyen'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('id_huyen') }}</strong>
                        </span>
                        @endif
                        <!-- Start danh sach -->
                        <div class="danh-sach-mbc" style="display: none">
                            <div>
                            </div>
                        </div> <!-- End danh sach -->
                    </div>    
                </div> <!-- End Huyen --> 

                <!-- Start Cap nhat -->
                <div class="form-group" style="margin-top: 20px;">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success" style="margin-left: 20%;"><i class="fas fa-sync-alt"></i> Cập nhật</button>
                    </div>
                </div> <!-- End Cap nhat -->

            </form> <!-- End form -->
        </div>
    </div> <!-- End Container -->

</div>
<!--end main-->
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

        $('.input_huyen').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
            var query = $('input[name="id_huyen"]').val();; //lấy gía trị ng dùng gõ
            if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
            {
                console.log(query);
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                $.ajax({
                    url: "{{route('ajaxhuyen')}}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
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
            $('.input_huyen').val($(this).text());
            $('.btn-success').fadeIn();
            $('.danh-sach-mbc').fadeOut();
        });

    });
</script>
@endsection