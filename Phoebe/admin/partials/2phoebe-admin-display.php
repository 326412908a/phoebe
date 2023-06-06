<?php
function create_admin_Page (){ 
$_PHOEBE_VERSION_ =	PHOEBE_VERSION;
$_ACCESS_IPS_ = PHOEBE_AUTH_IP;
$_ACCESS_DOMAIN_ = PHOEBE_AUTH_DOMIAN;
?>
<style>
.el-tabs{background:#fff!important;padding-left:1.8rem!important;margin-left:-5px!important;padding-right:1.8rem!important}.el-tabs__header{padding-top:20px!important}.el-form-item{margin-bottom:10px}.el-autocomplete{display:inherit!important}.time{font-size:13px;color:#999}.bottom{margin-top:13px;line-height:9pt}.vue-check-update{float:right!important;margin-top:-30px!important;margin-right:0!important}.image{width:100%;display:block}.clearfix:after,.clearfix:before{display:table;content:""}.clearfix:after{clear:both}.border-radius-3{border-radius:3px}.textarea{margin-top:20px;margin-bottom:10px;background:#aeb0b121;border-radius:4px;padding:10px;border-left:5px solid #b5b5b5}.simpline{text-decoration:none!important}.el-item-p-u{font-size:10px;color:#909498}.el-collapse-item__header{font-size:14px !important}
.demo-table-expand {font-size: 0;}.demo-table-expand label {color: #99a9bf;}.demo-table-expand .el-form-item {margin-right: 0;margin-bottom: 0;width: 50%;}
</style>
<script>
const _phoebe_version_ = '<?php _e($_PHOEBE_VERSION_);?>';
const _access_ips_ = '<?php _e($_ACCESS_IPS_);?>';
const _access_domain_ ='<?php _e($_ACCESS_DOMAIN_);?>';
const _wp_admin_url= '<?php _e(admin_url()); ?>';
</script>

<div id="Phoebe" class="wrap">
	<!-- 主要代码 -->
	<el-container>
	<el-header>
	<template>
	<el-tabs v-model="activeName" >
   
	<!--附件添加面板-->
	<el-tab-pane name="first">
	<span slot="label"><i class="el-icon-plus"></i> 附件添加</span>
	<el-col :xs="24" :sm="24" :md="24" :lg="10" :xl="10">
	<el-form :model="form" :rules="rules" ref="form" class="demo-ruleForm">
	<el-form-item label="选择文章" prop="post_id">
	<el-autocomplete  v-model="form.post_id" clearable :fetch-suggestions="querySearchAsync"  placeholder="选择或输入文章ID.." @select="handleSelect"></el-autocomplete>
	</el-form-item>
	<div class="textarea">
		选择或输入文章ID。
	</div>

	<el-form-item label="附件名称" prop="att_name">
	<el-input v-model="form.att_name" placeholder="附件的名称" clearable></el-input>
	</el-form-item>
		
	<el-collapse>
    <el-collapse-item title="详情编辑" name="1" style="font-size: 14px;">
    
	  <el-form-item label="附件类型">
	<el-input v-model="form.att_type" clearable placeholder="附件的类型">
	</el-input>
	</el-form-item>
	<el-form-item label="附件大小">
	<el-input v-model="form.att_size" clearable placeholder="附件的大小"></el-input>
	</el-form-item>
	<el-form-item label="附件版本">
	<el-input v-model="form.att_version" clearable placeholder="附件的版本信息"></el-input>
	</el-form-item>
	<el-form-item label="附件作者">
	<el-input v-model="form.att_author" clearable placeholder="附件作者"></el-input>
	</el-form-item>
	<el-form-item label="附件预览">
	<el-input v-model="form.att_preview_url" clearable placeholder="附件的预览地址"></el-input>
	</el-form-item>
	<el-form-item label="附件描述">
	<el-input type="textarea" v-model="form.att_description" placeholder="附件的简单描述"></el-input>
	</el-form-item> 
 
  </el-collapse-item>
   </el-collapse>	
   
	<el-form-item v-for="(domain, index) in form.att_links" :label="'下载链接' + index" :key="domain.key" :prop="'att_links.' + index + '.value'">
	<el-col>
	<el-input v-model="domain.value" placeholder="输入下载地址"></el-input>
	</el-col>
	<el-col>
	<el-button type="danger" plain @click.prevent="removeDomain(domain)" style="margin-top: 10px;">删除</el-button>
	</el-col>
	</el-form-item>
	<el-form-item>
	<el-button type="primary" plain @click="addDomain" style="margin-top: 10px;">新增下载链接</el-button>
	</el-form-item>
    <el-form-item label="附件密码">
	<el-input type="textarea" v-model="form.att_password" placeholder="附件的密码信息"></el-input>
	</el-form-item>
	<div class="textarea">
		如有多个密码请逐行填写，比如：百度网盘 xxxx 。
	</div>
	<el-form-item label="付费下载">
	<el-switch v-model="form.att_pay_require"></el-switch>
	<div v-if="form.att_pay_require==1" style="line-height: 25px;">
		<el-input v-model="form.att_pay_price" clearable placeholder="金额"></el-input> 
		<div class="textarea">
			付费下载暂支持设置多合一收款二维码。
		</div>
	</div>
	</el-form-item>

      
	<el-form-item label="密码评论可见">
	<el-switch v-model="form.att_pwd_cmt_require"></el-switch>
	</el-form-item>
	<el-form-item>
	<el-button type="primary" @click="attachsaved('form')" >保存</el-button>
	</el-form-item>
	</el-form>
	</el-col>
	</el-tab-pane>
	<!--附件添加面板结束-->
	<!--附件管理面板-->
	<el-tab-pane name="second">
	<span slot="label"><i class="el-icon-news"></i> 附件管理</span>
	<el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
	<template>
	<el-table ref="multipleTable" :data="tables.slice((attach.manage.currentPage-1)*attach.manage.pagesize,attach.manage.currentPage*attach.manage.pagesize)" tooltip-effect="dark" style="width: 100%">
	<!--折叠 -->
	<el-table-column type="expand">
	<template slot-scope="props">
	<el-form label-position="left" inline class="demo-table-expand">
	<el-form-item label="附件类型">
	<span>{{ props.row.att_type }}</span>
	</el-form-item>
	<el-form-item label="附件大小">
	<span>{{ props.row.att_size }}</span>
	</el-form-item>
	<el-form-item label="附件版本">
	<span>{{ props.row.att_version }}</span>
	</el-form-item>
	<el-form-item label="附件作者">
	<span>{{ props.row.att_author }}</span>
	</el-form-item>
	<el-form-item label="附件描述">
	<span>{{ props.row.att_description }}</span>
	</el-form-item>
	<el-form-item label="附件密码">
	<span>{{ props.row.att_password }}</span>
	</el-form-item>
	<el-form-item label="下载链接">
	<span>{{ props.row.att_links }}</span>
	</el-form-item>
	<el-form-item label="付费下载">
	<span>{{ props.row.att_pay_require }}</span>
	</el-form-item>
	<el-form-item label="售价">
	<span>{{ props.row.att_pay_price }}</span>
	</el-form-item>
	<el-form-item label="付费链接">
	<span>{{ props.row.att_pay_links }}</span>
	</el-form-item>
	<el-form-item label="评论可见">
	<span>{{ props.row.att_pwd_cmt_require }}</span>
	</el-form-item>
		
	<el-form-item label="预览地址">
	<span>{{ props.row.att_preview_url }}</span>
	</el-form-item>
		
	</el-form>
	</template>
	</el-table-column>
	<!-- 折叠-->
	<el-table-column type="index" width="50">
	</el-table-column>
	<el-table-column label="附件名称" sortable prop="att_name">
	</el-table-column>
	<el-table-column label="文章标题" sortable align="center" prop="post_name">
	</el-table-column>
	<el-table-column label="文章ID" sortable align="center" prop="post_id">
	</el-table-column>
	<el-table-column align="center" label="添加日期" sortable prop="att_add_time">
	</el-table-column>
	<el-table-column align="center" label="开启附件">
	<template slot-scope="scope">
	<el-switch v-model="scope.row.att_off" on-color="#00A854" off-color="#F04134" active-value ="on" inactive-value ="off" @change="listhandleSwitch(scope.row)"></el-switch>
	</template>
	</el-table-column>
	<el-table-column align="center">
	<template slot="header" slot-scope="scope">
	<el-input v-model="search" class="search-input" placeholder="输入关键字搜索">
	<i slot="suffix" class="el-input__icon el-icon-search" style=" margin-right: 10px;"></i>
	</el-input>
	</template>
	<template slot-scope="scope">
	<el-button size="mini" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
	<el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)">删除</el-button>
	</template>
	</el-table-column>
	</el-table>
	</template>
	<p>
		<el-pagination background :current-page="attach.manage.currentPage" @current-change="current_change" layout="total, prev, pager, next, jumper" :total="attach.manage.total">
		</el-pagination>
	</p>
	</el-col>
	<el-dialog title="附件编辑" :visible.sync="dialogFormVisible">
	<el-form :model="editForm">
	<el-form-item label="文章ID" :label-width="formLabelWidth">
	<el-input v-model="editForm.post_id" autocomplete="off" disabled></el-input>
	</el-form-item>
	<el-form-item label="附件名称" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_name" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="附件类型" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_type" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="附件大小" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_size" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="附件版本" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_version" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="附件作者" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_author" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="附件描述" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_description" type="textarea" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="附件预览" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_preview_url" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="下载地址" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_links" type="textarea" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="附件密码" :label-width="formLabelWidth">
	<el-input type="textarea" v-model="editForm.att_password" autocomplete="off"></el-input>
	</el-form-item>
	<hr>
	<el-form-item  label="是否付费">
	<el-switch active-value ="1" inactive-value ="0" v-model="editForm.att_pay_require"></el-switch>
	</el-form-item>
	<el-form-item v-if="editForm.att_pay_require==1" label="售价" :label-width="formLabelWidth">
	<el-input v-model="editForm.att_pay_price" autocomplete="off"></el-input>
	</el-form-item>
	<el-form-item label="密码评论可见">
	<el-switch active-value ="1" inactive-value ="0" v-model="editForm.att_pwd_cmt_require"></el-switch>
	</el-form-item>

	</el-form>
	<div slot="footer" class="dialog-footer">
		<el-button @click="dialogFormVisible = false">取 消</el-button>
		<el-button type="primary" @click="refreshPost()">确 定</el-button>
	</div>
	</el-dialog>
	</el-tab-pane>
	<!--附件管理面板结束-->
	<!--设置面板-->
	<el-tab-pane name="third">
	<span slot="label"><i class="el-icon-setting"></i> 设置</span>
	<el-col :xs="24" :sm="24" :md="24" :lg="10" :xl="10">
	<el-form :model="settingform">
	<el-form-item label="下载页主题">
	<template>
      
	<template>
	    <el-radio v-model="settingform.ui_theme" label="1">主题1</el-radio>
	    <el-radio v-model="settingform.ui_theme" label="2">主题2</el-radio>
        <el-radio v-model="settingform.ui_theme" label="3">主题3</el-radio>
	</template>
      
	</template>
	</el-form-item>
	<el-form-item label="数据导入">
	<el-button size="mini" plain type="primary" @click="handelDialogHisdataTable()" style="margin-left:15px;" icon="el-icon-upload2">开始导入</el-button>
	</el-form-item>
	<div class="textarea">
		数据导入功能暂支持lylaresdown及Easydownload插件历史附件数据的导入。
	</div>
	<!-- 导入面板--->
	<el-dialog title="待导入的数据" :visible.sync="dialogTableVisible">
	<el-table :data="historyData">
	<!--折叠 -->
	<el-table-column type="expand">
	<template slot-scope="props">
	<el-form label-position="left" inline class="demo-table-expand">
	<el-form-item label="附件类型">
	<span>{{ props.row.att_type }}</span>
	</el-form-item>
	<el-form-item label="附件大小">
	<span>{{ props.row.att_size }}</span>
	</el-form-item>
	<el-form-item label="附件版本">
	<span>{{ props.row.att_version }}</span>
	</el-form-item>
	<el-form-item label="附件作者">
	<span>{{ props.row.att_author }}</span>
	</el-form-item>
	<el-form-item label="附件描述">
	<span>{{ props.row.att_description }}</span>
	</el-form-item>
	<el-form-item label="附件密码">
	<span>{{ props.row.att_password }}</span>
	</el-form-item>
	<el-form-item label="下载链接">
	<span>{{ props.row.att_links }}</span>
	</el-form-item>
	<el-form-item label="付费下载">
	<span>{{ props.row.att_pay_require }}</span>
	</el-form-item>
	<el-form-item label="付费价格">
	<span>{{ props.row.att_pay_price }}</span>
	</el-form-item>
	<el-form-item label="付费链接">
	<span>{{ props.row.att_pay_links }}</span>
	</el-form-item>
	<el-form-item label="评论可见">
	<span>{{ props.row.att_pwd_cmt_require }}</span>
	</el-form-item>
	<el-form-item label="预览地址">
	<span>{{ props.row.att_preview_url }}</span>
	</el-form-item>
	</el-form>
	</template>
	</el-table-column>
	<!-- 折叠-->
	<el-table-column type="index" width="50">
	</el-table-column>
	<el-table-column label="附件名称" sortable prop="att_name">
	</el-table-column>
	<el-table-column label="文章标题" sortable align="center" prop="post_name">
	</el-table-column>
	<el-table-column label="文章ID" sortable align="center" prop="post_id">
	</el-table-column>
	<el-table-column align="center" label="添加日期" sortable prop="att_add_time">
	</el-table-column>
	</el-table>
	<div slot="footer" class="dialog-footer">
		<el-button @click="dialogTableVisible = false">取 消</el-button>
		<el-button type="primary" @click="migAllhisdata()">全部导入</el-button>
	</div>
	</el-dialog>
	<!-- 导入面板--->
	<el-form-item label="数据备份">
	<el-button size="mini" plain style="margin-left:15px;" icon="el-icon-download" disabled>开始备份</el-button>
	</el-form-item>
	<hr>
	<el-form-item label="广告">
	<el-switch v-model="settingform.ad_on" active-value ="1" inactive-value ="0"  @change="adchange($event)"></el-switch>
	</el-form-item>
	<div v-show="settingform.ad_on ==1">
	
	
	<p>
		<el-input id="ad_content" type="textarea" placeholder="多广告将在前台显示轮播效果" v-model="settingform.ad_content"></el-input>
	</p>
	<div class="textarea">
		广告按照：标题，图片链接，跳转链接逐行填写。
	</div>
	</div>
	
	<el-form-item label="帮助说明">
	</el-form-item>
	<p>
		<el-input id="doc_user_help" type="textarea" placeholder="帮助说明" v-model="settingform.doc_help"></el-input>
	</p>
	
	<el-form-item label="打赏&支付">
	<el-switch v-model="settingform.Reward_on" active-value ="1" inactive-value ="0"></el-switch>
	</el-form-item>
	<div v-show="settingform.Reward_on ==1">
	<p class="el-item-p-u">
		支付宝
	</p>
	<el-input id="picture_3" placeholder="支付宝二维码链接" v-model="settingform.alipay_Pic" class="input-with-select">
	<el-button slot="append" icon="el-icon-upload" class="primary" @click="getQrurl" ></el-button>
	</el-input>
	<p class="el-item-p-u">
		微信
	</p>
	<el-input id="picture_4" placeholder="微信二维码链接" v-model="settingform.wxpay_Pic" class="input-with-select">
	<el-button slot="append" icon="el-icon-upload" @click="getQrurl" ></el-button>
	</el-input>
	<p class="el-item-p-u">
		QQ
	</p>
	<el-input id="picture_4" placeholder="QQ二维码链接" v-model="settingform.qqpay_Pic" class="input-with-select">
	<el-button slot="append" icon="el-icon-upload" @click="getQrurl" ></el-button>
	</el-input>
	
	<div class="textarea">
		以上链接为二维码真实链接，不可使用图片链接，点击右侧按钮获取。
	</div>
	
	</div>
	
	<el-form-item label="系统通知">
	<el-switch v-model="settingform.msg_on" active-value="1" inactive-value="0" @change="msgChange($event)">
	</el-switch>
	</el-form-item>
	<div class="textarea">
		此通知用于接收插件动态。
	</div>

	<el-form-item>
	<el-button type="primary" @click="settingformSaved" style="margin-top:15px">保存</el-button>
	</el-form-item>
	</el-form>
	</el-col>
	</el-tab-pane>
	<!--设置面板结束-->
	<!--关于面板-->
	<el-tab-pane name="fourth" style="padding-bottom:20px">
	<span slot="label"><i class="el-icon-info"></i> 关于</span>
	<el-col :xs="24" :sm="24" :md="24" :lg="10" :xl="10">
	<h3>关于</h3>
	<template v-if="Phoebe.authorized==0">
	<el-alert title="您正在使用尚未授权的插件，插件无法正常使用，请获取正版。" type="error">
	</el-alert>
	</template>
	<p>
		<span style="font-weight: 700;">Phoebe</span>是一款使用Vue.js开发的Wordpress文章附件独立页下载插件。
	</p>
	<p>
		Phoebe为付费插件，在「未被破解」或「非法/盗版」使用前提下将提供为期至少一年的持续维护或更新。
	</p>
	<el-row>
	<el-col>
	<el-card :body-style="{ padding: '0px' }">
	<img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAUFBQUFBQUGBgUICAcICAsKCQkKCxEMDQwNDBEaEBMQEBMQGhcbFhUWGxcpIBwcICkvJyUnLzkzMzlHREddXX0BBQUFBQUFBQYGBQgIBwgICwoJCQoLEQwNDA0MERoQExAQExAaFxsWFRYbFykgHBwgKS8nJScvOTMzOUdER11dff/CABEIA+gF5gMBIgACEQEDEQH/xAAdAAEBAQEBAQEBAQEAAAAAAAAAAQIDBAUGCAcJ/9oACAEBAAAAAP4zAABYAACwAFihAUJYKASiLAFCDUhUqAsVAWAAAAAAAAIoFgABYAWACwLLYIoAAubKCUBKlQVKAIFgFgqAAAAAAAAAAAKhqEFgCkWWLKIKANZAAAAEUllANZlCLFgBZYWAAAAAAAAAAACwVLAolSggoAABKAAAJRrMKBKCKQWWVAAAAAAAACoAWFhvAVFhUCoUAABFAAABKIpKAAA9XlCWAWFEAbwAAAABNSwFgWAsAAFCLBQhVgIqwBKLlbAAlAAevyAAQFRYBYAAAAAAA93hABYAAsAAAKLlQAAAWACKG8BFBKQAAWWBYAAAAAACwFgALCoKgBSWWKAAlAAAAAAAJQAEoFyFSxUayAAAAAWCwWALKjWRSWCxQiggKqCVKigAWAAACwlCKCVAC3NgqAAAFgAAG8ABUAWLLKSwKihKAAAAsJQAItgAAQoQUEBYAAAFgAAHXGQFQAAAAUlSgAIoBKAAAAAOnMSopYsBKlig9XkAWFgAAAAAAAAFgBUFLkWKlARRYSunMEoAAABrICwEUACKEBYAAAAAAAAAVFgpAoEoRQAAFhYAAALABYALBKASt4NZhZYWbxYAAAAABYABrIAAqVKJYsqBRKSg1kFglAAAAAACKACACwAAAAAAAsAFgABRLAoAAJqSgAAAAAAAACUEUQWABSFgAAAAABUKIKAAJQSgAD0ecTUN5gAAWenliWAAAAAFglRYVFQKQAAAAFQAsBZY1EsoBvAAAAAABc0sLAAsSio1lc0B15AllSksVK1gAAAsAACwLAVBSVBZRFSgCUACKCwAWBYCUAFgAASoogVFRUsAAAAAACwqKQBUCghQIoayAAFQABUAAAABrISkoAR+r/KoAAAAJqAAWAFlRUFALvmJenMazYAALAGsgAAACoLAAAAAACCwFgAAAABYAKhQIKALAIUAWALAFIAAFQFgAALAEURSxAAABZvAAAWAsFshYFTUIUAAAAsACwsqACwWAFgAAAEWLFioWAAWAAAAsFhRFBLKCxr0+QAALAA3lAFhYayAFRU3gABKAAARQRSGoIFgAAAWFErWSKQoAAAAXNALKgTUWAALAAB9H5xvA1mWwARQACKQFQAAAALFRYGs2FiooayASgABQhUBYsVFRUCoAAAAAAD3eKHXiDpzAAAAACoKgApFALCUsLAPqfLACosAqCoWCykAAAFgAlQoAIBYAABYAAFgqaiBQigCUAGsgWApAFhUspABrIOnMAAAAllAEAVAAWA1kAdeQqayBYAsoShYEKALCoCoCiKIFiiFlgsFQKIA0yIKEoEALAAAazthQQVFhRCgAayAAABbkAAApBUBW+YAAAAAlCFBPR51EXrxAAFgKAQFBKB+g+BlW8AAAWALAABUsWVAqWAbwFgAAAABKBFQALAWABUAAWFlCUBLc0ABYAKgAtiVL05LALFgogAAAAAA1kIoQUQAACuvPIBZYWKAAAAAACkADUiyhAB1xIWAAACwAlLmkWAsLNZFuQqAAWBQCKWAlDpzCUAAAAAKgFQWAPd4oKhUVAAAAB24gEoiwLrAA9XlABWsyiUACLKsAAAAABUAChAAKQohQiwAAASt+nxgBAAAOucxYFhYUSmsghQAVA1kBYABUVKQVFCFgKikCwr3eAABYACKE6YJU6a42FBLvmALCwqCwqKlAAAAAsCwVABULFBKIqKCayKgAAAAAJQQAsAABUpFIohUoBYAoAQWFI9HnspCypZQABZChAFEFELABKCFABKRUBYAKEohqCFAAABvIgAodeNBKIKAllCLKEtyCiBY6c6hZ6/IABCypUAAAAFAAACWWwLmiwAsFAJQARQAayQKRQT7nw1AgAAAEoAIFQAAOnMKLIKAS2AAAAFQpFIFlJSBQIALFSoChAFIG+nAAWAQqLCoAAAFBFCUAAACUALBZYAAFgsbxSBQigIsKQWAWAAll3gAQAAAACgAAAigFgFQqCiChCkoIUCKAAEUIUQWBSWUge3xwAAI+j84AAApFABKEoAA3gWAKj6nyywWLHq8tJUsqwlSwolQoIpAojr6/n2AAJUUgKJ34AAALYAAsAAAACxTWFIBYFRUpLKEVYlABKELclSoAWAD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ApLFgATeQlSt4BCpvKAAenzAARRAANXIAAACwCghUqN5Sh242AACyhFQBRAFIJQikUBB6POpACUBKQKIAUABYAFgLFayhSKd+ARQbzAprAsagBLCoVKhvAABKSoUQWAAAAAQAKAAAA7cSwKICoUBKSlzQAFQCoAFgAABADpgIsBKWAAhUsCxYFAAAFgFEVAKhRFA3gAAAN4FiwBYLAACWVAVKEsAAAAhSFiwKAAADphKEKAAS2S2BrIFgAWAayFik1IAWBYSopAogGsiwSgEVFioFRQAWVACxQALASgAG8ayJQqVFCKQVNZKgAAJUpFQ6YIspAWAAlCUBAoWAFgDrzCAsqKAAVCUAACywAAKQAAStZSgJQCAFgAAIVAsFFuQFgACwKgUBBQAlCWwAALLLAAAABFlAigSwApAEpKSkAsKAApAevyALKgKN87CgIoARQALABYAAABYAgqF1gAAAIUCCwFAAFgAAAKnblKIVKRQACwFgCypYACUBKAARYBYABKRQBAAKWLAFgAA+n8wFS+vxlSosWUAAlCwVAFgBYLc2ARUoIogKgAAARYUQCpQAFgAUQBUpBQABFAAAFgALKgAJUolCFEAWADtxlAAIABbALAAqLCwWBZYBYpFlJQABYAAAALAACKCFm8LAsAAWAIqVcioGoAAFgBUAWFQFlAllAASglD1eUEo1kABLLvn7vLiAWDWaTf3fz4CwRQiooQACgASgKgAsACoUgsWVLDeQAsBvAHTmhQlSgShAKEWCwIosEoSkGs1ABQABZUN4WALFioCiWCxQH0vmgBYACwAAAAAuVCVFQAFQA1gqBYAKACwAWAACkKAAEoBYVFgAAsPR55RKAAAAIAAAAlbxACywsFAAAACoAUiygAAAJRYAA6cw1k1kAASgAE1IUgAAsACKikWVKAAAAKgpFbwbw1kAASgABYAAALEUBKlRTpzSpvJCoABFBKQAAFAAAALABYpN5JUDciFAAAAAAAEoAlAlECyxSAACUAEsACgAAABYevjysFASoqUAFgABUAAAAAAi6yno4RYssBYCoCoASiKgKAAAAOvIqBYoAJZVgG8TryoWAsAGsiwLAlARQRQQKRYWCxUAJYoQAKFgHo581j1dPCBSCgJZYoQoALAAAAv2/i5AAAAlEN5SoqLAAALAACWAKAAAWCoAoSoVHTASgernxAn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" class="image">
	<div style="padding: 14px;">
		<span style="font-size: 18px; font-weight: 600; color: #1e262a;">Phoebe</span>
		<div class="bottom clearfix">
			<time class="time">最新版本：<span style="color:#F56C6C">{{Phoebe.newVersion}}</span> &nbsp;&nbsp;当前版本：{{Phoebe.currVersion}} </time>
			<span id="copy-or-update-area">
			<el-button id="update-button" disabled="disabled" type="primary" icon="el-icon-refresh" class="vue-check-update" @click="get_update()">立即更新</el-button>
			</span>
		</div>
	</div>
	</el-card>
	</el-col>
	</el-row>
	<h3>支持&帮助</h3>
	<p>
		任何问题或反馈请前往<a class="simpline" href="https://" target="_blank">插件主页</a>或关注作者<a class="simpline" href="https://www.lylares.com/" target="_blank">博客</a>。
	</p>
	<h4>在线反馈</h4>

	<el-row>
	<el-col>
	<el-card :body-style="{ padding: '0px'}">
	<div style="padding: 14px;">
		<span style="font-size: 14px; font-weight: 600; color: #1e262a;" v-if="Phoebe.authorized==1">感谢您对正版Phoebe插件的支持！</span>
		<span style="font-size: 14px; font-weight: 600; color: #1e262a;" v-else>请购买正版插件！</span>
		<div class="bottom clearfix">
			<!-- 版权信息不可移除或修改-->
			<time class="time" id="phoebeCopyright">© <a rel="nofollow" href="https://www.lylares.com/" target="_blank" class="simpline">LYLARES'S BLOG</a> All RIGHTS RESERVED.</time>
			<!-- 版权信息不可移除或修改 -->
		</div>
	</div>
	</el-card>
	</el-col>
	</el-row>
	</el-col>
	</el-tab-pane>
	<!--关于面板结束-->
	</el-tabs>
	</template>
	</el-header>
	</el-container>
	<!-- 主要代码 -->
</div>
<!--   Core JS Files   -->
<script src="https://unpkg.com/element-ui/lib/index.js"></script> 
<script src="<?php _e(plugin_dir_url( __FILE__ ) . 'js/md5.js');?>"></script>
<script src="<?php _e(plugin_dir_url( __FILE__ ) . 'js/main.js');?>"></script>
<script src="<?php _e(plugin_dir_url( __FILE__ ) . 'js/core.js?v='.PHOEBE_VERSION);?>"></script>
<?php
}


