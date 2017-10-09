<?php
class Account{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function create(){}
    public function listAll($owner_id){
    	$this->db->query('SELECT account.id,account.username,account.name,account.permission,account.status,account.register_time,account.edit_time,account.visit_time,account.owner_id FROM api_user AS account WHERE owner_id = :owner_id');
        $this->db->bind(':owner_id',$owner_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    
    public function lock(){}
    public function unlock(){}
    public function delete(){}
}
?>
