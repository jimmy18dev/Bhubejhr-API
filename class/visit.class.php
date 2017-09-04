<?php
class Visit{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listVisit($hn){
        
        if(empty($hn)) return false;

        $this->db->query('SELECT v.*,CONCAT(YEAR(visitdate)-1957,lpad(MONTH(visitdate),2,"0"),lpad(visitno,5,"0")) as vn,cr.rightname as rightname
            FROM visit v
            inner join visit_ins vi on v.id = vi.id
            inner join c_righthos cr on vi.inshos = cr.rightcode
            WHERE hn = :hn  
            order by visitdate desc LIMIT 500');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        return $dataset = $this->db->resultset();
    }
}
?>

