<?php
class Preregister{

	private $db;

    public function __construct() {
    	global $localdb;
    	$this->db = $localdb;
    }

    public function get($cid){
    	$this->db->query('SELECT * FROM preregister WHERE cid = :cid');
        $this->db->bind(':cid',$cid);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset;
    }

    public function create($cid,$prename,$fname,$lname,$gender,$birthday,$nation,$religion,$address,$phone,$rightname,$parent_type,$parent_fname,$parent_lname,$parent_phone,$avatar,$symptom){

    	if($this->alreadyChecing($cid)){
    		$this->db->query('INSERT INTO preregister(cid,prename,fname,lname,gender,birthday,nation,religion,address,phone,rightname,parent_type,parent_fname,parent_lname,parent_phone,register_time,avatar,symptom) VALUE(:cid,:prename,:fname,:lname,:gender,:birthday,:nation,:religion,:address,:phone,:rightname,:parent_type,:parent_fname,:parent_lname,:parent_phone,:register_time,:avatar,:symptom)');

	    	$this->db->bind(':cid' 			,$cid);
	    	$this->db->bind(':prename' 		,$prename);
	    	$this->db->bind(':fname' 		,$fname);
	    	$this->db->bind(':lname' 		,$lname);
	    	$this->db->bind(':gender' 		,$gender);
	    	$this->db->bind(':birthday' 	,$birthday);
	    	$this->db->bind(':nation' 		,$nation);
	    	$this->db->bind(':religion' 	,$religion);
	    	$this->db->bind(':address' 		,$address);
	    	$this->db->bind(':phone' 		,$phone);
	    	$this->db->bind(':rightname' 	,$rightname);
	    	$this->db->bind(':parent_type' 	,$parent_type);
	    	$this->db->bind(':parent_fname' ,$parent_fname);
	    	$this->db->bind(':parent_lname' ,$parent_lname);
	    	$this->db->bind(':parent_phone' ,$parent_phone);
	    	$this->db->bind(':register_time',date('Y-m-d H:i:s'));
	    	$this->db->bind(':avatar' 		,$avatar);
	    	$this->db->bind(':symptom' 		,$symptom);
			$this->db->execute();
			return $this->db->lastInsertId();
    	}else{
    		return -1;
    	}
    }

    public function alreadyChecing($cid){
    	$this->db->query('SELECT id FROM preregister WHERE cid = :cid');
        $this->db->bind(':cid',$cid);
        $this->db->execute();
        $dataset = $this->db->single();

        if(empty($dataset['id']))
        	return true;
        else
        	return false;
    }
}
?>
