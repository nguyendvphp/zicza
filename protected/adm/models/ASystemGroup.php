<?php
class ASystemGroup extends SystemGroup{
    public $from;
    public $to;
    public function totalUserInGroup(){
		$user = ASystemGroup::model()->count(array(
			'condition' => 'group_id=:group_id',
			'params' => array(':group_id' => $this->id),
		));
		return $user;
	}
    /**
     * function get status
     */ 
    public static function getStatusOptions(){
          return array(
           '0' => 'Ngừng hoạt động',
           '1' => 'Kích hoạt',
           '2' => 'Bản nháp'
          );
     }
      public static function getStatusText($status_id){
          $statusOptions = ASystemGroup::getStatusOptions();
          return isset($statusOptions[$status_id])?$statusOptions[$status_id]:'unknown status({$status_id})';
      }
}
?>