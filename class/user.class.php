<?php
class User{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function getAccountInfo(){
    	$this->db->query('SELECT * FROM api_token');
		$this->db->execute();
		$dataset = $this->db->single();

		print_r($dataset);
    }
    
	// public function toggleStatus($device_id){
	// 	$this->getdevice($device_id);

	// 	if($this->status == 'active')
	// 		$status = 'disable';
	// 	else
	// 		$status = 'active';

	// 	parent::query('UPDATE devices SET status = :status,update_time = :update_time,ip = :ip WHERE id = :device_id');
	// 	parent::bind(':status' 		,$status);
	// 	parent::bind(':ip' 			,parent::GetIpAddress());
	// 	parent::bind(':update_time' , date('Y-m-d H:i:s'));
	// 	parent::bind(':device_id' 	,$device_id);
	// 	parent::execute();
	// }
}
?>
