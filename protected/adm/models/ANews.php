<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property integer $news_category_id
 * @property string $news_title
 * @property string $news_short_description
 * @property string $news_detail
 * @property integer $status
 * @property integer $priority
 * @property string $created_time
 * @property string $created_by
 * @property string $updated_time
 * @property string $updated_by
 * @property integer $image_id
 *
 * The followings are the available model relations:
 * @property NewsCategories $newsCategory
 * @property Images $image
 */
class ANews extends News
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ANews the static model class
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
		return '{{news}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('news_category_id, status, priority, image_id', 'numerical', 'integerOnly'=>true),
			array('news_title, news_short_description, created_by, updated_by', 'length', 'max'=>255),
			array('news_detail, created_time, updated_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, news_category_id, news_title, news_short_description, news_detail, status, priority, created_time, created_by, updated_time, updated_by, image_id', 'safe', 'on'=>'search'),
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
			'newsCategory' => array(self::BELONGS_TO, 'NewsCategories', 'news_category_id'),
			'image' => array(self::BELONGS_TO, 'Images', 'image_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'news_category_id' => Yii::t('adm/news','news_category_id'),
			'news_title' => Yii::t('adm/news','news_title'),
			'news_short_description' => Yii::t('adm/news','news_short_description'),
			'news_detail' => Yii::t('adm/news','news_detail'),
			'status' => Yii::t('adm/news','status'),
			'priority' => Yii::t('adm/news','priority'),
			'created_time' => Yii::t('adm/news','created_time'),
			'created_by' => Yii::t('adm/news','created_by'),
			'updated_time' => Yii::t('adm/news','updated_time'),
			'updated_by' => Yii::t('adm/news','updated_by'),
			'image_id' => Yii::t('adm/news','image_id'),
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
		$criteria->compare('news_category_id',$this->news_category_id);
		$criteria->compare('news_title',$this->news_title,true);
		$criteria->compare('news_short_description',$this->news_short_description,true);
		$criteria->compare('news_detail',$this->news_detail,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('priority',$this->priority);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('updated_time',$this->updated_time,true);
		$criteria->compare('updated_by',$this->updated_by,true);
		$criteria->compare('image_id',$this->image_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}