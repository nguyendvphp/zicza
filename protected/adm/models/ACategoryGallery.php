<?php

/**
 * This is the model class for table "{{category_gallery}}".
 *
 * The followings are the available columns in table '{{category_gallery}}':
 * @property integer $id
 * @property string $category_title
 * @property string $category_description
 * @property integer $thumbnail
 * @property string $created_time
 * @property integer $status
 */
class ACategoryGallery extends CategoryGallery
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ACategoryGallery the static model class
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
		return '{{category_gallery}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
           // array('category_title'=>'required'),
			array('status, thumbnail', 'numerical', 'integerOnly'=>true),
			array('category_title, category_description', 'length', 'max'=>255),
			array('created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_title, category_description, thumbnail, created_time, status', 'safe', 'on'=>'search'),
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
			'category_title' => Yii::t('adm/gallery','category_title'),
			'category_description' => Yii::t('adm/gallery','category_description'),
			'thumbnail' => Yii::t('adm/gallery','thumbnail'),
			'created_time' => Yii::t('adm/gallery','created_time'),
			'status' => Yii::t('adm/gallery','status'),
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
		$criteria->compare('category_title',$this->category_title,true);
		$criteria->compare('category_description',$this->category_description,true);
		$criteria->compare('thumbnail',$this->thumbnail);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}