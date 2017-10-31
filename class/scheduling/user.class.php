<?php
class User{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($date){
        $this->db->query('SELECT s.fname,s.lname,vc.registertime
from visit v
INNER JOIN visit_clinic vc ON v.id = vc.id
INNER JOIN sys_user s ON s.uid = vc.userupdate
INNER JOIN sys_access_user_group sg ON s.uid = sg.uid AND sg.gid = 2
WHERE -- date(visitdate) = DATE(NOW())
date(visitdate) = :date
GROUP BY s.uid limit 100');
        $this->db->bind(':date',$date);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
}
?>
