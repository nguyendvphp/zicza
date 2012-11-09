<?php
class AFunction{
    public static function number_format($string, $decimals = 0, $dec_sep=",", $thous_sep = "."){
        $ret = '0';
        if($string!='')
            $ret = number_format($string,$decimals,$dec_sep,$thous_sep);
        return $ret; 
    }
    
   public static function generate_file_name($type='file'){
    	$file_info = array();
    	$curr_info = date("Y,m,d,H,i,s");
    	list($year, $month, $day, $hour, $minute, $second) = @split(",",$curr_info);
    	$filename = $year.$month.$day.$hour.$minute.$second.AFunction::random_generator(5);
    	$file_info['name'] = $filename;
    	$file_info['host_path'] = "/uploads/".$type."/$year/$month/";
    	$file_info['physical_path'] = $type."/$year/$month/";
    	return $file_info;
    }

    public static function random_generator($digits){
    	srand((double)microtime() * 10000000);
    	$input = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
    	$temp = "";
    	for($i=1; $i < $digits+1; $i++){
    		if(rand(1,2)==1){
    			$rand_index = array_rand($input);
    			$temp .= $input[$rand_index];
    		}else{
    			$temp .= rand(0, 9);
    		}
    		
    	}
    	return $temp;
    }
	public static function bu($url=null) 
    {
        static $baseUrl;
        if ($baseUrl===null)
            $baseUrl=Yii::app()->getRequest()->getBaseUrl();
        return $url===null ? $baseUrl : $baseUrl.'/'.ltrim($url,'/');
    }
    public static function getPagerInfo($count, $cpage, $rowsperpage = false){
		$pInfo = array();
		$pInfo['cpage'] = $cpage;
		$pInfo['count'] = $count;
		$pInfo['limit'] = ($rowsperpage === false)?Yii::app()->params['m_rows_per_page']:$rowsperpage;
		$pInfo['totalpages'] = 0;
		$pInfo['start'] = 0;
		if($pInfo['count'] > 0){
			$pInfo['totalpages'] = ceil($pInfo['count']/$pInfo['limit']);
		}
		if($pInfo['cpage'] > $pInfo['totalpages']) $pInfo['cpage'] = $pInfo['totalpages'];
		$pInfo['start'] = $pInfo['limit'] * $pInfo['cpage'] - $pInfo['limit'];
		if($pInfo['start'] < 0) $pInfo['start'] = 0;
		return $pInfo;
	}
    public static function  web_pager($count, $cpage, $limit = 3,$current_uri, $imgPath = null){
        $pagerinf = array();
    	$pagerinf['next'] = "";
    	$pagerinf['previous'] = "";
    	$pagerinf['strPager'] = "";
    	if(!isset($cpage) || !is_numeric($cpage)) $cpage = 1;
    	//$current_uri = $_SERVER['REQUEST_URI'];
    	
    	$numofpages = ceil($count/$limit); //echo $numofpages;
    	if($cpage > $numofpages) $cpage = $numofpages;
    	if($numofpages > 1){
    		if(($cpage > 1) & ($cpage < $numofpages)){
    			$pagerinf['previous'] = $current_uri . "&p=".($cpage - 1);
    			$pagerinf['next'] = $current_uri . "&p=".($cpage + 1);
    		}elseif ($cpage==1){
    			$pagerinf['next'] = $current_uri . "&p=".($cpage + 1);
    		}elseif ($cpage==$numofpages){
    			$pagerinf['previous'] = $current_uri ."&p=".($cpage - 1);
    		}
    		$pagerinf['numofpages'] = $numofpages;
    		$pagerinf['curpage'] = $cpage;
    		if( $cpage > 1 && $cpage <= $numofpages ){
    			$pagerinf['strPager'] .= '<span><a href="'.$pagerinf['previous'].'"> <img src="'.$imgPath.'previous.png'.'" title="" alt="" /> </a></span>&nbsp;|&nbsp;';
    			$pagerinf['strPager'] .= '<span><a href="'.$current_uri . "&p=".($cpage - 1).'">'.($cpage - 1).'</a></span>&nbsp;|&nbsp;';
    		}
    		$pagerinf['strPager'] .= '<span><a style="color: blue;" href="'.$current_uri . "&p=".($cpage).'">'.($cpage).'</a></span>&nbsp;|&nbsp;';
            if($cpage < $numofpages){
    			$pagerinf['strPager'] .= '<span><a href="'.$current_uri . "&p=".($cpage + 1).'">'.($cpage + 1).'</a></span>&nbsp;';
    		}
    
    		if( $cpage < $numofpages ){
    			$pagerinf['strPager'] .= '...';
    			$pagerinf['strPager'] .= '<span><a href="'.$current_uri . "&p=".($numofpages).'">'.($numofpages).'</a></span>&nbsp;';
    			$pagerinf['strPager'] .= '<span><a href="'.$pagerinf['next'].'"> <img src="'.$imgPath.'next.png'.'" title="" alt="" /> </a></span>';
    		}
    		return $pagerinf;
    	}
    	return false;
    }
    
    public static function web_pager_ajax($count, $cpage, $limit = 3,$current_uri, $imgPath = null){
        //echo 'abcbadasd';
        $pagerinf = array();
    	$pagerinf['next'] = "";
    	$pagerinf['previous'] = "";
    	$pagerinf['strPager'] = "";
    	if(!isset($cpage) || !is_numeric($cpage)) $cpage = 1;
    	//$current_uri = $_SERVER['REQUEST_URI'];
    	
    	$numofpages = ceil($count/$limit); //echo $numofpages;
    	if($cpage > $numofpages) $cpage = $numofpages;
    	if($numofpages > 1){
    		if(($cpage > 1) & ($cpage < $numofpages)){
    			$pagerinf['previous'] = $current_uri . "&p=".($cpage - 1);
    			$pagerinf['next'] = $current_uri . "&p=".($cpage + 1);
    		}elseif ($cpage==1){
    			$pagerinf['next'] = $current_uri . "&p=".($cpage + 1);
    		}elseif ($cpage==$numofpages){
    			$pagerinf['previous'] = $current_uri ."&p=".($cpage - 1);
    		}
    		$pagerinf['numofpages'] = $numofpages;
    		$pagerinf['curpage'] = $cpage;
    		if( $cpage > 1 && $cpage <= $numofpages ){
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($cpage-1).')"> <img src="'.$imgPath.'previous.png'.'" title="" alt="" /> </a></span>&nbsp;|&nbsp;';
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($cpage-1).')">'.($cpage - 1).'</a></span>&nbsp;|&nbsp;';
    		}
    		$pagerinf['strPager'] .= '<span><a style="color: blue;" href="javascript:goPage('.$cpage.')">'.($cpage).'</a></span>&nbsp;|&nbsp;';
            if($cpage < $numofpages){
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($cpage+1).')">'.($cpage + 1).'</a></span>&nbsp;';
    		}
    
    		if( $cpage < $numofpages ){
    			$pagerinf['strPager'] .= '...';
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($numofpages).')">'.($numofpages).'</a></span>&nbsp;';
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($cpage+1).')"> <img src="'.$imgPath.'next.png'.'" title="" alt="" /> </a></span>';
    		}
    		return $pagerinf;
    	}
    	return false;
    }
    
   

    
   
    public static function genRandIdGame($game_id){
        $numberId = Yii::app()->params->number_id;
        $countstr = strlen($game_id);
        $add = $numberId - $countstr;
        $i = 1;
        for($i =1 ; $i<=$add ; $i++){
            $game_id = '0'.$game_id;
        }
        return $game_id;
    }
    
    public static function truncate($string, $length = 80, $etc = '...',
                                  $break_words = false, $middle = false)
    {
        if ($length == 0)
            return '';
    
        if (strlen($string) > $length) {
            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
            }
            if(!$middle) {
                return substr($string, 0, $length) . $etc;
            } else {
                return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
            }
        } else {
            return $string;
        }
    }
    
    public static function get_subfolders_name($path,$file=false){
    
        $list=array();    
        $results = scandir($path); //var_dump($results);exit();
        foreach ($results as $result) {    	
            if ($result === '.' or $result === '..' or $result === '.svn') continue;
    		if(!$file) {
    	        if (is_dir($path . '/' . $result)) {
    	            $list[]=trim($result);
    	        }
    	    }
    		else {			
    			if (is_file($path . '/' . $result)) {
    	            $list[]=trim($result);
    	        }
    	    }
        }
        
        return $list;
    }
    
    public static function recursive_remove_directory($directory, $empty=FALSE)
    {
    	// if the path has a slash at the end we remove it here
    	if(substr($directory,-1) == '/')
    	{
    		$directory = substr($directory,0,-1);
    	}
    
    	// if the path is not valid or is not a directory ...
    	if(!file_exists($directory) || !is_dir($directory))
    	{
    		// ... we return false and exit the function
    		return FALSE;
    
    	// ... if the path is not readable
    	}elseif(!is_readable($directory))
    	{
    		// ... we return false and exit the function
    		return FALSE;
    
    	// ... else if the path is readable
    	}else{
    
    		// we open the directory
    		$handle = opendir($directory);
    
    		// and scan through the items inside
    		while (FALSE !== ($item = readdir($handle)))
    		{
    			// if the filepointer is not the current directory
    			// or the parent directory
    			if($item != '.' && $item != '..')
    			{
    				// we build the new path to delete
    				$path = $directory.'/'.$item;
    
    				// if the new path is a directory
    				if(is_dir($path)) 
    				{
    					// we call this function with the new path
    					self::recursive_remove_directory($path);
    
    				// if the new path is a file
    				}else{
    					// we remove the file
    					unlink($path);
    				}
    			}
    		}
    		// close the directory
    		closedir($handle);
    
    		// if the option to empty is not set to true
    		if($empty == FALSE)
    		{
    			// try to delete the now empty directory
    			if(!rmdir($directory))
    			{
    				// return false if not possible
    				return FALSE;
    			}
    		}
    		// return success
    		return TRUE;
    	}
    } 
}
?>