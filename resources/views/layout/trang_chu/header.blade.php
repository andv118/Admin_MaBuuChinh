<body>

        <div class="row MBC-banner">
            <div class="container" style="position: relative">
                <div class="col-xs-10 col-sm-10 col-md-10 pull-left">
                    <div><a href="/"><img src="imgs/quochuy.png" class="MBC-quochuy" /></a></div>
                    <div class="MBC-Header-Title">
                        <div>
                            <h1 class="MBC-title">TRANG THÔNG TIN ĐIỆN TỬ</h1>
                        </div>
                        <div>
                            <h1 class="MBC-title"><b>TRA CỨU MÃ BƯU CHÍNH QUỐC GIA</b></h1>
                        </div>
                    </div>
                </div> <!-- End MBC-Title-->
    
                <div class="col-xs-2 col-sm-2 col-md-2 MBC-languages">
                    <div class="text-right menutopringht">
                        <div class="text-center">
                            <a href="/">
                                <img alt='flagvietnam' src="imgs/vietnamflag.png" /><br />
                                <label style="font-size: 11px; color: #f5f5f5">VNI</label>
                            </a>
                        </div>
                        <label id="lable-cach">|</label>
                        <div class="text-center">
                            <a href="/mbc-english">
                                <img alt='flagengland' src="imgs/englandflag.png" /><br />
                                <label style="font-size: 11px; color: #f5f5f5">ENG</label>
                            </a>
                        </div>
                    </div>
                </div> <!-- End MBC-Language-->
            </div> <!-- End MBC-Container-->
        </div> <!-- End MBC-Banner-->
    
    
        <div style="width: 100%; background-color: #015ab4">
            <div class="container container-nav">
                <ul class="nav nav-tabs MBC-nav">
                    <li role="presentation"><a href="/"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </li>
    
                    <li role="presentation"><a href="{{route('home')}}">Trang chủ</a></li>
    
                    <li role="presentation"><a href="{{route('gioithieu')}}">Giới thiệu</a></li>
    
                    <li role="presentation"><a href="{{route('vanban')}}">Văn bản</a></li>
    
                    <li role="presentation"><a href="{{route('huongdan')}}">Hướng dẫn</a></li>
    
                </ul>
            </div>
        </div> <!-- End MBC-Menu-->