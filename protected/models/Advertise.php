<?php

/**
 * This is the model class for table "{{advertise}}".
 *
 * The followings are the available columns in table '{{advertise}}':
 * @property integer $id
 * @property string $adv_position_id
 * @property string $adv_name
 * @property string $adv_description
 * @property string $adv_file_type
 * @property string $adv_file
 * @property string $adv_link
 * @property integer $adv_begin_date
 * @property integer $adv_exprited_date
 * @property integer $adv_count
 * @property integer $adv_sort
 * @property integer $adv_status
 * @property string $adv_code
 */
class Advertise extends CActiveRecord
{
    const ADVERTISE_ACTIVE = 1;
    const ADVERTISE_INACTIVE = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Advertise the static model class
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
		return '{{advertise}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adv_begin_date, adv_exprited_date, adv_count, adv_sort, adv_status', 'numerical', 'integerOnly'=>true),
			array('adv_position_id, adv_file', 'length', 'max'=>50),
			array('adv_name, adv_link', 'length', 'max'=>255),
			array('adv_file_type', 'length', 'max'=>100),
			array('adv_description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, adv_position_id, adv_name, adv_description, adv_file_type, adv_file, adv_link, adv_begin_date, adv_exprited_date, adv_count, adv_sort, adv_status', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'adv_position_id' => 'Adv Position',
			'adv_name' => 'Adv Name',
			'adv_description' => 'Adv Description',
			'adv_file_type' => 'Adv File Type',
			'adv_file' => 'Adv File',
			'adv_link' => 'Adv Link',
			'adv_begin_date' => 'Adv Begin Date',
			'adv_exprited_date' => 'Adv Exprited Date',
			'adv_count' => 'Adv Count',
			'adv_sort' => 'Adv Sort',
			'adv_status' => 'Adv Status',
			'adv_code' => 'Adv Code',
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
		$criteria->compare('adv_position_id',$this->adv_position_id,true);
		$criteria->compare('adv_name',$this->adv_name,true);
		$criteria->compare('adv_description',$this->adv_description,true);
		$criteria->compare('adv_file_type',$this->adv_file_type,true);
		$criteria->compare('adv_file',$this->adv_file,true);
		$criteria->compare('adv_link',$this->adv_link,true);
		$criteria->compare('adv_begin_date',$this->adv_begin_date);
		$criteria->compare('adv_exprited_date',$this->adv_exprited_date);
		$criteria->compare('adv_count',$this->adv_count);
		$criteria->compare('adv_sort',$this->adv_sort);
		$criteria->compare('adv_status',$this->adv_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}