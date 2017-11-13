<?php
class Log{

	private $db;

    public function __construct() {
    	global $localdb;
    	$this->db = $localdb;
    }

    public function save($app_id,$request_id,$param,$executed){
    	$this->db->query('INSERT api_log(app_id,ref_id,param,executed,create_time) VALUE(:app_id,:request_id,:param,:executed,:create_time)');
    	$this->db->bind(':app_id' 		,$app_id);
    	$this->db->bind(':request_id' 	,$request_id);
        $this->db->bind(':param'        ,$param);
    	$this->db->bind(':executed' 	,$executed);
    	$this->db->bind(':create_time' 	,date('Y-m-d H:i:s'));
		$this->db->execute();
		return $this->db->lastInsertId();
    }

    public function updateAccessTime($app_id){
        $this->db->query('UPDATE api_app SET access_time = :access_time WHERE id = :app_id');
        $this->db->bind(':app_id'       ,$app_id);
        $this->db->bind(':access_time'  ,date('Y-m-d H:i:s'));
        $this->db->execute();
    }
}
?>
