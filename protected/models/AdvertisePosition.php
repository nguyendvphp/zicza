<?php

/**
 * This is the model class for table "{{advertise_position}}".
 *
 * The followings are the available columns in table '{{advertise_position}}':
 * @property integer $id
 * @property string $adv_position_name
 * @property string $adv_position_code
 * @property integer $adv_width
 * @property integer $adv_height
 * @property integer $status
 * @property integer $num_adv
 */
class AdvertisePosition extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdvertisePosition the static model class
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
		return '{{advertise_position}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adv_position_name, adv_position_code, adv_width', 'required'),
			array('adv_width, adv_height, status, num_adv', 'numerical', 'integerOnly'=>true),
			array('adv_position_name', 'length', 'max'=>255),
			array('adv_position_code', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, adv_position_name, adv_position_code, adv_width, adv_height, status, num_adv', 'safe', 'on'=>'search'),
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
			'adv_position_name' => Yii::t('adm/game','adv_position_name'),
			'adv_position_code' => Yii::t('adm/game','adv_position_code'),
			'adv_width' => Yii::t('adm/game','adv_width'),
			'adv_height' => Yii::t('adm/game','adv_height'),
			'status' => Yii::t('adm/game','status'),
			'num_adv' => Yii::t('adm/game','num_adv'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('adv_position_name',$this->adv_position_name,true);
		$criteria->compare('adv_position_code',$this->adv_position_code,true);
		$criteria->compare('adv_width',$this->adv_width);
		$criteria->compare('adv_height',$this->adv_height);
		$criteria->compare('status',$this->status);
		$criteria->compare('num_adv',$this->num_adv);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}