<?php

/**
 * This is the model class for table "{{user_item}}".
 *
 * The followings are the available columns in table '{{user_item}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $status
 * @property string $created_date
 * @property string $latest_update
 * @property string $options
 * @property string $type
 */
class UserItem extends CActiveRecord
{
    const TYPE_SHOP = 'shop';
    const TYPE_PRODUCT = 'product';
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserItem the static model class
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
		return '{{user_item}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('status', 'length', 'max'=>10),
			array('description, image, created_date, latest_update, options', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, title, description, image, status, created_date, latest_update', 'safe', 'on'=>'search'),
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
            'image' => array(self::BELONGS_TO, 'Images', 'image'),
            'itemvote' => array(self::HAS_MANY, 'ItemVote', 'item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'title' => 'Title',
			'description' => 'Description',
			'image' => 'Image',
			'status' => 'Status',
			'created_date' => 'Created Date',
			'latest_update' => 'Latest Update',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('latest_update',$this->latest_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}