<?php
class Visit{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listVisit($hn){
        
        if(empty($hn)) return false;

        $this->db->query('SELECT *,CONCAT(YEAR(visitdate)-1957,lpad(MONTH(visitdate),2,"0"),lpad(visitno,5,"0")) as  vn FROM visit WHERE hn = :hn  order by visitdate desc LIMIT 500');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        return $dataset = $this->db->resultset();
    }
}
?>

