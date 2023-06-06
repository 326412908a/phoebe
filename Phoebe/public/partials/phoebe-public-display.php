<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$public_api = $sets->public_api;
$default_img = $public_api.'?service=App.Bing.Images&w=1920&h=1080';
$phoebe_theme = $sets->theme;
$index_bg = $sets->index_bg;
$index_bg = !empty($sets->index_bg) ? $index_bg : $default_img;
/////
$ad_on = $sets->ad_on;
$reward_on = $sets->reward_on;
$alipay_pic = $sets->alipay_pic;
$wxpay_pic = $sets->wxpay_pic;
$help_content = $sets->help_content;
$help_content= explode(PHP_EOL,$help_content);
$help_content = array_chunk($help_content,2);
//
$ad_content = $sets->ad_content;
$ad_content= explode(PHP_EOL,$ad_content);
$ad_content = array_chunk($ad_content,3);
$post_name = $posts->post_name;
$att_name = $posts->att_name;
$att_type = $posts->att_type;
$att_size = $posts->att_size;
$att_version = 'v '.$posts->att_version;
$att_author = $posts->att_author;
$att_desc = $posts->att_desc;
$att_pass = $posts->att_pass;
$att_pass= explode(PHP_EOL, $att_pass);
$att_links = $posts->att_links;
$att_links_arr = explode(PHP_EOL, $att_links);
$att_links = array_chunk($att_links_arr,2);
$att_pay = $posts->att_pay;
$att_price = '¥'.$posts->att_price;
$att_comment = $posts->att_comment;
$att_preview = $posts->att_preview;
$att_off = $posts->att_off;
$att_add_time = date('Y-m-d',strtotime($posts->att_add_time));
/////
if($phoebe_theme){
	include('phoebe-theme-'.$phoebe_theme.'.php');
}else{
	include('phoebe-theme-2.php');
}

