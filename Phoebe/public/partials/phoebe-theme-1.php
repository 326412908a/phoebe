<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="<?php _e(plugin_dir_url( __FILE__ ) . 'css/init.css');?>">
<link rel="stylesheet" href="<?php _e(plugin_dir_url( __FILE__ ) . 'css/color-brewer.css');?>">
<title><?php _e($post_name);?>| 附件下载</title>
<meta name="description" content="">
<link rel="shortcut icon" href="favicon.ico">
<link href="<?php _e(plugin_dir_url( __FILE__ ) . 'css/main.css');?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php _e(plugin_dir_url( __FILE__ ) . 'css/zh-CN.f541aff.css');?>">
<style>.card{height:8rem!important;padding-top:2rem}.icon{font-size:26px;color:#8894a0;line-height:2.5rem}.attach-info{line-height:2rem;color:#8894a0}.attach-title{font-size:1rem!important;margin:0!important}.page-guide{padding-left:0!important}@media (max-width:768px){.page-guide{padding:55px 30px 95px!important}}.footer{padding:40px 150px;padding-bottom:10px;margin-top:-200px!important;height:200px!important}.card[data-v-7aed89bc]{border-radius:4px;background:#9e9e9e29}.border-radius-3{border-radius:3px}.mb-ad-1{display:none!important}@media (max-width:768px){div[data-v-7aed89bc]{margin-top:10px}.page-component .side-nav{padding-top:0;padding-left:10px}.page-component__nav{display:none}.page-component__content{margin-top:20px}}.mb-ad-1{display:block}.el-input-group__append{cursor:pointer}
</style>
</head>
<body class="is-component">
<div id="app" class="is-component">
	<div data-v-440f0884="" class="headerWrapper">
		<header data-v-440f0884="" class="header">
		<div data-v-440f0884="" class="container">
			<h1 data-v-440f0884="">
                <a data-v-440f0884="" href="/" class="router-link-active" style="font-size: 22px;
      color: #409eff;">
                 <?php _e($blog_title);?>
                </a>
              </h1>
			<ul data-v-440f0884="" class="nav">
				<li data-v-440f0884="" class="nav-item"><a data-v-440f0884="" href="#" class="active">附件
				</a></li>
				<li data-v-440f0884="" class="nav-item"><a data-v-440f0884="" href="/?p=<?php _e($post_id);?>" class="">返回文章
				</a></li>
   
			</ul>
		</div>
		</header>
	</div>
	<div class="main-cnt">
		<div class="page-component__scroll el-scrollbar">
			<div class="el-scrollbar__wrap el-scrollbar__wrap--hidden-default">
				<div class="el-scrollbar__view">
					<div class="page-container page-component">
						<div class="page-component__nav el-scrollbar">
							<div class="el-scrollbar__wrap el-scrollbar__wrap--hidden-default">
								<div class="el-scrollbar__view">
									<div class="side-nav" style="opacity: 1;">
										<ul>
											<li class="nav-item sponsors"> <?php if($ad_on){?><a>赞助商</a><?}?>
                                                <ul class="pure-menu-list sub-nav" style="height: auto;">
                                                <?php if($ad_on){?>
                                                    <li class="nav-item">
                                                      <a href="<?php _e($ad_targeturl_1);?>" target="_blank" class="sponsor">
                                                        <img class="border-radius-3" src="<?php _e($ad_pic_1);?>"  alt="" style="width:100%">
                                                      </a>
                                                    </li>
                                                  <? }?>
                                                </ul>
                                                </li>
                                                <li class="nav-item"><!----><!----><a href="" class="router-link-exact-active active">附件信息</a><!----><!----></li>
                                                <li class="nav-item"><!----><!----><a href="#downlinks" class="">附件下载</a><!----><!----></li>
                                            </ul>
											<!----></li>
										
                                            
										</ul>
									</div>
								</div>
							</div>
						
						</div>
				        <a href="<?php _e($ad_targeturl_1);?>" target="_blank" class="sponsor mb-ad-1">
                            <img src="<?php _e($ad_pic_1);?>"  alt="" style="width:100%">
                        </a>
						<div class="page-component__content">
							<section class="content element-doc content">

                                    <h2 id="info"><?php _e($att_name);?></h2>
                                    <p>最近更新: <?php _e($att_add_time);?></p>
                                      <div data-v-7aed89bc="" class="cards el-row" style="margin-left: -7px; margin-right: -7px;margin-bottom:10px">
                                          <div data-v-7aed89bc="" class="el-col el-col-24 el-col-xs-12 el-col-sm-6" style="padding-left: 7px; padding-right: 7px;">
                                              <div data-v-7aed89bc="" class="card">
                                                  <i class="el-icon-info icon"></i>
                                                  <h4 class="attach-title">大小</h4>
                                                  <span class="attach-info"><?php _e($att_size);?></span>
                                              </div>
                                          </div>
                                          <div data-v-7aed89bc="" class="el-col el-col-24 el-col-xs-12 el-col-sm-6" style="padding-left: 7px; padding-right: 7px;">
                                              <div data-v-7aed89bc="" class="card">
                                                <i class="el-icon-document icon"></i>
                                                  <h4 class="attach-title">类型</h4>
                                                  <span class="attach-info"><?php _e($att_type);?></span>
                                              </div>
                                          </div>
                                          <div data-v-7aed89bc="" class="el-col el-col-24 el-col-xs-12 el-col-sm-6" style="padding-left: 7px; padding-right: 7px;">
                                              <div data-v-7aed89bc="" class="card">
                                                <i class="el-icon-refresh icon"></i>
                                                  <h4 class="attach-title">版本</h4>
                                                  <span class="attach-info">v<?php _e($att_version);?></span>
                                              </div>
                                          </div>
                                          <div data-v-7aed89bc="" class="el-col el-col-24 el-col-xs-12 el-col-sm-6" style="padding-left: 7px; padding-right: 7px;">
                                              <div data-v-7aed89bc="" class="card">
                                                <i class="el-icon-arrow-up icon"></i>
                                                  <h4 data-v-7aed89bc="" class="attach-title">作者</h4>
                                                  <span class="attach-info"><?php _e($att_author);?></span>
                                              </div>
                                          </div>
                                      </div>
                                      <p  id="downlinks"><?php _e($att_description);?></p>
                                      <p>
                                        <?php if($ad_on){?>
                                          <a href="<?php _e($ad_targeturl_2);?>" target="_blank">
                                             <img class="border-radius-3" src="<?php _e($ad_pic_2) ;?>" alt="" style="width:100%;max-height: 150px;">
                                          </a>
                                        <?php }?>
                                      </p>
              
                                      <h3>附件下载</h3>
                                      <ul data-v-7aed89bc="">
                                        <?php
                                        if($att_pay_require){?>
                                        
                                        <li data-v-7aed89bc="">
										<strong data-v-7aed89bc="">
										<a href="<?php _e($att_pay_links);?>" target="_blank">付费下载</a></strong></li>
										  
										  
										  
										<?php }elseif($att_pcode_require){?>
										  
										  
										                 <div style="margin-top: 15px;margin-left: -16px;" id="phoebe-pcode-area">
															 <div class="el-input el-input-group el-input-group--append">
																 <input type="text" autocomplete="off" placeholder="请输入提取码" class="el-input__inner" id="pcode_user_input">
																 <div class="btn btn-primary el-input-group__append" id="pcode_check">提交</div>
															 </div>
										                       </div>
                                        
                                        <?php }else{?>
                                        
                                        <?php

                                        foreach($links as $k => $v){
                                        $_n = $k+1;
                                        if($v){
                                        
                                        echo'<li data-v-7aed89bc=""><strong data-v-7aed89bc=""><a href="'.$v.'" target="_blank">下载地址'.$_n.'</a></strong></li>';
                                        
                                        }
                                        
                                        }?>

                                       <?php }?>

                                      </ul>
                                      <h3 data-v-7aed89bc="">密码信息</h3>
                                      <ul data-v-7aed89bc="">
                                        <?php if($att_pwd_cmt_require){?>
                                        
                                        <?php if($curruser){?>
										
										<?php foreach($att_password as $key=>$v){?>
										
                                        <li data-v-7aed89bc=""><strong data-v-7aed89bc=""><?php _e($v);?></strong></li>
										
										<?php }?>
										
                                        <?php }else{?>
										
                                        <li data-v-7aed89bc=""><strong data-v-7aed89bc="">评论通过后密码在此显示，<a href="/?p=<?php _e($post_id);?>" target="_blank">去评论</a></strong></li>
										
                                        <?php } ?>
                                        
                                        <?php }else{?>
										
                                        <?php foreach($att_password as $key=>$v){?>
										
                                        <li data-v-7aed89bc=""><strong data-v-7aed89bc=""><?php _e($v);?></strong></li>
										
										<?php }?>
										  
                                        <?php } ?>
                                      </ul>
                                      

						
							</section>
						
						</div>
						<div class="page-component-up" style="">
							<i class="el-icon-caret-top"></i>
						</div>
					</div>
				</div>
			</div>
			<div class="el-scrollbar__bar is-horizontal">
				<div class="el-scrollbar__thumb" style="transform: translateX(0%);">
				</div>
			</div>
			<div class="el-scrollbar__bar is-vertical">
				<div class="el-scrollbar__thumb" style="height: 28.757%; transform: translateY(118.023%);">
				</div>
			</div>
		</div>
	</div>
	<!---->
</div>
<script src="https://cdn.bootcss.com/jquery/3.4.0/jquery.min.js"></script>
<script>
const _PHOREBE_ ={
	  post_id:'<?php _e($post_id);?>',
     api:''
	}

$("body").on("click",".el-icon-caret-top",function(){   
  //backTop ();
});
 
$("body").on("click","#pcode_check",function(){  
	var pcode = $("#pcode_user_input").val();
  pcode_check(pcode);
});
function pcode_check(parm){
	
	  $.ajax({
			type: "POST",
			url: "/wp-json/vue/phoebe/v1/get_attachinfo",
			contentType: "application/x-www-form-urlencoded; charset=utf-8",
			dataTpye: 'json',
			data: JSON.stringify({post_id:_PHOREBE_.post_id,pcode:parm}),
			success: function(cb) {
			if(cb.code==1)
			{
				
				
			 var linksArray =cb.data.split("$"),_html='';

				linksArray.forEach(function(value,index,array){
	            
				if(value){
			     _html += 
				'<li class="list-group-item">'+
					'<i class="phoebe-icons icon-link-72 phoebe-text-blue"></i>'+
						'<a class="phoebe-text-violet" href="'+ value +'">下载地址'+(index+1)+'</a>'+
				'</li>';
				}
                });	
				
              $("#phoebe-pcode-area").html(_html);

			}else{
				
				alert("提取码有误，请重新输入！");
				
			}

			},
			error: function(request) {
			},
		})
	
	
}
function backTop () {
  window.scrollBy(0, -100)

  scrolldelay = setTimeout('backTop()', 10)

  var sTop = document.documentElement.scrollTop + document.body.scrollTop

  if (sTop === 0) {
    clearTimeout(scrolldelay)
  }
}
</script>
</body>
</html>