var vue_rest = new Vue({
        el: "#PhoebeMain",
        data() {
          return { 
    activePanel:'Panel-newadd',
    addform: {
      post_id:'',
      att_name: '',
      activeNames: ['1'],
      att_type: '',
      att_size: '',
      att_version:'',
      att_author:'',
      att_preview:'',
      att_pay: false,
      att_price:'',
      att_comment:false,
      att_desc: '',
      att_pass:'',
      att_links:'',
    },
    historyData:{
      post_id:'',
      att_name: '',
      att_type: '',
      att_size: '',
      att_version:'',
      att_author:'',
      att_preview:'',
      att_pay: false,
      att_price:'',
      att_comment:false,
      att_desc: '',
      att_pass:'',
      att_links:'',
    },
    dialogTableVisible:false,
    dialogEditFormVisible:false,
    formLabelWidth:'',
    editForm:{
      post_id:'',
      att_name: '',
      att_type: '',
      att_size: '',
      att_version:'',
      att_author:'',
      att_preview:'',
      att_pay: false,
      att_price:'',
      att_comment:false,
      att_desc: '',
      att_pass:'',
      att_links:'',
    },
    addformrules: {
      post_id: [
      { required: true, message: '请选择文章或输入文章ID', trigger: 'blur' },
      ],
      att_name: [
      { required: true, message: '请输入附件名称', trigger: 'blur' }
      ],
    },
    settingsform:{
      theme:'1',
      index_bg:'',
      msg_on:'0',
      ad_on:'0',
      ad_content:'',
      help_content:'',
      rewards_on:'0',
      alipay_url:'',
      wxpay_url:'',
      qqpay_url:'',
      public_api:'',
      AppKey:''
    },
    helpform:{
      feedback:''
    },
    search: '',
    attach:{
      tableData: [],
      manage:{
        multipleSelection: [],
        total: 0,
        pagesize:10,
        currentPage:1,
        tableDataName:'',
        tableDataEnd:[],
        filterTableDataEnd:[],
        flag:false
      },
    },
    Phoebe:{
      authorized:'',
      newVersion:'',
      currVersion: PB.version,
      sourceUrls:'',
      qrcodeAPI:''
    },
    qrdialogVisible:false,
  }
      },
      beforeRouteEnter(){

      },
      created(){
      	var the = this;
        //附件列表初始化
         let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/get_attachlist','',config)
         .then(response=>{
         	var cb = response.data
         	 if(cb.code==1){
              the.attach.tableData = cb.data;
              the.attach.manage.total =  cb.data.length;
            }

         })
         .catch(({err}) => {
           
         }) ;
        
        //系统设置初始化  
        axios.post(phoebe_framework.route + 'vue/phoebe/v1/get_phoebe_settings','',config)
         .then(response=>{
         	var cb = response.data
         	 if(cb.code==1)
            the.settingsform = cb.data;

         })
         .catch(({err}) => {
           //f.onError()
         }); 
      },
      methods: {
      //新增附件
        attachsaved(form){
          var the = this; 
          the.$refs[form].validate((valid) => {
          if (valid){
          	
          	let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/add_attachment',JSON.stringify(the._data.addform),config)
         .then(response=>{
         	var cb = response.data
         	
         	if(cb.code==1){
                the.$notify({
                  title: '保存成功',
                  message: cb.msg,
                  type: 'success',
                  position: 'bottom-right'
                });
                window.location.href = window.location.href;
              }else{
                the.$notify({
                  title: '保存失败',
                  message: cb.msg,
                  type: 'warning',
                  position: 'bottom-right'
                });
              }

         })
         .catch(({err}) => {
           
         }) ;
          	
   
          }else{
            the.$notify({
                  title: '提示',
                  message: '请检查必须的表单项。',
                  type: 'warning',
                  position: 'bottom-right'
                });
            return false;
          }
        });
      },
      //附件添加-下载链接管理
	  removeDomain(item){
        var index = this.addform.att_links.indexOf(item)
        if (index !== -1) {
          this.addform.att_links.splice(index, 1)
        }
      },
      addDomain() {
        this.addform.att_links.push({
          value: '',
          key: Date.now()
        });
      },
      //附件添加-文章建议
	    loadPosts() {
        var the = this;
        let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/get_rencentposts','',config)
         .then(response=>{
         	var cb = response.data
         	 the.posts = cb.data;
         })
         .catch(({err}) => {
         }) ;
      },
      //附件添加-文章搜索
	    postQuerySearch(queryString, cb){
        var posts = this.posts;
        var results = queryString ? posts.filter(this.createPostFilter(queryString)) : posts;
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
          cb(results);
        }, 1000 * Math.random());
      },
      createPostFilter(queryString) {
        return (state) => {
          return (state.value.toLowerCase().indexOf(queryString.toLowerCase()) === 0);
        
        };
      },
      //新增附件-文章ID添加  
      addhandleSelect(item) {
        $("#addform-id-input").val(item.value +'('+ item.id +')');
        this.addform.post_id = item.value +'('+ item.id +')';
        $("#addform-id-input").focus();
      },
      //附件编辑
      refreshPost(){
      	var the = this;
        let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/refresh_attachment?action=update',this.editForm,config)
         .then(response=>{
         	var cb = response.data
         	
         	console.log(cb);
         	if(cb.code==1){
              the.$notify({
                type: 'success',
                message: cb.msg,
                position: 'bottom-right'
              });        
              
            }else{
              the.$notify({
                type: 'warning',
                message: cb.msg,
                position: 'bottom-right'
              });         
            };
            the.dialogEditFormVisible = false;
         })
         .catch(({err}) => {
         }) ;
      	
      },
      //弹出导入表单
      dialogHisdataTable(){
        var the = this;
        let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/get_hisdata','',config)
         .then(response=>{
         	var cb = response.data
         	if(cb.code==1){
              the.historyData = cb.data;        
              the.dialogTableVisible =true;
            }else{
              the.$notify({
                type: 'warning',
                message: '未查询到历史数据!',
                position: 'bottom-right'
              });         
            }
         })
         .catch(({err}) => {
         }) ;
      }, 
      //全部导入
      migAllhisdata(){
        var the = this;
        the.$confirm('此操作将在导入历史数据后永久删除历史数据, 是否继续?', '注意事项', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
        	
          let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/update_hisdata?action=migrate','',config)
         .then(response=>{
         	var cb = response.data
         	if(cb.code==1){
                the.$notify({
                  type: 'success',
                  message: '导入成功!',
                  position: 'bottom-right'
                });
              }else{     
                the.$notify({
                  type: 'warning',
                  message: '导入失败!',
                  position: 'bottom-right'
                });        
              }
              the.dialogTableVisible =false;
         })
         .catch(({err}) => {
         }) ;
         ///////
        }).catch(() => {
          the.$message({
            type: 'info',
            message: '已取消导入',
            position: 'bottom-right'
          });          
        });     
      },
      //设置初始化
      handelpic(value){
        //this.settingsform.ad_pic_1 = value;
      },
      //保存设置
      settingsformSaved(){
        var the = this;
        	
          let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/update_phoebe_settings',JSON.stringify(the.settingsform),config)
         .then(response=>{
         	var cb = response.data
         	if(cb.code==1){
            the.$notify({
              title: '保存成功',
              message: 'Phoebe设置已更新！',
              type: 'success',
              position: 'bottom-right'
            });
            //window.location.href=window.location.href;     
          }else{   
            the.$notify({
              title: '保存失败',
              message: cb.msg,
              type: 'warning',
              position: 'bottom-right'
            });
          }
         })
         .catch(({err}) => {
         }) ;
      },
      //数据导入
      dataTransfer(){
      },
      //附件管理表单
      current_change:function(currentPage){
        this.attach.manage.currentPage = currentPage;
      }, 
      // 前端过滤
      format(val){
        val = val.toString()
        if(val.indexOf(this.search) !== -1 && this.search !== ''){
          return val.replace(this.search, '<font color="red">' + this.search + '</font>')
        }else{
          return val
        }
      }, 
      //列表操作-附件开关
      listhandleSwitch(cb){
        const the = this;
        let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/refresh_attachment',JSON.stringify({post_id:cb.post_id,att_off:cb.att_off}),config)
         .then(response=>{
         	var data = response.data
         	if(data.code==1){
              the.$notify({
                title: '更新成功',
                message: '「'+cb.post_name+'」的附件状态已更新！',
                type: 'success',
                position: 'bottom-right'
              }); 
            }else{
              the.$notify({
                title: '更新失败',
                message: data.msg,
                type: 'warning',
                position: 'bottom-right'
              });
            }
         })
         .catch(({err}) => {
         }) ;
      },
      //附件编辑
      handleEdit(index,row){
        //console.log(index, row);//这里可打印出每行的内容 
        //点击编辑
        this.dialogEditFormVisible = true //显示弹框
         let rows = row
         //将每一行的数据赋值给Dialog弹框（这里是重点）
        this.editForm = Object.assign({},rows) // editForm是Dialog弹框的data
      },
      //附件删除
      handleDelete(index,row) {
        var the = this;
        the.$confirm('此操作将永久删除该附件, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
        	
          let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/refresh_attachment',JSON.stringify({post_id:row.post_id,action:'del'}),config)
         .then(response=>{
         	var data = response.data
         	if(data.code==1){
                the.$notify({
                  title: '删除成功',
                  message: 'ID为'+row.post_id+'文章附件已删除！',
                  type: 'success',
                  position: 'bottom-right'
                });     
                window.location.href=window.location.href;
                $("#tab-second").click(); 
              }else{
                the.$notify({
                  title: '删除失败',
                  message: data.msg,
                  type: 'warning',
                  position: 'bottom-right'
                });
              }
         })
         .catch(({err}) => {
         }) ;
          
        }).catch(() => {
          the.$message({
            type: 'info',
            message: '已取消删除'
          }); 
        });
      },
      //初始化设置   
      phoebeSettings(){
        var the = this;
         let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/get_phoebe_settings','',config)
         .then(response=>{
         	var data = response.data
         	the.settingsform = data.data;
         })
         .catch(({err}) => {
         }) ;
      },
	  //二维码设置
      handleQrimgUpload(f){
        if(this.settingsform.public_api==''||this.settingsform.AppKey==''){
	    	this.$notify({
                  title: '上传失败',
                  message:'请先设置公共API及APPKEY',
                  type: 'warning',
                  position: 'bottom-right'
                });
	    	return false;
	    };
        let param = new FormData();
        param.append('file',f.file);
        param.append('AppKey',this.settingsform.AppKey);
        let config = {
           headers:{'Content-Type':'multipart/form-data'}
         };  //添加请求头
         axios.post(this.settingsform.public_api+'?service=App.Decode.Qrcode',param,config)//上传二维码
         .then(response=>{
         	var t = this.parseURL(response.data.data.text);
         	var host = t.host;
         	if(host.indexOf("qq")!=-1){
         		$("#qr_qqpay").val(response.data.data.text);
         		this.settingsform.qqpay_url = response.data.data.text;
         	}else if(host.indexOf("alipay")!=-1){
         		$("#qr_alipay").val(response.data.data.text);
         		this.settingsform.alipay_url = response.data.data.text;
         	}else{
         		if(t.protocol=="wxp"){
         			$("#qr_wxpay").val(response.data.data.text);
         			this.settingsform.wxpay_url = response.data.data.text;
         	     }
         	     
         	}
         })
         .catch(({err}) => {
           f.onError()
         });   
       },
      handleQrurlSuccess(res,file){
      	
      },
      parseURL(url){
        var a = document.createElement('a');
        a.href = url;
        return {
          source: url,
          protocol: a.protocol.replace(':', ''), 
          host: a.hostname,
          port: a.port,
          query: a.search,
          params: (function() {
          var params = {},
          seg = a.search.replace(/^\?/, '').split('&'),
          len = seg.length,
          p;
      for (var i = 0; i < len; i++) {
        if (seg[i]) {
           p = seg[i].split('=');
           params[p[0]] = p[1];   
        }
      }
      return params;
   })(),
   hash: a.hash.replace('#', ''),
   path: a.pathname.replace(/^([^\/])/, '/$1')
  };
},
      //通用通知
      notice(params){
        this.$notify({
          title: params.title,
          message: params.message,
          type: params.style,
          position: 'bottom-right'
        });
      }, 
      //未授权提示    
      copyrighterror(){
        this.$notify({
          title: '警告',
          message: '你正在尝试启用未经授权的Phoebe插件，请尊重作者的劳动成果，购买正版。',
          duration: 0,
          type: 'warning',
          showClose: false,
          position: 'bottom-right'
        });
      },
      //通知
      msgChange(val){
      },
      //检查更新
      checkVersion(){
        var the = this;
        var timestamp  = new Date().getTime();
        let param = new FormData();
         param.append('source','phoebe');
         param.append('ver','');
         param.append('host',_INIT_.currHost);
         param.append('ips',_INIT_.currIP);
         param.append('accessToken',md5(_INIT_.accessKey + '&%' +_INIT_.currHost + '&%+' + _INIT_.currIP + '@%' + timestamp));
         param.append('timestamp',timestamp);
         axios.post(_default_.updateApi,param,'')
         .then(response=>{
         	var obj = response.data
            the.Phoebe.newVersion = obj.source.newVersion;
            the.Phoebe.authorized = obj.authorized;
            the.Phoebe.sourceUrls = obj.source.downloadUrls; 
            $("#changelog_timeline").html(obj.source.timeline);   
            var phoebeCopyright = $("#phoebeCopyright").html();
            if(phoebeCopyright !='© <a class="simpline">LYLARES\'S BLOG</a> All RIGHTS RESERVED.'){
              obj.authorized=0;
              the.Phoebe.authorized =0;
            }
            //if(the.Phoebe.authorized==0){
            if(1>=1){
              the.copyrighterror();
              $("div[role='tab'][id^='tab-Panel-'][id!='tab-Panel-info']").remove();
              $("div[role='tabpanel'][id^='pane-Panel-'][id!='pane-Panel-info']").remove();
              $("#copy-or-update-area").html('<a href="'+obj.source.downloadUrls+'" target="_blank" type="button" class="el-button vue-check-update el-button--primary" style="text-decoration: none;"><!----><i class="el-icon-download"></i><span>获取正版插件</span></a>');
              $("#tab-Panel-info").click();
              window.open(_default_.copytips);
              return;
            }
            if(the.ver_check(obj.source.newVersion,the.Phoebe.currVersion)){
              $("#update-button").removeAttr("disabled");
              $("#update-button").removeClass("is-disabled");      
            } 

            if(obj.news.on==1){
              var params = {};params.title = obj.news.title;params.message =obj.news.content;
              params.style=obj.news.style;
              the.notice(params);        
            }
         })
         .catch(({err}) => {
         }) ;
      },
      //版本比较
      ver_check(ver1,ver2){
        var version1pre = parseFloat(ver1);
        var version2pre = parseFloat(ver2);
        var version1next =  ver1.replace(version1pre + ".","");
        var version2next =  ver2.replace(version2pre + ".","");
        if(version1pre > version2pre){
          return true;
        }else if(version1pre < version2pre){
          return false;
        }else{
          if(version1next > version2next){
            return true;
          }else{
            return false;
          }
        }
      },
	  //插件更新
      get_update(){
		  
		var the = this;
        let data = {url:this.Phoebe.sourceUrls,v:this.Phoebe.newVersion};
        let config = {
           headers:{'X-WP-Nonce':phoebe_framework.nonce}
         };  //添加请求头
         axios.post(phoebe_framework.route + 'vue/phoebe/v1/update_phoebe',data,config)
         .then(response=>{
         	var cb = response.data
         	if(cb.code==1){

            }else{
              the.$notify({
                type: 'warning',
                message: cb.msg,
                position: 'bottom-right'
              });         
            }
         })
         .catch(({err}) => {
         }) ;
        
      }  
    },
    computed:{
    // 前端过滤
      tables(){
        const search = this.search
        if(search) {
          return this.attach.tableData.filter(dataNews => {
            return Object.keys(dataNews).some(key => {
              return String(dataNews[key]).toLowerCase().indexOf(search) > -1
            })
          })
        }
        return this.attach.tableData
      },
      // 总条数
      total(){
        return this.attach.tables.length
      }
    },
    watch: {
    // 检测表格数据过滤变化，自动跳到第一页
      tables () {
      //this.attach.manage.currentPage = 1
      }
    },
    mounted(){
      this.checkVersion();
	  this.posts = this.loadPosts();
      //this.settingform = this.phoebeSettings();
      //this.posts = this.loadPosts()
    }
    }
  );