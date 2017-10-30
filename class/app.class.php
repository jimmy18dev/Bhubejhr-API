<?php
class App{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

	public function authentication($token){

		if(!$this->tokenValid($token)) return 0;
		
		$this->db->query('SELECT id FROM api_app WHERE token = :token');
		$this->db->bind(':token',$token);
		$this->db->execute();
		$dataset = $this->db->single();

		return $dataset['id'];
	}
	private function tokenValid($token){
		if(substr($token,11,1) == 'd')
			return true;
		else
			return false;
	}
}
?>
