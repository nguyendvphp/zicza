<?php
class SystemLog extends CFileLogRoute
{
	private static $_instance;
	
	public function __construct($logFolderPath = null)
	{
		if($this->getLogPath()===null) $this->setLogPath(Yii::app()->getRuntimePath());
		if(!is_null($logFolderPath))$this->_createLogFolder($logFolderPath);
	}
	
	protected $_logFolder = "";
	public function setLogFolder($value){ $this->_logFolder = $value; }
	public function getLogFolder(){ return $this->_logFolder; }
	
	public static function getInstance($logFolderPath = null)
	{
		if(!is_object(self::$_instance))
		{
			self::$_instance = new SystemLog($logFolderPath);
		}
		return self::$_instance;
	}
	
	public function init()
	{
		parent::init();
	}
	
	protected function formatLogMessage( $message, $category = null, $level = 'I', $time = null )
	{
		if ( null === $time )
		$time = time();
		
		$level = strtoupper( $level[0] );
		
		return @date( 'Y m d H:i:s', $time ) . ' [' . sprintf( '%-20s', $category ) . '] ' . ': <' . $level . '> ' . $message . PHP_EOL;
	}
	
	protected function _createLogFolder($logFolderPath)
	{
		if($logFolderPath != "")
		{
			$paths = explode("/", $logFolderPath);
			try {
				foreach($paths as $_path)
				{
					ini_set('display_errors', 1);
					$_folderLogPath = $this->getLogPath() . DIRECTORY_SEPARATOR . $_path;
					
					if(!is_dir($_folderLogPath)) mkdir($_folderLogPath, 0777);
					$this->setLogPath($_folderLogPath);
				}
			}
			catch(Exception $_ex)
			{
				error_log(__METHOD__ . ': Exception processing create log folder path : ' . $_ex->getMessage() );
			}
		}
		return $this->getLogPath();
	}
	
	public function processWriteLogs($logs = array())
	{
		try{
			parent::processLogs($logs);
		}
		catch (Exception $_ex)
		{
			error_log( __METHOD__ . ': Exception processing application logs: ' . $_ex->getMessage() );
		}
	}
}

/**
 * example :
 * public function actionTestWriteLog()
	{
		$logs = array(
		array('Success', 'Request Game Build Link', 'I'),
		array('Fail', 'Commit Transaction', 'I')
		);
		
		$serviceLog = SystemLog::getInstance("2012/06");
		
		$serviceLog->processWriteLogs($logs);
	}
 */