<?php
class Diag{
    
	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }
}
?>
