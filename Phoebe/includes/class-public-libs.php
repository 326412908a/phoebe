<?php
if ( ! defined( 'PHOEBE_VERSION' ) ) {
	die;
}
     function get_rencentposts_by_RestAPI() {
        $args = array(
            'numberposts' => 10000,
            'offset' => 0,
            'category' => 0,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post',
            'suppress_filters' => true
        );
        $return = wp_get_recent_posts($args);
        foreach($return as $k=> $v){
            $callback[] = [
                'value'=>$v['post_title'],
                'id'=>$v['ID']
            ];
        }
        if($return){
            $_data['code']=1;
            $_data['data']=$callback;
        }else{
            $_data['code']=0;
        }
        return $_data;
    }


    function get_attachlist_by_RestAPI($data) {
        if(current_user_can('manage_options')) {
        	global $wpdb;
	        $table_name = $wpdb->prefix . 'phoebe_posts';
	        $res = $wpdb->get_results("SELECT * FROM $table_name ORDER BY att_add_time DESC");
	        if($res){
	        	$_data['code']=1;
	        	$_data['data']=$res;
	        }else{
	        	$_data['code']=0;
	        }
            return $_data;
        }
    }

    function user_get_attachinfo_by_RestAPI($data) {
	    $submit = json_decode($data->get_body(),true);
	    $post_id = intval($submit['post_id']);
	    $pcode = $submit['pcode'];
	    global $wpdb;
	    $table_name = $wpdb->prefix . 'phoebe_posts';
	    $res = $wpdb->get_row("SELECT att_links FROM $table_name WHERE post_id = '$post_id' AND att_pcode ='$pcode'",ARRAY_A);
	    if($res){
	    	$_data['code']=1;
	    	$_data['data']=$res['att_links'];
	    }else{
	    	$_data['code']=0;
	    }
	    return $_data;
    }

    function add_attachment_by_RestAPI( $data ) {
  
        if (current_user_can('manage_options')) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'phoebe_posts';
            $submit = json_decode($data->get_body(),true);
            $postid = $submit['post_id'];
            preg_match("/(?:\()(.*)(?:\))/i",$postid, $postID);
            $post_id = $postID[1];
            if(!$post_id){
            	$post_id = intval($submit['post_id']);
            }
            if(!is_numeric($post_id)){
            	$c =array(
            		'code'=>0,
            		'msg'=>'文章ID为空或格式不正确，附件添加失败。'
            	);
                return $c;
            }
            unset($submit['post_id']);
	        unset($submit['activeNames']);
	        $submit['post_id'] = $post_id;
            if($post_id){
                $postitle = get_post($post_id)->post_title;
                if(!$postitle){
                	$postitle= $post_id;
                }
                $submit['post_name'] = $postitle;
                $submit['att_add_time'] = date('Y:m:d H:i:s');

                $res = $wpdb->insert( 
		            $table_name, 
		            $submit 
	            );
      //$wpdb->show_errors();
      //$wpdb->print_error(); 
                if($res){
                    $cb =array(
                        'code'=>1,
                    );
                }else{
                    $cb =array(
                        'code'=>0,
                        'msg'=>'数据库异常或ID为'.$submit['post_id'].'的文章已存在附件信息，添加失败。'
                    );
                }
                return $cb;
            }
        }
    }

    function refresh_attachment_by_id($data) {
        if(current_user_can('manage_options')){
            global $wpdb;
            $table_name = $wpdb->prefix . 'phoebe_posts';
            $_post = json_decode($data->get_body(),true);
            $post_id = intval($_post['post_id']);
            $action = $_post['action'];
            if($action=='del'){
            	$res = $wpdb->query( "DELETE FROM  $table_name WHERE post_id = '$post_id'" );
            	if($res){
            		$cb =array(
            			'code'=>1,
            			);
            	}else{
            		$cb =array(
            			'code'=>0,
            			'msg'=>'数据库连接错误，ID为'.$post_id.'的文章附件删除失败。'
            			);
                }
      
                return $cb;
            }
            if($_GET['action']=='update'){
                unset($_post['id']);
                $res = $wpdb->update($table_name,$_post,array('post_id'=>$post_id));
                if($res){
                	$cb =array(
                		'code'=>1,
                		'msg'=>'文章「'.$_post['post_name'].'」的附件信息更新成功。');
                }else{
                	$cb =array('code'=>0,'msg'=>'附件信息未改变或数据库连接错误，ID为'.$post_id.'的文章附件信息更新失败。');
                }
      
                return $cb;
            }
            $att_off = $_post['att_off'];
            if($post_id){
            	$res = $wpdb->update($table_name,array('att_off'=>$att_off),array('post_id'=>$post_id));
            	if($res){
            		$cb =array('code'=>1,);
                }else{
                	$cb =array('code'=>0,'msg'=>'数据库连接错误，ID为'.$post_id.'的文章附件更新失败。');
                }
                return $cb;
            }
        }
    }

    function get_phoebe_settings($data){
        if(current_user_can('manage_options')) {
            global $wpdb;
	        $table_name = $wpdb->prefix.'phoebe_settings';
	        $res = $wpdb->get_row("SELECT * FROM $table_name WHERE id='0'",ARRAY_A);
            if($res){
                $_data['code']=1;
                $_data['data']=$res;
            }else{
                $_data['code']=0;
            }
            return $_data;
        }
    }

    function update_phoebe_settings( $data ) {
        if(current_user_can('manage_options')) {
            global $wpdb;
	        $table_name = $wpdb->prefix.'phoebe_settings';
            $dataArray = json_decode($data->get_body(),true);
            $res1 = $wpdb->get_results("SELECT id FROM $table_name limit 1");
            if($res1){
                $res = $wpdb->update($table_name, $dataArray,array('id'=>0));
            }else{
                $res = $wpdb->insert($table_name,$dataArray);
            }
            if($res){
            	$cb =array('code'=>1,);
            }else{
            	$cb =array(
                    'code'=>0,
                    'msg'=>'设置项未改变或数据库异常,设置更新失败。'
                );
            }
            return $cb;
        }
    }

    function curl_file_get_contents($url,$path){
        $hander = curl_init();
        $fp = fopen($path,'wb');
        curl_setopt($hander,CURLOPT_URL,$url);
        curl_setopt($hander,CURLOPT_FILE,$fp);
        curl_setopt($hander,CURLOPT_HEADER,0);
        curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($hander,CURLOPT_TIMEOUT,60);
        curl_exec($hander);
        curl_close($hander);
        fclose($fp);
        return $path;
    }

    function base64EncodeImage($image_file){
        $base64_image = '';
        $image_info = getimagesize($image_file);
        $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
        $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
        return $base64_image;
    }

    function get_hisdata(){
  
        if(current_user_can('manage_options')) {
        	$res = MIG::gen_phoebe();
        	if(!$res){
        		return array('code'=>0,'msg'=>'未查询到历史数据。');
        	}
            if($_GET['action']=='migrate'){
           	    global $wpdb;
           	    $table_name = $wpdb->prefix . 'phoebe_posts';
           	    foreach($res as $k=>$v){
           	    	$re = $wpdb->insert($table_name,$v);
           	    }
           	    if($re){
           	    	$cb['code'] = 1;
           	    	$table = $wpdb->prefix.'postmeta';
           	    	$wpdb->query("DELETE FROM $table WHERE meta_key LIKE '%edl_%'");
           	    	
           	    }else{
           	    	$cb['code'] = 0;
           	    	$cb['msg'] = '导入失败';
           	    	
           	    }
           	    return $cb;
            	
            }else{
            	$_c['code'] =1;
            	$_c['data'] =$res;
            	return $_c;
            }
        }
    }

    function get_attachpost($data){
	    global $wpdb;
	    $table_name = $wpdb->prefix . 'phoebe_posts';
	    $_post = json_decode($data->get_body(),true);
	    $post_id = intval($_post['id']);
	    $user_pcode = $_post['pcode'];
	    $action = $_GET['action'];
	    if(isset($action)&&$action=='pcode_check'){
		    $res = $wpdb->get_row("SELECT att_pcode,att_links FROM $table_name WHERE post_id = '$post_id'",ARRAY_A);
		    $_c['code'] =0;
		    if($user_pcode == $res['att_pcode']){
			    $_c['code'] =1;
			    $_c['data']['links'] =$res['att_links'];
			
		    }
		    return $_c;
	    }
    }

    function get_total_cmt_user($postid=0,$which=0) {
	    $comments = get_comments('status=approve&type=comment&post_id='.$postid);
	    if($comments) {
		    $i=0;
		    $j=0;
		    $commentusers=array();
		    foreach ($comments as $comment){
			    ++$i;
			    if ($i==1) { $commentusers[] = $comment->comment_author_email; ++$j; }
			    if(!in_array($comment->comment_author_email, $commentusers) ) {
				    $commentusers[] = $comment->comment_author_email;
				    ++$j;
			    }
		    }
		    $output = array($j,$i);
		    $which = ($which == 0) ? 0 : 1;
		    return $output[$which]; 
	    }
	    return false; 
    }


