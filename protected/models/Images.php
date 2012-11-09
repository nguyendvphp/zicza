<?php

/**
 * This is the model class for table "{{images}}".
 *
 * The followings are the available columns in table '{{images}}':
 * @property integer $id
 * @property string $image_title
 * @property string $image_ext
 * @property string $image_path
 * @property string $image_mime_type
 * @property integer $image_width
 * @property integer $image_height
 * @property integer $image_size
 */
class Images extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Images the static model class
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
		return '{{images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('image_width, image_height, image_size', 'numerical', 'integerOnly'=>true),
			array('image_title', 'length', 'max'=>255),
			array('image_ext', 'length', 'max'=>10),
			array('image_mime_type', 'length', 'max'=>50),
			array('image_path', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, image_title, image_ext, image_path, image_mime_type, image_width, image_height, image_size', 'safe', 'on'=>'search'),
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
			'image_title' => 'Image Title',
			'image_ext' => 'Image Ext',
			'image_path' => 'Image Path',
			'image_mime_type' => 'Image Mime Type',
			'image_width' => 'Image Width',
			'image_height' => 'Image Height',
			'image_size' => 'Image Size',
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
		$criteria->compare('image_title',$this->image_title,true);
		$criteria->compare('image_ext',$this->image_ext,true);
		$criteria->compare('image_path',$this->image_path,true);
		$criteria->compare('image_mime_type',$this->image_mime_type,true);
		$criteria->compare('image_width',$this->image_width);
		$criteria->compare('image_height',$this->image_height);
		$criteria->compare('image_size',$this->image_size);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}