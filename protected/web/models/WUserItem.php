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
 */
class WUserItem extends UserItem
{
    public $address;
    public $phonenumber;
    public $skype;
    public $yahoo;
    public $url;
    public $price;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return WUserItem the static model class
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
            array('title, description, image','required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('status', 'length', 'max'=>10),
			array('description, image, created_date, latest_update', 'safe'),
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
			'title' => 'Tên shop',
			'description' => 'Giới thiệu shop',
			'image' => 'Ảnh đại diện',
			'status' => 'Trạng thái',
			'created_date' => 'Ngày tạo',
			'latest_update' => 'Ngày cập nhật',
            'address'=>'Địa chỉ',
            'phonenumber'=>'Số điện thoại',
            'url'=>'Link liên kết',
            'price'=>'Giá sản phẩm',
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
        $criteria->compare('options',$this->options,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getListitem($user_id = '', $offset = 0, $limit = null){
        $criteria=new CDbCriteria;
        $criteria->select = '*';
        if(isset($user_id) && $user_id !=''){
            $criteria->condition = 'status=:status and user_id=:user_id';
            $criteria->params = array(
                ':status'=> 1,
                ':user_id' => $user_id
            );
        }else{
            $criteria->condition = 'status=:status';
            $criteria->params = array(
                ':status'=> 1,
            );
        }
        
        $criteria->offset = $offset;
        $criteria->order = 'created_date DESC';
        if(!is_null($limit))
            $criteria->limit = $limit;
        
        $rs = WUserItem::model()->findAll($criteria);
        return $rs;
    }
    
    public static function countUserItem(){
        return count(WUserItem::model()->findAll('status=:status',array(':status'=>1)));
   }
   
   public static function getDetailShop($id){
        $criteria = new CDbCriteria;
        $criteria->select = '*';
        $criteria->condition = 'id=:id and status=:status';
        $criteria->params = array(
            ':id' => $id,
            ':status'=> 1
        );
        
        $rs = WUserItem::model()->find($criteria);
        return $rs;
   }
   public static function getCountComment($vote_type, $item_id, $offset = 0, $limit = null, $orderby = "RAND()"){
        return count(self::getListComment($vote_type, $item_id));
   }
   
    public static function getListComment($vote_type, $item_id, $offset = 0, $limit = null, $orderby = "RAND()"){
        
        $criteria = new CDbCriteria;
        $criteria->alias = 'c';
        $criteria->select = '*';
        $criteria->join = 'LEFT JOIN {{item_vote}} i ON i.facebook_email = c.facebook_email';
        $criteria->condition = 'c.status=:status1 and i.status =:status and i.vote_type=:vote_type and i.item_id=:item_id';
        $criteria->params = array(
            ':status' => 1,
            ':status1' => 1,
            ':vote_type'=>$vote_type,
            ':item_id' => $item_id
        );
        $criteria->order = $orderby;
        $criteria->offset = $offset;
        if(!is_null($limit))
            $criteria->limit = $limit;
            
        $rs = WItemComment::model()->findAll($criteria);
        return $rs;
        
    }
   
}