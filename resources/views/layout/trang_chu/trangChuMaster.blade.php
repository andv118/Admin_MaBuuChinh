<!doctype html>
<html lang="en">

<head>
        <base href="{{url('/frontend')}}/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title> Mã bưu chính quốc gia </title>
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700" rel="stylesheet">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="bootstrap/js/bootstrap.js"></script>

    <link rel="stylesheet" href="font-awesome/css/all.css">

    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">

</head>

@include('layout.frontend._inc.header')


    @yield('content')

@include('layout.frontend._inc.footer')
   

    {{--  <script src="js/mabuuchinh.js"></script>  --}}
    <script>
        $(document).ready(function(){
      
         $('.MBC-input-search').keyup(function(){ //bắt sự kiện keyup khi người dùng gõ từ khóa tim kiếm
          var query = $('input[name="input_timKiem"]').val();; //lấy gía trị ng dùng gõ
          if(query != '') //kiểm tra khác rỗng thì thực hiện đoạn lệnh bên dưới
          {
              console.log(query);
           var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
           $.ajax({
            url:"{{ route('ajax') }}", // đường dẫn khi gửi dữ liệu đi 'search' là tên route mình đặt bạn mở route lên xem là hiểu nó là cái j.
            method:"POST", // phương thức gửi dữ liệu.
            data:{query:query, _token:_token},
            success:function(data){ //dữ liệu nhận về
                $('.danh-sach-mbc').fadeIn(); 
                $('#download-mbc').fadeOut() 
                $('.danh-sach-mbc').html(data);
           }
         });
         }else{
            $('.danh-sach-mbc').fadeOut();
            $('#download-mbc').fadeIn();
         }
       });
      
         $(document).on('click', 'li.autocomplete', function(){  
          $('#input_timKiem').val($(this).text());
          $('#btn_timKiem').click();  
          $('.danh-sach-mbc').fadeOut();  
        });  
      
       });
      </script>
      <script>
        $( "li" ).hover(function() {
          console.log('555');
        });
        </script>
</body>

</html>