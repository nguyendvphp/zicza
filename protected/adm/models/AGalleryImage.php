<?php

/**
 * This is the model class for table "{{gallery_image}}".
 *
 * The followings are the available columns in table '{{gallery_image}}':
 * @property integer $id
 * @property integer $gallery_id
 * @property string $image_name
 * @property string $image_ext
 * @property string $image_path
 * @property string $image_mine_type
 * @property integer $image_width
 * @property integer $image_height
 */
class AGalleryImage extends GalleryImage
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AGalleryImage the static model class
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
		return '{{gallery_image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gallery_id, image_width, image_height', 'numerical', 'integerOnly'=>true),
			array('image_name, image_mine_type', 'length', 'max'=>255),
			array('image_ext', 'length', 'max'=>10),
			array('image_path', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, gallery_id, image_name, image_ext, image_path, image_mine_type, image_width, image_height', 'safe', 'on'=>'search'),
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
			'gallery_id' => 'Gallery',
			'image_name' => 'Image Name',
			'image_ext' => 'Image Ext',
			'image_path' => 'Image Path',
			'image_mine_type' => 'Image Mine Type',
			'image_width' => 'Image Width',
			'image_height' => 'Image Height',
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
		$criteria->compare('gallery_id',$this->gallery_id);
		$criteria->compare('image_name',$this->image_name,true);
		$criteria->compare('image_ext',$this->image_ext,true);
		$criteria->compare('image_path',$this->image_path,true);
		$criteria->compare('image_mine_type',$this->image_mine_type,true);
		$criteria->compare('image_width',$this->image_width);
		$criteria->compare('image_height',$this->image_height);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}