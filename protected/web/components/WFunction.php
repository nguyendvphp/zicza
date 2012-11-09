<?php
class WFunction{
    public static function number_format($string, $decimals = "", $dec_sep=",", $thous_sep = "."){
        $ret = '0';
        if($string!='')
            $ret = number_format($string,$decimals,$dec_sep,$thous_sep);
        return $ret; 
    }
    
    public static function generate_file_name($type='file'){
    	$file_info = array();
    	$curr_info = date("Y,m,d,H,i,s");
    	list($year, $month, $day, $hour, $minute, $second) = @split(",",$curr_info);
    	$filename = $year.$month.$day.$hour.$minute.$second.WFunction::random_generator(5);
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
    
    public static function getPagerInfo($count, $cpage, $rowsperpage = false){
		$pInfo = array();
		$pInfo['cpage'] = $cpage;
		$pInfo['count'] = $count;
		$pInfo['limit'] = ($rowsperpage === false)?Yii::app()->params['m_rows_per_page']:$rowsperpage;
		$pInfo['totalpages'] = 0;
		$pInfo['start'] = 0;
		if($pInfo['count'] > 0){
			if($pInfo['limit'] ==0 )
				$pInfo['totalpages'] = 0;
			else
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
    			$pagerinf['strPager'] .= '<span><a href="'.$pagerinf['previous'].'"> <img src="'.$imgPath.'previous.png'.'" title="" alt="" /> </a></span>';
    			$pagerinf['strPager'] .= '<span><a href="'.$current_uri . "&p=".($cpage - 1).'">'.($cpage - 1).'</a></span>';
    		}
    		$pagerinf['strPager'] .= '<span class="active">'.($cpage).'</span>';
            if($cpage < $numofpages){
    			$pagerinf['strPager'] .= '<span><a href="'.$current_uri . "&p=".($cpage + 1).'">'.($cpage + 1).'</a></span>&nbsp;';
    		}
    
    		if( $cpage < $numofpages ){
    			$pagerinf['strPager'] .= '<a href="">...</a>';
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
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($cpage-1).')"> <img src="'.$imgPath.'previous.png'.'" title="" alt="" /> </a></span>';
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($cpage-1).')">'.($cpage - 1).'</a></span>';
    		}
    		$pagerinf['strPager'] .= '<span class="active">'.($cpage).'</span>';
            if($cpage < $numofpages){
    			$pagerinf['strPager'] .= '<span><a href="javascript:goPage('.($cpage+1).')">'.($cpage + 1).'</a></span>&nbsp;';
    		}
    
    		if( $cpage < $numofpages ){
    			//$pagerinf['strPager'] .= '...';
    			//$pagerinf['strPager'] .= '<span><a href="'.$current_uri . "&p=".($numofpages).'">'.($numofpages).'</a></span>&nbsp;';
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
    public static function convertToAlias($str) {
        $str = trim($str);
        $strFind = array(
            '- ',
            ' ',            
            'đ','Đ',
            'á','à','ạ','ả','ã','Á','À','Ạ','Ả','Ã','ă','ắ','ằ','ặ','ẳ','ẵ','Ă','Ắ','Ằ','Ặ','Ẳ','Ẵ','â','ấ','ầ','ậ','ẩ','ẫ','Â','Ấ','Ầ','Ậ','Ẩ','Ẫ',
            'ó','ò','ọ','ỏ','õ','Ó','Ò','Ọ','Ỏ','Õ','ô','ố','ồ','ộ','ổ','ỗ','Ô','Ố','Ồ','Ộ','Ổ','Ỗ','ơ','ớ','ờ','ợ','ở','ỡ','Ơ','Ớ','Ờ','Ợ','Ở','Ỡ',
            'é','è','ẹ','ẻ','ẽ','É','È','Ẹ','Ẻ','Ẽ','ê','ế','ề','ệ','ể','ễ','Ê','Ế','Ề','Ệ','Ể','Ễ',
            'ú','ù','ụ','ủ','ũ','Ú','Ù','Ụ','Ủ','Ũ','ư','ứ','ừ','ự','ử','ữ','Ư','Ứ','Ừ','Ự','Ử','Ữ',
            'í','ì','ị','ỉ','ĩ','Í','Ì','Ị','Ỉ','Ĩ',
            'ý','ỳ','ỵ','ỷ','ỹ','Ý','Ỳ','Ỵ','Ỷ','Ỹ'
            );
        $strReplace = array(
            '',
            '-',            
            'd','d',
            'a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
            'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
            'e','e','e','e','e','e','e','e','e','e','e','e','e','e','e','e','e','e','e','e','e','e',
            'u','u','u','u','u','u','u','u','u','u','u','u','u','u','u','u','u','u','u','u','u','u',
            'i','i','i','i','i','i','i','i','i','i',
            'y','y','y','y','y','y','y','y','y','y'
            );
            
        return strtolower( preg_replace( '/[^a-z0-9\-]+/i','', str_replace($strFind, $strReplace, $str) ) );        
    } 
   
}
?>