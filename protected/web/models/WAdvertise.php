<?php
class WAdvertise extends Advertise{
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
    
    public static function getListAdv($adv_code, $limit = 1, $order = "RAND()"){
        $advPositionOptions = WAdvertisePosition::model()->find(
            'adv_position_code = :adv_code',
            array(
                ':adv_code' => $adv_code
            )
        );
        
        $criteria = new CDbCriteria;
        $criteria->condition = "adv_code = :code AND adv_status = :status";
        $criteria->params = array(
            ':code' => $adv_code,
            ':status' => WAdvertise::ADVERTISE_ACTIVE
        );
        $criteria->limit = $advPositionOptions->num_adv;
        $criteria->order = $order;
        $rs = self::model()->findAll($criteria);
        return $rs;
    }
}

?>