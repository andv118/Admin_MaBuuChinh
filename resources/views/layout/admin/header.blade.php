
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="padding-bottom: 20px;">
		<div class="container-fluid">
			<div class="navbar-header" style="position: relative;">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{Route('Admin.tinh')}}"><span> <img src="img/quochuy.png" style="width: 40px;height: auto;padding-bottom: 0px;"> TRANG THÔNG TIN ĐIỆN TỬ
				QUẢN LÝ MÃ BƯU CHÍNH QUỐC GIA </span></a>
				<div style="position: absolute;right: 140px;top: 31px;color: #30a5ff;">
					<marquee width="400px">Quản lý, tra cứu mã bưu chính quốc gia.</marquee>
					
				</div>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> {{Auth::user()->name}} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							
							<li><a href="{{route('logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Đăng xuất</a></li>
							<li><a href="{{route('Admin.setting_account')}}"><i class="fas fa-cog"></i> Cài đặt tài khoản</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>