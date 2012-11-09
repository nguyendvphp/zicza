<?php

/**
 * This is the model class for table "{{gallery}}".
 *
 * The followings are the available columns in table '{{gallery}}':
 * @property integer $id
 * @property string $gallery_title
 * @property string $gallery_description
 * @property integer $gallery_price
 * @property integer $gallery_number
 * @property string $gallery_size_album
 * @property string $gallery_time_trans
 * @property integer $gallery_is_slideshow
 * @property integer $gallery_shirt_married
 * @property string $gallery_time_photo
 * @property string $gallery_uniform
 * @property integer $gallery_status
 * @property integer $gallery_cate_id
 */
class AGallery extends Gallery
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AGallery the static model class
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
		return '{{gallery}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gallery_price, gallery_number, gallery_is_slideshow, gallery_shirt_married, gallery_status, gallery_cate_id', 'numerical', 'integerOnly'=>true),
			array('gallery_title', 'length', 'max'=>255),
			array('gallery_size_album', 'length', 'max'=>128),
			array('gallery_description, gallery_time_trans, gallery_time_photo, gallery_uniform', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gallery_title, gallery_description, gallery_price, gallery_number, gallery_size_album, gallery_time_trans, gallery_is_slideshow, gallery_shirt_married, gallery_time_photo, gallery_uniform, gallery_status, gallery_cate_id', 'safe', 'on'=>'search'),
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
			'gallery_title' => Yii::t('adm/gallery','gallery_title'),
			'gallery_description' => Yii::t('adm/gallery','gallery_description'),
			'gallery_price' => Yii::t('adm/gallery','gallery_price'),
			'gallery_number' => Yii::t('adm/gallery','gallery_number'),
			'gallery_size_album' => Yii::t('adm/gallery','gallery_size_album'),
			'gallery_time_trans' => Yii::t('adm/gallery','gallery_time_trans'),
			'gallery_is_slideshow' => Yii::t('adm/gallery','gallery_is_slideshow'),
			'gallery_shirt_married' => Yii::t('adm/gallery','gallery_shirt_married'),
			'gallery_time_photo' => Yii::t('adm/gallery','gallery_time_photo'),
			'gallery_uniform' => Yii::t('adm/gallery','gallery_uniform'),
			'gallery_status' => Yii::t('adm/gallery','gallery_status'),
			'gallery_cate_id' => Yii::t('adm/gallery','gallery_cate_id'),
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
		$criteria->compare('gallery_title',$this->gallery_title,true);
		$criteria->compare('gallery_description',$this->gallery_description,true);
		$criteria->compare('gallery_price',$this->gallery_price);
		$criteria->compare('gallery_number',$this->gallery_number);
		$criteria->compare('gallery_size_album',$this->gallery_size_album,true);
		$criteria->compare('gallery_time_trans',$this->gallery_time_trans,true);
		$criteria->compare('gallery_is_slideshow',$this->gallery_is_slideshow);
		$criteria->compare('gallery_shirt_married',$this->gallery_shirt_married);
		$criteria->compare('gallery_time_photo',$this->gallery_time_photo,true);
		$criteria->compare('gallery_uniform',$this->gallery_uniform,true);
		$criteria->compare('gallery_status',$this->gallery_status);
		$criteria->compare('gallery_cate_id',$this->gallery_cate_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}