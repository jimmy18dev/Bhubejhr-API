<?php
class Log{

	private $db;

    public function __construct() {
    	global $localdb;
    	$this->db = $localdb;
    }

    public function save($app_id,$request_id,$executed){
    	$this->db->query('INSERT api_log(app_id,ref_id,executed,create_time) VALUE(:app_id,:request_id,:executed,:create_time)');
    	$this->db->bind(':app_id' 		,$app_id);
    	$this->db->bind(':request_id' 	,$request_id);
    	$this->db->bind(':executed' 	,$executed);
    	$this->db->bind(':create_time' 	,date('Y-m-d H:i:s'));
		$this->db->execute();
		return $this->db->lastInsertId();
    }
}
?>
