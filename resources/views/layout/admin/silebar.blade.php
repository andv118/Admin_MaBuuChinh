</div><!-- /.container-fluid -->
</nav>
<!-- header -->
<style>
    .clear {
        clear: both;
    }

    .menucha {
        margin-top: 2px;
        text-align: left;
        width: 100%;
        font-size: 16px;
        color: black;
        border-top: 1px solid #1a2732;
        border-bottom: 1px solid #1a2732;
        background: #fafafa;
        width: 100%;
        padding: 0;
        height: auto;
        position: relative;
    }

    .menucha:hover{
        background: #fafafa;
    }

    .menucha .menucha_link,
    .menucha .menucha_link_button {
        position: relative;
        padding: 0;
        color: black;
        background: #fafafa;
        display: block;
        width: 100%;
        height: 100%;
        text-align: left;
        padding: 12px 5px;
        position: relative;
    }

    .menucha .menucha_link_button i:nth-child(2) {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        border: none;
    }

    .menucha .menucha_link i {
        font-size: 16px;
    }

    .menucha .menucha_link i:first-child {
        margin-right: 5px;
    }

    .menucha .menucha_link i:nth-child(2) {
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-50%);
    }

    .menucha:hover {
        background: #30a5ff;
        color: white;
    }

    .menucha_link:hover, .menucha .menucha_link_button:hover {
        background: #30a5ff;
        color: white;
    }

    .menucha_link i .i-left {
        float: left;
    }

    /* Item con */

    .menucon {
        display:none;
        width: 100%;
        list-style: none;
        padding: 0;
    }

    .menucon .itemfar {
        border-top: 1px solid #1a2732;
        border-bottom: 1px solid #1a2732;
        background: #fafafa;
    }

    .menucon i {
        font-size: 15px;
        margin: 0 5px 0 20px;
    }

    .itemson {
        text-decoration: none;
        color: black;
        text-align: center;
        display:block;
        font-size: 14px;
        padding: 5px 10px;
    }

    .danh-sach-search ul li a:hover {
        background: #30a5ff;
        border: none;
        cursor: pointer;
    }
    
</style>
<!-- sidebar right-->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search" method="GET" action="" style="margin-top: 20px;">
        <div class="form-group">
            <input name="search" type="text" class="form-control input_search" placeholder="Tìm kiếm..." autocomplete="off">
            <div class="danh-sach-search" style="display: none;">
            </div>
            <button type="submit" style="margin-top:10px;" id="btnSearch" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm</button>
        </div>
    </form>

    <!-- Start menu -->

    <ul class="nav menu">
        <!-- Start menu cha -->
        <li class="menucha">
            <button class="menucha_link_button">
                <i class="fa fa-edit"></i>
                Cập nhật thủ công
                <i class="fa fa-chevron-down"></i>
            </button>

            <!-- Start menu con -->
            <ul class="menucon">
                <li class="itemfar">
                    <a class="itemson" href="{{Route('Admin.tinh')}}"> 
                    Tỉnh, Thành phố và các đơn vị hành chính tương đương</a>
                </li>
                <li class="itemfar">
                    <a class="itemson" href="{{Route('Admin.huyen')}}">
                   
                     Quận, Huyện và các đơn vị hành chính tương đương</a>
                </li>
                <li class="itemfar">
                    <a class="itemson" href="{{Route('Admin.doiTuongGanMa')}}">
                    Đối tượng gắn mã và các đơn vị tương đương</a>
                </li>

            </ul> <!-- End menu con -->
        </li> <!-- End menu cha -->
        <div class="clear"></div>

        <li class="menucha">
            <a class="menucha_link" href="{{Route('Admin.import_excels')}}">
                <i class="fa fa-file-invoice i-left"></i>
                Cập nhật bằng excel
            </a>
        </li>
        @if(Auth::user()->role==1)
        <li class="menucha">
            <a class="menucha_link" href="{{Route('Admin.diary')}}">
                <i class="fa fa-book i-left"></i>
                Nhật ký hoạt động
            </a>
        </li>
        <li class="menucha">
            <a class="menucha_link" href="{{Route('Admin.manage_account')}}">
                <i class="fas fa-cog i-left"></i>
                Quản lý tài khoản
            </a>
        </li>
        @endif

    </ul> <!-- End menu -->

    <script>
        $(document).ready(function() {
            $('.menucha_link_button').click(function() {
                $('.menucon').slideToggle(500);
            });

        // get url
        var urlName = window.location.pathname;
        // console.log(urlName);
        });
    </script>

</div>
<!--/. end sidebar right-->