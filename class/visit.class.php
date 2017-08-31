<?php
class Visit{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listVisit($hn){
        
        if(empty($hn)) return false;

        $this->db->query('SELECT * FROM visit WHERE hn = :hn LIMIT 200');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        return $dataset = $this->db->resultset();
    }
}
?>

