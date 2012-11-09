<?php
class ASystemUser extends SystemUser{
    
	public static function getCpNameByCpCode($cp_code){
	   $connection = Yii::app()->db;
        $sql = "SELECT cp_name
                FROM {{content_provider}}
                WHERE cp_code = '".$cp_code."'";
        $command = $connection->createCommand($sql);
        $rs = $command->queryRow();
        if($rs) return $rs['cp_name'];
        else return false;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{system_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password,channel_code', 'required'),
			array('status, group_id', 'numerical', 'integerOnly'=>true),
			array('id, password', 'length', 'max'=>255),
			array('username, ip', 'length', 'max'=>50),
			array('created_date, lastest_login', 'safe'),
            array('email', 'email','message'=>Yii::t('adm/app','warning_email')),
            array('phonenumber', 'match', 'pattern'=>'/^([+]?[0-9 ]+)$/'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password,channel_code,cp_code, phonenumber, email, status, created_date, lastest_login, ip, group_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'groups' => array(self::BELONGS_TO, 'SystemGroup', 'group_id'),
		);
	}
    public function getSystemUserById($id){
        return ASystemUser::model()->find('id=:id',array(':id'=>$id));
    }
    
    public static function getUserNameById($id){
        $connection = Yii::app()->db;
        $sql = "SELECT username
                FROM {{system_user}}
                WHERE id = '".$id."'";
        $command = $connection->createCommand($sql);
        $rs = $command->queryRow();
        if(isset($rs) && $rs['username'] != ''){
            return $rs['username'];
        }else{
           return false;
        }
    }
    
    public static function changePass($id,$new_pass){
        $connection = Yii::app()->db;
        $sql = "UPDATE {{system_user}} SET password='$new_pass' WHERE id='$id'";
        $command = $connection->createCommand($sql);
        return $command->execute();
    } 

	
}
?>