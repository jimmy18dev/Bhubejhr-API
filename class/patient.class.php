<?php
class Patient{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($cid){
        $this->db->query('SELECT * FROM patient WHERE cid = :cid');
        $this->db->bind(':cid',$cid);
        $this->db->execute();
        return $dataset = $this->db->single();
    }
}
?>

