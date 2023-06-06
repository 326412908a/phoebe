const _AUTH_TOKEN_ = '';
const _INIT_ ={
          accessKey:'',
          currHost:window.location.host,
          currIP:window.PB.accessip,

};

const _default_ = {
          nonce:phoebe_framework.nonce,
          _wp_admin_url:window.PB.adminurl,
          copytips:'https://support.lylares.com/copyright.html',
          updateApi:'https://support.lylares.com/api/check/version',
          userfeedApi:'https://support.lylares.com/api/user/feedback',
          auth:md5(_INIT_.currHost+ '$dfhgu3479&%$' +_INIT_.accessKey + '$3479fdhjdfjh&%+$' + _INIT_.currIP + '$fdhjfgdfj4@%$'),
          api:'',
          router:'',
          init:function(){if(this.auth===_AUTH_TOKEN_){this.router =phoebe_framework.route;
              
          }else{
              //this.router =this.api;
              this.router =phoebe_framework.route;
              var x = document.getElementById("wpbody-content");console.log('授权本地校验不通过');
              //x.innerHTML = '<div class="editor-notices"><div class="notice inline notice-warning is-dismissible"><p>你正在尝试启用盗版Phoebe,请尊重作者劳动成果，使用正版插件，<a href="https://www.lylares.com/phoebe.html" target="_blank">购买正版</a></p></div></div>';
              }},
          };

_default_.init();
const PHOEBE_INIT= {    
    init:_default_.router,
    genRooter:function(){this.init = this.init;}
};

const  PHOEBE_API = {
  nonce:_default_.nonce,
  wp_admin_url:_default_._wp_admin_url,
  rooter:PHOEBE_INIT.init,
  add_attach: PHOEBE_INIT.init + 'vue/phoebe/v1/add_attachment',
  get_phoebe_settings:PHOEBE_INIT.init + 'vue/phoebe/v1/get_phoebe_settings',
  get_attachlist:PHOEBE_INIT.init + 'vue/phoebe/v1/get_attachlist',
  get_rencentposts:PHOEBE_INIT.init + 'vue/phoebe/v1/get_rencentposts',
  update_hisdata:PHOEBE_INIT.init + 'vue/phoebe/v1/update_hisdata',
  get_hisdata:PHOEBE_INIT.init + 'vue/phoebe/v1/get_hisdata',
  refresh_attachment:PHOEBE_INIT.init + 'vue/phoebe/v1/refresh_attachment',
  update_phoebe_settings:PHOEBE_INIT.init + 'vue/phoebe/v1/update_phoebe_settings',
  get_phoebe_settings:PHOEBE_INIT.init + 'vue/phoebe/v1/get_phoebe_settings',
  update_phoebe_settings:PHOEBE_INIT.init + 'vue/phoebe/v1/update_phoebe_settings',
};   
function get_pics(_pic_ids){
     	window.send_to_editor = function(html) {
		  imgurl = jQuery('img',html).attr('src');
          var idarray = _pic_ids.split("_");
          var _id = idarray[idarray.length - 1];
		jQuery('input[id ="picture_'+_id+'"').val(imgurl);
		tb_remove();
	}
};

jQuery(document).ready(function() {
    jQuery("button[id^='pic_upload_']").each(function (index,element) {
    jQuery(this).click(function(index,element) {
        const _pic_ids = jQuery(this).attr("id");
		formfield = jQuery('#upload_image').attr('name');
		tb_show('',PHOEBE_API.wp_admin_url+'media-upload.php?type=image&amp;TB_iframe=true');
        get_pics(_pic_ids);
		return false;
	    });
    });	
});