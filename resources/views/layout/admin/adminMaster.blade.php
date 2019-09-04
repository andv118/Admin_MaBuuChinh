<!DOCTYPE html>
<html>

<head>
  <base href="{{asset('/admin')}}/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Quản trị mã bưu chính</title>
  <!-- css -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/datepicker3.css" >
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" rel="stylesheet">

  <!--Icons-->
  <script src="js/lumino.glyphs.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
  <!-- header -->
  @include('layout.admin.header')
  @include('layout.admin.silebar')
  @yield('content')

  <!-- javascript -->
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/chart.min.js"></script>
  <script src="js/chart-data.js"></script>
  <script src="js/easypiechart.js"></script>
  <script src="js/easypiechart-data.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  @yield('custom-script')
  <script>
    $(document).ready(function() {

      $('.input_search').keyup(function() { //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
        var query = $('input[name="search"]').val();; //lấy gía trị ng dùng gõ
        if (query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
        {
          console.log(query);
          var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
          $.ajax({
            url: "{{route('ajaxSearch')}}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
            method: "POST", // phương thức gửi dữ liệu.
            data: {
              query: query,
              _token: _token
            },
            success: function(data) { //dữ liệu nhận về
              console.log(data);
              $('.danh-sach-search').fadeIn();
              $('#btnSearch').fadeOut();
              $('.danh-sach-search').html(data);
            }
          });
        } else {
          $('.danh-sach-search').fadeOut();
          $('.btn-primary').fadeIn();
        }
      });

      $(document).on('click', '.autocomplete', function() {
        $('.input_search').val($(this).text());
        $('.btn-primary').fadeIn();
        $('.danh-sach-search').fadeOut();
      });

    });
  </script>

  <script>
    $(document).ready(function() {
      var currentURL = window.location.href;
      $('ul.nav.menu a').each(function(i, item) {
        var href = $(item).attr('href');

        if (href === currentURL) {
          {
            {
              --$('ul.nav.menu li.active').eq(0).removeClass('active') --
            }
          }
          $(item).parentsUntil('ul.nav.menu').addClass('active')
        }
      });

      $('.itemson').each(function() {
        var $this = $(this);

        // we check comparison between current page and attribute redirection.
        if ($this.attr('href') === currentURL) {
          $('.menucon').show();
          $this.css({
            "background-color": "#30a5ff",
            "color": "white"
          });
        }
      });
    });
    //})
  </script>

</body>

</html>