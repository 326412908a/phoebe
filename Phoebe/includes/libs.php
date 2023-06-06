<?php
if ( ! defined( 'PHOEBE_VERSION' ) ) {
	die;
}
class MIG{

    public static function get_data($origin)
    {
        global $wpdb;
  
        $table = $wpdb->prefix.'postmeta';
  
        if($origin=='edl'){
  
            $sql = "SELECT * FROM  $table  WHERE meta_key  LIKE '%Easydownload%'";
  
        }elseif($origin=='ldl'){
  
            $sql = "SELECT * FROM $table  WHERE meta_key  LIKE '%lylaresdown%'";

        }

        $res = $wpdb->get_results($sql,ARRAY_A);
  
        $array = self::gen_array($res,'post_id');

        $arr = self::get_array($array);
  
        return $arr;
    }


    public static function gen_array($arr, $key)
    {
        $grouped = [];
        foreach ($arr as $value) {
            $grouped[$value[$key]][] = $value;
        }
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $key => $value) {
                $parms = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $parms);
            }
        }
        return $grouped;
    }


    public static function get_array($para){
        foreach($para as $key=>$value){
            foreach($value as $k=>$v ){
                $_n = $v['meta_key'];
                $_d[$key][$_n] = $v['meta_value'];
            }
        }

        return $_d;
    }
  
  
  public static function mig_edl(){
  
  global $wpdb;
    
    $table = $wpdb->prefix.'postmeta';
    $_edl_his =
      [
			'Easydownload_start',
            'Easydownload_name',
            'Easydownload_size',
            'Easydownload_type',
            'Easydownload_info',
            'Easydownload_date',
            'Easydownload_version',
            'Easydownload_author',
            'Easydownload_downurl5',
            'Easydownload_gfmima',
            'Easydownload_formal',
            'Easydownload_Preview',
       'Easydownload_baidu'
          ];
 
  $_lylares_ =[
 'edl_activator',
 'edl_attr_name',
 'edl_attr_size',
 'edl_attr_type',
 'edl_attr_desc',
 'edl_attr_updated',
 'edl_attr_version',
      'edl_attr_author',
      'edl_attr_download_other',
      'edl_file_pass',
      'edl_attr_download_formal',
 'edl_preview_url',
    'edl_attr_download_baidu'
 
 ];  
    
  
   $total = count($_edl_his);
 
 for($i=0;$i<$total;$i++){
	 $a = $_edl_his[$i];
   $b= $_lylares_[$i];
	 $sql = "UPDATE $table SET meta_key = REPLACE(meta_key, '$a', '$b' ) WHERE meta_key LIKE '%Easydownload_%'";
 $res = $wpdb->query($sql);
	 
 }
  if($res){
    $wpdb->query("DELETE FROM $table WHERE meta_key LIKE '%Easydownload_%'");
  }
  
  return $res;
  
  
  
  
  }
  
  public static function mig_lyl(){
  
  global $wpdb;
    
    $table = $wpdb->prefix.'postmeta';
          $_lylares =[
 'lylaresdown_start',
 'lylaresdown_name',
 'lylaresdown_size',
 'lylaresdown_type',
 'lylaresdown_version',
 'lylaresdown_downurl5',
 'lylaresdown_date',
 'lylaresdown_gfmima',
 'lylaresdown_info'
 ];
 
  $_lylares_ =[
 'edl_activator',
 'edl_attr_name',
 'edl_attr_size',
 'edl_attr_type',
 'edl_attr_version',
 'edl_attr_download_formal',
 'edl_attr_updated',
 'edl_file_pass',
 'edl_attr_desc'
 ];
 
 
 $total = count($_lylares);
 
 for($i=0;$i<$total;$i++){
	 $a = $_lylares[$i];
   $b= $_lylares_[$i];
	 $sql = "UPDATE $table SET meta_key = REPLACE(meta_key, '$a', '$b' ) WHERE meta_key LIKE '%lylaresdown%'";
 $res = $wpdb->query($sql);
	 
 }
    
    if($res){
  $wpdb->query("DELETE FROM $table WHERE meta_key LIKE '%lylaresdown%'");
    }
  
  return $res;
  
  
  }
  
  public static function gen_phoebe(){
    
    $_edl  =  self::get_data('edl');
    
    $_ldl  =  self::get_data('ldl');
    
    if($_edl){
    
    $m_edl = self::mig_edl();
    
    }
    
    if($_ldl){
    
    $m_ldl = self::mig_lyl();
    
    }
      
    global $wpdb;
    
    $table = $wpdb->prefix.'postmeta';
    
    $sql = "SELECT * FROM $table  WHERE meta_key  LIKE '%edl_%'";

    $res = $wpdb->get_results($sql,ARRAY_A);
    
    $cb = self::gen_array($res,'post_id');
    
    $array = [];
   foreach($cb as $key =>$value){
     
      foreach($value as $k =>$v){
        
        
        
        if($v['meta_key']=='edl_activator'){
        
        $array['att_off'] = $v['meta_value'];
        
        }
        
        if($v['meta_key']=='edl_attr_name'){
        
        $array['att_name'] = $v['meta_value'];
        
        }
        
        if($v['meta_key']=='edl_attr_size'){
        
        $array['att_size'] = $v['meta_value'];
        
        }
        if($v['meta_key']=='edl_attr_type'){
        
        $array['att_type'] = $v['meta_value'];
        
        }
        
        if($v['meta_key']=='edl_attr_desc'){
        
        $array['att_description'] = $v['meta_value'];
        
        }
        
        if($v['meta_key']=='edl_attr_updated'){
        
        $array['att_add_time'] = $v['meta_value'];
        
        }
        
        if($v['meta_key']=='edl_attr_version'){
        
        $array['att_version'] = $v['meta_value'];
        
        }
        
         if($v['meta_key']=='edl_attr_download_formal'){
        
        $array['att_links'] = $v['meta_value'];
        
        }
        
         if($v['meta_key']=='edl_file_pass'){
        
        $array['att_password'] = $v['meta_value'];
        
        }
         if($v['meta_key']=='edl_attr_author'){
        
        $array['att_author'] = $v['meta_value'];
        
        }
        
         if($v['meta_key']=='edl_preview_url'){
        
        $array['att_preview_url'] = $v['meta_value'];
        
        }

     
     
   $array['post_id'] = $v['post_id'];
   
   
   
   }
   
   $_[] =$array;
   
   
   }
    
    
  $table_name = $wpdb->prefix . 'phoebe_posts';

     return $_;
  
  }


}