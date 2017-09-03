<?php
class Patient{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($cid){
        $this->db->query('SELECT p.hn as  hn,p.fname as fname,p.lname as lname,p.dob as dob,if(p.gender = 1,"ชาย","หญิง") as gender,p.cid as cid,cn.nationname as nationality,CONCAT(pa.address," ม.",pa.moo," ",pa.subdistrictname," ",pa.districtname," ",pa.provincename) as Address,p.tel as tel,cb.bloodgroupname as blood,pd.drug as drugallergy FROM patient p left JOIN view_PatAddressType1 pa ON p.hn = pa.hn  left join c_bloodgroup cb on cb.bloodgroupcode = p.blood left join c_nation cn on p.nationality = cn.nationcode LEFT JOIN pt_drugallergy pd ON p.hn = pd.hn WHERE p.cid = :cid or p.hn = :cid');
        $this->db->bind(':cid',$cid);
        $this->db->execute();
        return $dataset = $this->db->single();
    }
}
?>

