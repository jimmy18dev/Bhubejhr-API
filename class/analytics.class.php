<?php
class Analytics{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listPatient(){
    	$this->db->query('SELECT * FROM patient LIMIT 5');
		$this->db->execute();
		$dataset = $this->db->resultset();

		return $dataset;
    }
}
?>
