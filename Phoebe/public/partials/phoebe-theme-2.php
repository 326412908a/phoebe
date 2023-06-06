<!DOCTYPE html>
<html lang="zh-CN" class="perfect-scrollbar-on ext-strict">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<title><?php _e($att_name);?> | 附件下载 |<?php _e($blog_title);?></title>
<meta name="keywords" content="<?php _e($att_name);?>">
<meta name="description" content="<?php _e($att_desc);?>">
<!-- Nucleo Icons -->
<link href="<?php _e(plugin_dir_url( __FILE__ ) . 'css/nucleo-icons.css');?>" rel="stylesheet">
<link href="<?php _e(plugin_dir_url( __FILE__ ) . 'css/nucleo-svg.css');?>" rel="stylesheet">
<!-- Font Awesome Icons -->
<link href="https://cdn.bootcss.com/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
<!-- Font Main Style -->
<link href="<?php _e(plugin_dir_url( __FILE__ ) . 'css/main.style.css');?>" rel="stylesheet">
</head>
<body class="product-page ext-webkit ext-chrome ext-mac" id="syno-nsc-ext-gen3">
<!-- Navbar -->
<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent headroom headroom--top headroom--not-bottom">
<style>
.icon-brand{font-size: 1.8rem;}
.page-header.page-header-small {min-height: 60vh;max-height: 400px !important;}
@media (max-width: 768px){
.section-info-panel{padding-top: 0px;}	
}
.carousel-item{cursor:pointer}
</style>
<div class="container">
	<h1>
	<a class="navbar-brand text-blod mr-lg-5" href="/" style="font-size: 1.1rem;font-weight: 1200;">
          <?php _e($blog_title);?>
	</a>
	</h1>
	<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="navbar-collapse collapse" id="navbar_global" style="">
		<div class="navbar-collapse-header">
			<div class="row">
				<div class="col-6 collapse-brand">
					<a class="navbar-brand text-blod mr-lg-5 text-primary" href="/" style="font-size: 1.1rem;font-weight: 1200;">
                    <?php _e($blog_title);?>
					</a>
				</div>
				<div class="col-6 collapse-close">
					<button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
					<span></span>
					<span></span>
					</button>
				</div>
			</div>
		</div>
		<ul class="navbar-nav navbar-nav-hover align-items-lg-center ml-lg-auto">
			<li class="nav-item dropdown">
			<a href="javascript:;" class="nav-link" data-toggle="dropdown" role="button">
			<i class="ni ni-ui-04 d-lg-none"></i>
			<span class="nav-link-inner--text">下载帮助</span>
			</a>
			<div class="dropdown-menu dropdown-menu-xl">
				<div class="dropdown-menu-inner">
					<a class="media d-flex align-items-center">
					<div class="icon icon-shape bg-gradient-primary rounded-circle text-white">
						<i class="ni ni-bell-55"></i>
					</div>
					<div class="media-body ml-3">
						<h6 class="heading text-primary mb-md-1">付费资源：</h6>
						<p class="description d-none d-md-inline-block mb-0">
							1.付费资源请按照提示付费后发送:【资源名称】+【付款截图】至:contact@lylares.com
						</p>
						<p class="description d-none d-md-inline-block mb-0">
							2.免费资源未公开链接的可以邮件索取。
						</p>
					</div>
					</a>
					<!--
					<a href="/" class="media d-flex align-items-center">
					<div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
						<i class="ni ni-palette"></i>
					</div>
					<div class="media-body ml-3">
						<h6 class="heading text-primary mb-md-1">测试</h6>
						<p class="description d-none d-md-inline-block mb-0">
							一些内容测试。。。。。
						</p>
					</div>
					</a>-->
				</div>
				<!--
				<div class="dropdown-menu-footer">
					<a class="dropdown-item" href="/">
					<i class="ni ni-atom"></i>
                    链接1
					</a>
				</div>-->
			</div>
			</li>
			<li class="nav-item">
			<a href="/?p=<?php _e($post_id);?>" class="nav-link" target="_blank">
			<i class="ni ni-app d-lg-none"></i>
			<span class="nav-link-inner--text">回到文章</span>
			</a>
			</li>
			<li class="nav-item dropdown">
			<a href="javascript:;" class="nav-link" data-toggle="dropdown" role="button">
			<i class="ni ni-app d-lg-none"></i>
			<span class="nav-link-inner--text">支持打赏</span>
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				<div class="ml-auto mr-auto phoebe-pay-qrcode">
					<img class="d-block rounded" src="<?php _e($qrcode_api);?>?service=QrCode.Png&size=5&data=<?php _e($current_url);?>/?phoebe_pay=1" alt="First slide">
				</div>
				<div class="text-center text-muted">
					<p class="text-primary">
						<i class="fas fa-mug-hot"> 赏杯咖啡</i>
					</p>
				</div>
			</div>
			</li>
		</ul>
	</div>
</div>
</nav>
<!-- End Navbar -->
<!--Index Wrapper Start-->
<div class="wrapper">
	<!--Index Wrapper header Start-->
	<div class="page-header header-filter page-header-small skew-separator skew-mini">
		<div class="page-header-image" style="background-image: url('<?php _e($index_bg);?>');">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-7 mt-7 mr-auto text-left">
					<h3 class="title text-white"><?php _e($post_name);?></h3>
				</div>
			</div>
		</div>
		<!-- SVG separator Start-->
		<div class="separator separator-bottom separator-skew">
			<svg x="0" y="0" viewbox="0 0 2560 100" preserveaspectratio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
			<polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
			</svg>
		</div>
		<!-- SVG separator End-->
	</div>
	<!--Index Wrapper header End-->
	<!--Index Section Main Start-->
	<div class="section section-item section-info-panel">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 ">
					<div id="carouselAdIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<?php foreach($ad_content as $k=>$v){?>
							<?php if($v[0]){?>
							<li data-target="#carouselAdIndicators" data-slide-to="<?php _e($k);?>" <?php if($k==0){echo'class="active"';}?>></li>
							<?php }?>
							<?php }?>
						</ol>
						<div class="carousel-inner rounded">
							<?php foreach($ad_content as $k=>$v){?>
							<?php if($v[0]){?>
							<div class="carousel-item <?php if($k==0){echo'active';}?>" data-href="<?php _e($v[2]);?>">
								<img class="d-block w-100 rounded" src="<?php _e($v[1]);?>" alt="<?php _e($v[0]);?>" title="<?php _e($v[0]);?>">
							</div>
							<?php }?>
							<?php }?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 mx-auto">
					<h2 class="title"><?php _e($att_name);?></h2>
					<div class="stats">
						<div class="stars text-warning">
							<p class="d-inline" style="color: #757f7f;">
								<span class="badge badge-secondary"><?php _e($att_version);?></span>
								<span class="badge badge-secondary"><?php _e($att_type);?></span>
								<span class="badge badge-secondary"><?php _e($att_size);?></span>
							</p>
						</div>
					</div>
					<?php if($att_pay){?>
					<h2 class="main-price text-danger"><?php _e($att_price);?></h2>
					<?php }else{?>
					<h2 class="main-price text-success" style="line-height: 3rem;font-size: 1.2rem;">免费</h2>
					<?php }?>
	
					<p class="description" style="overflow :auto;height:55px;cursor: pointer;">
						<?php _e($att_desc);?>
					</p>
					<button 
					class="btn btn-primary btn-lg btn-block" 
					style="height:65px;font-size: 1.1rem;" 
					data-toggle="modal" 
					data-target="#modal-<?php if($att_pay){_e('pay');}else{_e('download');}?>">
					<i class="ni ni-cloud-download-95"> 立即下载</i>
					</button>
		
				</div>
			</div>
		</div>
	</div>
	<!--Index Section Main End-->
	<!--Index Help Start-->
	<div class="section related-products bg-secondary skew-separator skew-top">
		<div class="container">
			<div class="accordion-1">
				<div class="container">
					<div class="row">
						<div class="col-md-6 mx-auto text-center">
							<h2 class="title mb-3 mt-5" id="help">帮助与支持</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 ml-auto">
							<div class="accordion" id="accordionExample">
								
								<div class="card">
									<?php if($help_content){
										
										foreach($help_content as $k => $v){
									
									?>
									<?php if($v[0]){?>
									<div class="card-header" id="heading<?php _e($k);?>">
										<h5 class="mb-0">
										<button class="btn btn-link w-100 text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php _e($k);?>" aria-expanded="false" aria-controls="collapse<?php _e($k);?>">
                                            <?php _e($v[0]);?>
										<i class="ni ni-bold-down float-right pt-1"></i>
										</button>
										</h5>
									</div>
									<div id="collapse<?php _e($k);?>" class="collapse" aria-labelledby="heading<?php _e($k);?>" data-parent="#accordionExample" style="">
										<div class="card-body opacity-8"><?php _e($v[1]);?></div>
									</div>
									<?php }?>
									<?php }}?>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Index Help End-->
</div>
<!--Index Wrapper End-->
<!--Model Pay Start-->
<div class="modal fade" id="modal-pay" tabindex="-1" role="dialog" aria-labelledby="modal-pay" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-secondary shadow border-0 mb-0">
					<div class="card-header bg-white">
						<div class="text-muted text-center">
							<h6>扫码支付</h6>
						</div>
						<div class="btn-wrapper text-center">
							<h4 class="text-danger"><?php _e($att_price);?></h4>
						</div>
					</div>
					<div class="card-body px-lg-5 py-lg-5" style="padding-top:0rem!important;background: white;">
						<div class="row ">
							<div class="ml-auto mr-auto phoebe-pay-qrcode">
								<img class="d-block" src="<?php _e($qrcode_api);?>?service=QrCode.Png&size=5&data=<?php _e($current_url);?>/?phoebe_pay=1" alt="qrcode-pay">
							</div>
						</div>
						<p class="text-lg-center mt-3">
							<i class="fab fa-alipay icon-brand text-primary"></i>
							<i class="fab fa-weixin icon-brand text-success"></i>
							<i class="fab fa-qq icon-brand text-info"></i>
						</p>
						<div class="text-center text-muted mt-2">
							<h6>请备注名称和联系方式 <a href="#help"><i class="fa fa-question-circle-o text-primary" aria-hidden="true"></i></a></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Model Pay End-->
<!--Model Download Start-->
<div class="modal fade" id="modal-download" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-secondary shadow border-0 mb-0">
					<div class="card-header bg-white">
						<div class="text-muted text-center">
							<h6>链接与密码</h6>
						</div>
					</div>
					<div class="card-body px-lg-5 py-lg-5" style="padding-top:0rem!important;background: white;">
						<div class="tab-content mt-3 mb-3" style="overflow: auto;height: 150px;cursor: pointer;">
							<?php
							foreach($att_links as $k=>$v){
								if($v[1]){
							echo '
							<button type="button" class="btn btn-primary btn-lg btn-block download-btn" data-href="'.$v[1].'">'.$v[0].'</button>
							';
								}
							
							}?>
							
						</div>
						<div class="text-center text-muted mt-2" style="overflow: auto;height: 100px;cursor: pointer;">
							
							<?php if($att_comment){?>
							
							<?php if($curruser){?>
							<?php
							foreach($att_pass as $k=>$v){
									if($v){
							echo '
							<div class="alert alert-default" role="alert">
                             '.$v.'
							</div>
							';}}?>
							<?php }else{?>
							
							<div class="alert alert-success" role="alert">
                            密码评论可见，请前往文章评论。
							</div>
							
							<?php }?>
							
							
							<?php }else{?>
							
							<?php
							foreach($att_pass as $k=>$v){
								if($v){
							echo '
							<div class="alert alert-default" role="alert">
                             '.$v.'
							</div>
							';
							}}?>
							
							<?php }?>
							
							

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--Model Download End-->
<!--footer start-->
<footer class="footer">
<div class="container">
	<div class="row align-items-center justify-content-md-between">
		<div class="col-md-6">
			<div class="copyright">
                © <?php _e(date('Y'));?> <a href="/" target="_blank"><?php _e($blog_title);?></a>
			</div>
		</div>
	</div>
</div>
</footer>
</div>
<!--footer end-->
<!--Go Top-->
<button class="btn btn-primary btn-icon-only back-to-top" type="button" name="button">
  <i class="ni ni-bold-up"></i>
</button>
<!--Go Top-->
<!--   Core JS Files Start -->
<script src="<?php _e(plugin_dir_url( __FILE__ ) . 'js/jquery.min.js?v='.PHOEBE_VERSION);?>"></script>
<script src="<?php _e(plugin_dir_url( __FILE__ ) . 'js/popper.min.js?v='.PHOEBE_VERSION);?>"></script>
<script src="<?php _e(plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js?v='.PHOEBE_VERSION);?>"></script>
<script src="<?php _e(plugin_dir_url( __FILE__ ) . 'js/plugin.core.js?v='.PHOEBE_VERSION);?>"></script>
<!--   Core JS Files End -->
<!--   Init JS Start -->
<script>
    var big_image, navbar_initialized, didScroll, transparent = !0,
	transparentDemo = !0,
	fixedTop = !1,
	backgroundOrange = !1,
	toggle_initialized = !1,
	$datepicker = $(".datepicker"),
	$collapse = $(".navbar .collapse"),
	$html = $("html"),
	$tagsinput = $(".tagsinput");
function up(e) {
	document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1, document.getElementById("myNumber").value >= parseInt(e) && (document.getElementById("myNumber").value = e)
}
function down(e) {
	document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1, document.getElementById("myNumber").value <= parseInt(e) && (document.getElementById("myNumber").value = e)
}
function debounce(l, a, o) {
	var r;
	return function() {
		var e = this,
			t = arguments;
		clearTimeout(r), r = setTimeout(function() {
			r = null, o || l.apply(e, t)
		}, a), o && !r && l.apply(e, t)
	}
} - 1 < navigator.platform.indexOf("Win") ? ($(".wrapper .login-page, .register-page, .card").perfectScrollbar(), 0 != $(".tab-content .table-responsive").length && $(".table-responsive").each(function() {
	new PerfectScrollbar($(this)[0])
}), $html.addClass("perfect-scrollbar-on")) : $html.addClass("perfect-scrollbar-off"), $(document).ready(function() {
	$(".dropdown-menu a.dropdown-toggle").on("click", function(e) {
		var t = $(this),
			l = $(this).offsetParent(".dropdown-menu");
		return $(this).next().hasClass("show") || $(this).parents(".dropdown-menu").first().find(".show").removeClass("show"), $(this).next(".dropdown-menu").toggleClass("show"), $(this).closest("a").toggleClass("open"), $(this).parents("a.dropdown-item.dropdown.show").on("hidden.bs.dropdown", function(e) {
			$(".dropdown-menu .show").removeClass("show")
		}), l.parent().hasClass("navbar-nav") || t.next().css({
			top: t[0].offsetTop,
			left: l.outerWidth() - 4
		}), !1
	});
	var e;
	(e = $(".form-control")).length && e.on("focus blur", function(e) {
		$(this).parents(".form-group").toggleClass("focused", "focus" === e.type)
	}).trigger("blur");
	($(".headroom")[0]) && new Headroom(document.querySelector("#navbar-main"), {
		offset: 300,
		tolerance: {
			up: 30,
			down: 30
		}
	}).init();
	$("#choices-single-default")[0] && new Choices("#choices-single-default", {
		search: !1
	}), $("#choices-multiple-default")[0] && new Choices("#choices-multiple-default", {
		search: !0,
		delimiter: ",",
		editItems: !0,
		removeItemButton: !0
	}), $("#badges")[0] && new Choices("#badges", {
		delimiter: ",",
		editItems: !0,
		maxItems: 5,
		removeButton: !0,
		removeItemButton: !0
	});
	t = $('[data-toggle="popover"]'), l = "", t.length && t.each(function() {
		!
		function(e) {
			e.data("color") && (l = "popover-" + e.data("color"));
			var t = {
				trigger: "focus",
				template: '<div class="popover ' + l + '" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
			};
			e.popover(t)
		}($(this))
	});
	var t, l, a = $(".back-to-top");
	$(window).scroll(function() {
		300 < $(window).scrollTop() ? a.addClass("show") : a.removeClass("show")
	}), a.on("click", function(e) {
		e.preventDefault(), $("html, body").animate({
			scrollTop: 0
		}, "300")
	})
}), $(document).on("click", ".card-rotate .btn-rotate", function() {
	var e = $(this).closest(".rotating-card-container");
	e.hasClass("hover") ? e.removeClass("hover") : e.addClass("hover")
}), ArgonKit = {
	misc: {
		navbar_menu_visible: 0
	},
	checkScrollForTransparentNavbar: debounce(function() {
		$(document).scrollTop() > scroll_distance ? transparent && (transparent = !1, $(".navbar[color-on-scroll]").removeClass("navbar-transparent")) : transparent || (transparent = !0, $(".navbar[color-on-scroll]").addClass("navbar-transparent"))
	}, 17),
};  

$('body').on('click','.carousel-item',function(){
	var target = $(this).data('href');
	window.open(target);
})
$('body').on('click','.download-btn',function(){
	var target = $(this).data('href');
	window.open(target);
})

</script>
<!--   Init JS End -->
</body>
</html>