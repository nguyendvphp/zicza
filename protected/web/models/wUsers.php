<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $fullname
 * @property string $birthday
 * @property string $company
 * @property string $url
 * @property string $phone
 * @property string $mobile
 * @property string $address
 * @property string $group
 * @property string $created_by
 * @property string $created_date
 * @property string $last_login
 * @property string $active_key
 * @property string $status
 */
class wUsers extends Users
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return wUsers the static model class
	 */
     
    public $repassword; 
     
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('username, fullname, password, mobile, email, address, repassword','required'),
            array('password', 'compare', 'compareAttribute'=>'repassword'),
			array('id', 'length', 'max'=>255),
			array('username, created_by', 'length', 'max'=>50),
			array('password', 'length', 'max'=>80),
			array('email, fullname, company, active_key', 'length', 'max'=>100),
			array('url, address', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>15),
			array('mobile', 'length', 'max'=>12),
			array('group, status', 'length', 'max'=>20),
			array('birthday, created_date, last_login', 'safe'),
            array('username', 'unique', 'message' => Yii::t('app/app',"user_exist")),
            array('email', 'unique', 'message' => Yii::t('app/app',"email_exist")),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, fullname, birthday, company, url, phone, mobile, address, group, created_by, created_date, last_login, active_key, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username' => Yii::t('web/app','username'),
			'password' => Yii::t('web/app','password'),
            'repassword' => Yii::t('web/app','repassword'),
			'email' => Yii::t('web/app','email'),
			'fullname' => Yii::t('web/app','fullname'),
			'birthday' => Yii::t('web/app','birthday'),
			'company' => Yii::t('web/app','company'),
			'url' => Yii::t('web/app','url'),
			'phone' => Yii::t('web/app','phone'),
			'mobile' => Yii::t('web/app','mobile'),
			'address' => Yii::t('web/app','address'),
			'group' => Yii::t('web/app','group'),
			'created_by' => Yii::t('web/app','created_by'),
			'created_date' => Yii::t('web/app','created_date'),
			'last_login' => Yii::t('web/app','last_login'),
			'active_key' => Yii::t('web/app','active_key'),
			'status' => Yii::t('web/app','status'),
		);
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('group',$this->group,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('active_key',$this->active_key,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function validatePassword($password,$hashKey){
        
	   return $this->password === CFunction::encrypt($password,$hashKey);
	}
    
    public static function updateActive($status,$activekey,$email){
        $connection=Yii::app()->db;
        $sql = "Update {{users}} Set status='".$status."', activekey='".$activekey."' where email='".$email."'";
        $command=$connection->createCommand($sql);  
        $exec = $command->execute();
        if($exec){
            return true;
        }else{
            return false;
        }
    }
}