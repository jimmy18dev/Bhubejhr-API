<?php
class Account{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function create(){}
    
    public function lock(){}
    public function unlock(){}
    public function delete(){}
}
?>
