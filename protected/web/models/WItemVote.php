<?php

/**
 * This is the model class for table "{{item_vote}}".
 *
 * The followings are the available columns in table '{{item_vote}}':
 * @property integer $id
 * @property string $facebook_email
 * @property integer $item_id
 * @property string $vote_type
 * @property string $created_time
 * @property string $status
 */
class WItemVote extends ItemVote
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WItemVote the static model class
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
		return '{{item_vote}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id', 'numerical', 'integerOnly'=>true),
			array('vote_type, status', 'length', 'max'=>10),
			array('facebook_email, created_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, facebook_email, item_id, vote_type, created_time, status', 'safe', 'on'=>'search'),
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
			'facebook_email' => 'Facebook Email',
			'item_id' => 'Item',
			'vote_type' => 'Vote Type',
			'created_time' => 'Created Time',
			'status' => 'Status',
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
		$criteria->compare('facebook_email',$this->facebook_email,true);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('vote_type',$this->vote_type,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}