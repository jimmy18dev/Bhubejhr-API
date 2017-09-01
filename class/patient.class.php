<?php
class Patient{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($cid){
        $this->db->query('SELECT p.hn as  hn,p.fname as fname,p.lname as lname,p.dob as dob,if(p.gender = 1,"ชาย","หญิง") as gender,p.cid as cid,p.nationality as nationality,CONCAT(pa.address," ม.",pa.moo," ",pa.subdistrictname," ",pa.districtname," ",pa.provincename) as Address,p.tel as tel,p.blood as blood FROM patient p 
left JOIN view_PatAddressType1 pa ON p.hn = pa.hn 
WHERE p.cid = :cid or p.hn = :cid');
        $this->db->bind(':cid',$cid);
        $this->db->execute();
        return $dataset = $this->db->single();
    }
}
?>

