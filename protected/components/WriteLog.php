<?php 
class WriteLog {
    
    private $_channelCode;
	private $_type;
	private $_time;
	private $_parent_folder = 'transaction';
	public $chargingFileLogPath;
	public $chargingFileLogName;
	
	public function __construct($channel_code, $type = 'transaction'){
		$this->_time = time();
        $this->_channelCode = $channel_code;
        $this->_type = $type;
        $this->createLogFolderPath($this->_channelCode);
    }
    
	public function createLogFolderPath($folder = null){
        if(is_null($folder)) $folder = '';
    	$log_path = realpath(Yii::app()->basePath.'/../'.Yii::app()->params['log_folder'].'/');
    	
		if( !is_dir($log_path . '/'.$this->_parent_folder)){
			mkdir($log_path . '/'.$this->_parent_folder, 0777);
		}
		
		if( !is_dir($log_path . '/'.$this->_parent_folder.'/'.$folder)){
			mkdir($log_path . '/'.$this->_parent_folder.'/'.$folder, 0777);
		}
		if( !is_dir($log_path . '/'.$this->_parent_folder.'/'.$folder)){
			mkdir($log_path . '/'.$this->_parent_folder.'/'.$folder, 0777);
		}
		$this->chargingFileLogPath = $log_path . '/'.$this->_parent_folder.'/'.$folder. '/';
		$this->chargingFileLogName = MFunction::generateFileNameByDate() . '.log';
    	return $this->chargingFileLogPath;
	}
	
	public function write($arrayParams){
		$strToLog = $this->initData($arrayParams);
		$this->logForReport($strToLog);
	}
	
	private function initData($arrayParams){
		$strReturn = '';
        $strReturn .= strtoupper($this->_type)."\t";
        if(isset($arrayParams['transactionid']))
            $strReturn .= $arrayParams['transactionid'];
        $strReturn .= "\t";
        if(isset($arrayParams['msisdn']))
            $strReturn .= $arrayParams['msisdn'];
        $strReturn .= "\t";
        if(isset($arrayParams['channel']))
            $strReturn .= $arrayParams['channel'];
        $strReturn .= "\t";
        if(isset($arrayParams['device_name']))
            $strReturn .= $arrayParams['device_name'];
        $strReturn .= "\t";
        if(isset($arrayParams['brand']))
            $strReturn .= $arrayParams['brand'];
        $strReturn .= "\t";
        if(isset($arrayParams['ua']))
            $strReturn .= $arrayParams['ua'];
        $strReturn .= "\t";
        if(isset($arrayParams['ip']))
            $strReturn .= $arrayParams['ip'];
        $strReturn .= "\t";
        $strReturn .= date("Y-m-d H:i:s",$this->_time);
        $strReturn .= "\t";
        if(isset($arrayParams['campaing']))
            $strReturn .= $arrayParams['campaing'];
        $strReturn .= "\t";
        if(isset($arrayParams['gameid']))
            $strReturn .= $arrayParams['gameid'];
        $strReturn .= "\t";
        if(isset($arrayParams['gamename']))
            $strReturn .= $arrayParams['gamename'];
        $strReturn .= "\t";
        if(isset($arrayParams['cp_game_id']))
            $strReturn .= $arrayParams['cp_game_id'];
        $strReturn .= "\t";
        if(isset($arrayParams['cp_code']))
            $strReturn .= $arrayParams['cp_code'];
        $strReturn .= "\t";
        if(isset($arrayParams['cp_name']))
            $strReturn .= $arrayParams['cp_name'];
        $strReturn .= "\t";
        if(isset($arrayParams['downloadlink']))
            $strReturn .= $arrayParams['downloadlink'];
        $strReturn .= "\t";
        if(isset($arrayParams['price']))
            $strReturn .= $arrayParams['price'];
        $strReturn .= "\t";
        if(isset($arrayParams['org_price']))
            $strReturn .= $arrayParams['org_price'];
        $strReturn .= "\t";
        if(isset($arrayParams['to_phonenumber']))
            $strReturn .= $arrayParams['to_phonenumber'];
        $strReturn .= "\t";
        $strReturn .="\n";
        return $strReturn;
	}
	
	
	public function logForReport($logContent)
	{
		$type = $this->_type;
		$logPath = $this->chargingFileLogPath;
        
		$logMainFilename = $type."-".MFunction::generateFileNameByDate();
		if(!defined("LOG_CURRENT_FILE")) define("LOG_CURRENT_FILE", $type."-current-file.log");
		if(!file_exists($logPath . LOG_CURRENT_FILE)){
			$fCurrentName = $logMainFilename;
			$fmode = "a+";
			$logFileCurrent = fopen($logPath . LOG_CURRENT_FILE, $fmode);
			fwrite($logFileCurrent, $logMainFilename);
			fclose($logFileCurrent);
		}else{
			$fmode = "r";
			$logFileCurrent = fopen($logPath . LOG_CURRENT_FILE, $fmode);
			$fCurrentName = fgets($logFileCurrent);
			fclose($logFileCurrent);
			
			if($fCurrentName != $logMainFilename){
				$fCurrentName = $logMainFilename;
				$fIndexStart = 0;
				$logFileCurrent = fopen($logPath . LOG_CURRENT_FILE, "w");
				fwrite($logFileCurrent, $logMainFilename);
				fclose($logFileCurrent);
			}
		}
		if(!defined("LOG_FILE_INDEX")) define("LOG_FILE_INDEX", $type."-index.log");
		if(!file_exists($logPath . LOG_FILE_INDEX)){
			$findex = 0;
			$fmode = "a+";
			$logFileIndex = fopen($logPath . LOG_FILE_INDEX, $fmode);
			fwrite($logFileIndex,$findex);
			fclose($logFileIndex);
		}else{ 
			if(isset($fIndexStart) && $fIndexStart == 0){
				$findex = 0;
				$fmode = "w";
				$logFileIndex = fopen($logPath . LOG_FILE_INDEX, $fmode);
				fwrite($logFileIndex,$fIndexStart);
				fclose($logFileIndex);
			}else{
				$fmode = "a+"; 
				$logFileIndex = fopen($logPath . LOG_FILE_INDEX, $fmode);
				$findex = fgets($logFileIndex);
				fclose($logFileIndex);
			}
		}
		$logForProcessFilename = $fCurrentName . "-" . $findex . ".log";
		$logForProcessFilePath = $logPath . $logForProcessFilename;
		
		if(!file_exists($logForProcessFilePath))
		{
			$findex+=1;
			$fmode = "w";
			$logFileIndex = fopen($logPath . LOG_FILE_INDEX, $fmode);
			fwrite($logFileIndex,$findex);
			fclose($logFileIndex);
			
			$logForProcessFilePath = $logPath . $fCurrentName . "-" . $findex . ".log";
			if(file_exists($logForProcessFilePath)) $fmode = "w";
			else $fmode = "a+";
			
			$fProcess = fopen($logForProcessFilePath,$fmode);
			fwrite($fProcess,$logContent);
			fclose($fProcess);
            rename($logForProcessFilePath, $logPath . $fCurrentName . "-" . $findex . ".txt");
		}else{
			$findex+=1;
			$fmode = "w";
			$logFileIndex = fopen($logPath . LOG_FILE_INDEX, $fmode);
			fwrite($logFileIndex,$findex);
			fclose($logFileIndex);
            
            $fmode = "a+";
			$fProcess = fopen($logForProcessFilePath,$fmode);
			fwrite($fProcess,$logContent);
			fclose($fProcess);
		}
	}               
}
?>