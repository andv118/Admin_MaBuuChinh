@extends('layout.backend.masterLayout')
@section('content')
<script src="/plugins/ckeditor/ckeditor.js"></script>
<script>
    function checkValidate() {
        //Tiến hành lấy dữ liệu trên Form
        var mabc = document.getElementById("mabc").value;
        var status = false; //Biến trạng thái
        var re = /([0-9]{1,5})\b/g;
        var re1 = /([0-9]{9,12})\b/g;
        var re2 = /(09|01[2|6|8|9])+([0-9]{8})\b/g;

        if (mabc.length != 0) {
            if (mabc.length != 5 || (isNaN(mabc) == true)) {
                document.getElementById("mabc").style.borderColor = "red";
                document.getElementById("mabc").style.display = "block";
                document.getElementById("lbmabc").innerHTML = "Mã bưu chính không đúng định dạng";
                status = true;
            } else {

                document.getElementById("mabc").style.borderColor = "#D8D8D8";
                document.getElementById("lbmabc").style.display = "none";

            }
        }


        if (status == true) {
            //alert(msg);
            return false;
        } else {
            return true;
        }

    }
</script>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <!-- Start Title -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="text-align: center; color: #000">Thêm đối tượng gán mã</h1>
        </div>
    </div> <!-- End Title -->

    <!-- Start Content -->
    <div class="row">
        <div class="col-xs-6 col-md-12 col-lg-12">
            @if(Session::has('loi'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>{{Session::get('loi')}}</b>
            </div>
            @endif
            <form class="col-sm-8 form-horizontal col-sm-offset-2" onsubmit="return checkValidate();" method="POST" action="{{route('admin.add_dtgm')}}">
                @csrf
                <!-- Start form doi tuong dan ma -->
                <div class="form-group">
                    <label for="CMT" class="col-sm-2 control-label">Đối tượng gán mã</label>
                    <div class="col-sm-8">
                        <input name="ten" type="text" class="form-control" id="address" placeholder="Tên" onblur="return convert();" required>
                    </div>
                </div> <!-- End form doi tuong dan ma -->

                <!-- Start ten khong dau -->
                <input name="ten_eng" type="hidden" class="form-control" id="ten_eng" placeholder="Tên ko dau" required>
                <!-- End ten khong dau -->

                <!-- Start form ma buu chinh -->
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Mã bưu chính</label>
                    <div class="col-sm-8">
                        <input name="mabc" type="text" class="form-control" id="mabc" placeholder="Mã" required>
                    </div>
                    <div style="color: red;" id="lbmabc"></div>
                </div> <!-- End form ma buu chinh -->

                <!-- Start form dien thoai -->
                <div class="form-group">
                    <label for="phoneNumber" class="col-sm-2 control-label">Điện thoại</label>
                    <div class="col-sm-8">
                        <input name="data1" type="text" class="form-control" id="phoneNumber" placeholder="Điện thoại">
                    </div>
                </div> <!-- End form dien thoai -->

                <!-- Start form dia chi -->
                <div class="form-group">
                    <label for="addressTd" class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-8">
                        <input name="data3" type="text" class="form-control" id="addressTd" placeholder="Địa chỉ">
                    </div>
                </div> <!-- End form dia chi -->

                <!-- Start form email -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input name="data4" type="text" class="form-control" placeholder="Email">
                    </div>
                </div> <!-- End form email -->

                <!-- Start form website -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Website</label>
                    <div class="col-sm-8">
                        <input name="data5" type="text" class="form-control" placeholder="Website">
                    </div>
                </div> <!-- End form website -->

                <!-- Start form ghi chu -->
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8">
                        <input name="data2" type="text" class="form-control" id="email" placeholder="Ghi chú">
                    </div>
                </div> <!-- End form ghi chu -->

                <!-- Start tinh thanh pho -->
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Tỉnh/Thành phố</label>
                    <div class="col-sm-8">
                        <select name="tinh" id="tinh" class="form-control" required>
                            <option value="">Chọn tỉnh</option>
                            @foreach($data as $v)
                            <option value="{{$v->id}}">{{$v->ten}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <!-- End tinh thanh pho -->

                <!-- Start quan huyen -->
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Quận/Huyện</label>
                    <div class="col-sm-8">
                        <select name="huyen" id="huyen" class="form-control">
                            <option value="">Chọn huyện</option>

                        </select>
                    </div>
                </div> <!-- End quan huyen -->

                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <script>
                    $(document).ready(function() {
                        $('#tinh').change(function() {
                            var tinh = $(this).val();
                            var _token = $('input[name="_token"]').val();
                            $.ajax({
                                url: "{{route('admin.getHuyenById')}}",
                                data: {
                                    tinh: tinh,
                                    _token: _token
                                },
                                type: "post",
                                success: function(data) {
                                    $('#huyen').html(data);
                                }
                            });
                        });
                    });
                </script>

                <!-- Start submit -->
                <div class="form-group">
                    <div class="col-sm-2 col-sm-10" style="text-align: center; margin: 20px 0; width:100%">
                        <button style="padding:10px 30px" type="submit" class="btn btn-success" onclick="return convert();">Thêm</button>
                    </div>
                </div> <!-- End submit -->

            </form>
        </div>
    </div> <!-- End Content -->




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