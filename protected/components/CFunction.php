<?php

class CFunction
{
    public static function generateFileNameByDate()
    {
        $today = date("U") + (7 * 3600); //GMT+7
        return date("Ymd");
    }

    public static function genRandIdGame($game_id)
    {
        $numberId = Yii::app()->params->number_id;
        $countstr = strlen($game_id);
        $add = $numberId - $countstr;
        $i = 1;
        for ($i = 1; $i <= $add; $i++)
        {
            $game_id = '0' . $game_id;
        }
        return $game_id;
    }

    public static function getRandIdCat($cat_id)
    {
        $numberId = Yii::app()->params->number_catid;
        $countstr = strlen($cat_id);
        $add = $numberId - $countstr;
        $i = 1;
        for ($i = 1; $i <= $add; $i++)
        {
            $cat_id = '0' . $cat_id;
        }
        return $cat_id;
    }

    public static function makePhoneNumberStandard($phonenumber)
    {
        $newnumber = $phonenumber;
        if ($phonenumber != '')
        {
            if (substr($phonenumber, 0, 1) == '0')
            {
                $newnumber = substr($phonenumber, 1, strlen($phonenumber));
            } else
                if (substr($phonenumber, 0, 2) == '84')
                {
                    $newnumber = substr($phonenumber, 2, strlen($phonenumber));
                }
            $newnumber = "84" . $newnumber;
        }

        return $newnumber;
    }

    public static function random_generator($digits)
    {
        srand((double)microtime() * 10000000);
        $input = array(
            'a',
            'b',
            'c',
            'd',
            'e',
            'f',
            'g',
            'h',
            'i',
            'j',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'q',
            'r',
            's',
            't',
            'u',
            'v',
            'w',
            'x',
            'y',
            'z');
        $temp = "";
        for ($i = 1; $i < $digits + 1; $i++)
        {
            if (rand(1, 2) == 1)
            {
                $rand_index = array_rand($input);
                $temp .= $input[$rand_index];
            } else
            {
                $temp .= rand(0, 9);
            }

        }
        return $temp;
    }

    public static function gennerateOrderId()
	{
		return sprintf( '%04x%04x%04x%04x%04x%04x%04x%04x',
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		mt_rand( 0, 0x0fff ) | 0x4000,
		mt_rand( 0, 0x3fff ) | 0x8000,
		mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ) );
	}
    
    public static function highlight_keywords($text, $keyword)
    {
        $color = Yii::app()->params->color;
        $tag_start = "<span style='background-color:" . $color . "'>";
        $tag_end = "</span>";
        if ($text != '' && $keyword != '')
        {
            $original = $text;
            $text = CFunction::vn_str_filter(strtolower($text));
            $tagLen = (strlen($tag_start) + strlen($tag_end));
            $keyword = CFunction::vn_str_filter(strtolower($keyword));
            $current = $offset = $delta = 0;
            $len = mb_strlen($keyword, "utf-8");
            $total = mb_strlen($text, "utf-8");
            while ((false !== ($pos = strpos($text, $keyword, $offset))))
            {
                $original = mb_substr($original, 0, ($pos + $delta), "utf-8") . $tag_start .
                    mb_substr($original, ($pos + $delta), $len, "utf-8") . $tag_end . mb_substr($original,
                    ($pos + $delta + $len), $total, "utf-8");
                $delta += $tagLen;
                $offset = $pos + 1;

            }
            return $original;
        } else
        {
            return $text;
        }

    }

    public static function vn_str_filter($str)
    {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
            );

        foreach ($unicode as $nonUnicode => $uni)
        {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    public static function getPriceGame()
    {
        $arrPrice = Yii::app()->params->price_list;
        $arrPrice = explode(",", $arrPrice);
        $arrData = array();
        if (is_array($arrPrice))
        {
            foreach ($arrPrice as $key => $value)
            {
                $arrData[$value] = $value;
            }
            return $arrData;
        } else
        {
            return false;
        }
    }

    public static function valid_sso_header($msisdn, $sessionid)
    {
        $url = Yii::app()->params['mobifone_link_verify'];
        $url .= '?sessionid=' . $sessionid . '&msisdn=' . $msisdn;
        $content = file_get_contents($url);
        if (trim($content) === '0:OK')
        {
            return true;
        } else
        {
            return false;
        }
    }
        public static function getTypeGame(){
            $arrPrice = Yii::app()->params->game_type;
            $arrPrice = explode(",",$arrPrice);
            $arrData = array();
            if(is_array($arrPrice)){
                foreach($arrPrice as $key=>$value){
                    $arrData[$value] = $value;
                }
                return $arrData;
            }else{
                return false;
            }
        }

    public static function output_file($file, $name, $mime_type = '')
    {
        if (!is_readable($file))
            die('File not found or inaccessible!');
        $size = filesize($file);
        $name = rawurlencode($name);
        $known_mime_types = array(
            "application/rar",
            "application/x-rar-compressed",
            "application/arj",
            "application/excel",
            "application/gnutar",
            "application/octet-stream",
            "application/pdf",
            "application/powerpoint",
            "application/postscript",
            "application/plain",
            "application/rtf",
            "application/vocaltec-media-file",
            "application/wordperfect",
            "application/x-zip",
            "application/x-bzip",
            "application/x-bzip2",
            "application/x-compressed",
            "application/x-excel",
            "application/x-gzip",
            "application/x-latex",
            "application/x-midi",
            "application/x-msexcel",
            "application/x-rtf",
            "application/x-sit",
            "application/x-stuffit",
            "application/x-shockwave-flash",
            "application/x-troff-msvideo",
            "application/x-zip-compressed",
            "application/xml",
            "application/zip",
            "application/msword",
            "application/mspowerpoint",
            "application/vnd.ms-excel",
            "application/vnd.ms-powerpoint",
            "application/vnd.ms-word",
            "application/vnd.ms-word.document.macroEnabled.12",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.ms-word.template.macroEnabled.12",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
            "application/vnd.ms-powerpoint.template.macroEnabled.12",
            "application/vnd.openxmlformats-officedocument.presentationml.template",
            "application/vnd.ms-powerpoint.addin.macroEnabled.12",
            "application/vnd.ms-powerpoint.slideshow.macroEnabled.12",
            "application/vnd.openxmlformats-officedocument.presentationml.slideshow",
            "application/vnd.ms-powerpoint.presentation.macroEnabled.12",
            "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "application/vnd.ms-excel.addin.macroEnabled.12",
            "application/vnd.ms-excel.sheet.binary.macroEnabled.12",
            "application/vnd.ms-excel.sheet.macroEnabled.12",
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "application/vnd.ms-excel.template.macroEnabled.12",
            "application/vnd.openxmlformats-officedocument.spreadsheetml.template",
            "text/vnd.sun.j2me.app-descriptor",
            "application/java-archive",
            "audio/*",
            "image/*",
            "video/*",
            "multipart/x-zip",
            "multipart/x-gzip",
            "text/richtext",
            "text/plain",
            "text/xml");
        if (!in_array($mime_type, $known_mime_types))
        {
            $mime_type = 'application/force-download';
        }
        @ob_end_clean();
        if (ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');
        header('Content-Type: ' . $mime_type);
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");
        header('Accept-Ranges: bytes');
        /* The three lines below basically make the
        download non-cacheable */
        header("Cache-control: private");
        header('Pragma: private');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        // multipart-download and download resuming support
        if (isset($_SERVER['HTTP_RANGE']))
        {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
            list($range) = explode(",", $range, 2);
            list($range, $range_end) = explode("-", $range);
            $range = intval($range);
            if (!$range_end)
            {
                $range_end = $size - 1;
            } else
            {
                $range_end = intval($range_end);
            }

            $new_length = $range_end - $range + 1;
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length");
            header("Content-Range: bytes $range-$range_end/$size");
        } else
        {
            $new_length = $size;
            header("Content-Length: " . $size);
        }
        /* output the file itself */
        $chunksize = 1 * (1024 * 1024); //you may want to change this
        $bytes_send = 0;
        if ($file = fopen($file, 'r'))
        {
            if (isset($_SERVER['HTTP_RANGE']))
                fseek($file, $range);

            while (!feof($file) && (!connection_aborted()) && ($bytes_send < $new_length))
            {
                $buffer = fread($file, $chunksize);
                print ($buffer); //echo($buffer); // is also possible
                flush();
                if (connection_status() != 0)
                {
                } else
                {
                    $statusDownloadFile = '1';
                    //$this->updateDownloadFileStatus2DB($statusDownloadFile);
                }
                $bytes_send += strlen($buffer);
            }
            fclose($file);
        } else
            die('Error - can not open file.');
    }
}

?>