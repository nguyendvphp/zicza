<?php

/**
 * This is the model class for table "{{system_user}}".
 *
 * The followings are the available columns in table '{{system_user}}':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $fullname
 * @property integer $status
 * @property string $created_date
 * @property string $lastest_login
 * @property string $ip
 * @property integer $group_id
 * @property string $phonenumber
 * @property string $email
 */
class SystemUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SystemUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
			array('id, username, password,channel_code', 'required'),
			array('status, group_id', 'numerical', 'integerOnly'=>true),
			array('id, password, fullname, phonenumber, email', 'length', 'max'=>255),
			array('username, ip', 'length', 'max'=>50),
			array('created_date, lastest_login', 'safe'),
            array('username', 'unique', 'message' => Yii::t('adm/user',"This_users_name_already_exists")),
            array('email', 'unique', 'message' => Yii::t('adm/user',"This_users_email_address_already_exists")),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password,cp_code,channel_code, fullname, status, created_date, lastest_login, ip, group_id, phonenumber, email', 'safe', 'on'=>'search'),
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
            'owner' => array(self::BELONGS_TO, 'ContentProvider', 'cp_code')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => Yii::t('adm/user','username'),
			'password' => Yii::t('adm/user','password'),
			'status' => Yii::t('adm/user','status'),
			'created_date' => Yii::t('adm/user','create_date'),
			'lastest_login' => Yii::t('adm/user','last_login'),
			'ip' => 'Ip',
			'group_id' => Yii::t('adm/app','mnu_system_group'),
            'phonenumber' => Yii::t('adm/user','phonenumber'),
            'email' => Yii::t('adm/user','email'),
            'cp_code' => Yii::t('adm/user','cp_code'),
            'channel_code' => Yii::t('adm/user','channel_code'),
		);
	}
    
    protected function afterValidate(){ 
		parent::afterValidate();
		//$this->password = $this->encrypt($this->password,Yii::app()->params->hashkey);
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}

    public static function encrypt($value,$hashKey){
		return md5($hashKey.$value);
	}
    public function validatePassword($password,$hashKey){
	   return $this->password === $this->encrypt($password,$hashKey);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('lastest_login',$this->lastest_login,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('phonenumber',$this->phonenumber,true);
		$criteria->compare('email',$this->email,true);
        $criteria->compare('cp_code',$this->cp_code,true);
        $criteria->compare('channel_code',$this->channel_code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}