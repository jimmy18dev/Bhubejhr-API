<?php
class Account{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }
    public function create($name,$username,$password,$permission,$owner_id){
        // Random password if password is empty value
        $salt       = hash('sha512',uniqid(mt_rand(1,mt_getrandmax()),true));
        // Create salted password
        $password   = hash('sha512',$password.$salt);

        if($this->already($username,$name)){

            $this->db->query('INSERT INTO api_user(username,name,password,salt,permission,ip,register_time,owner_id) VALUE(:username,:name,:password,:salt,:permission,:ip,:register_time,:owner_id)');
            $this->db->bind(':username'     ,$username);
            $this->db->bind(':name'         ,$name);
            $this->db->bind(':password'     ,$password);
            $this->db->bind(':salt'         ,$salt);
            $this->db->bind(':permission'   ,$permission);
            $this->db->bind(':ip'           ,$this->db->GetIpAddress());
            $this->db->bind(':register_time',date('Y-m-d H:i:s'));
            $this->db->bind(':owner_id'     ,$owner_id);
            $this->db->execute();

            $user_id = $this->db->lastInsertId();

        }else{
            return 0;
        }

        return $user_id;
    }

    public function already($username,$name){
        $this->db->query('SELECT id FROM api_user WHERE username = :username OR name = :name');
        $this->db->bind(':username',$username);
        $this->db->bind(':name',$name);
        $this->db->execute();
        $dataset = $this->db->single();

        if(empty($dataset['id'])){
            return true;
        }else{
            return false;
        }
    }

    public function listAll($owner_id){
    	$this->db->query('SELECT account.id,account.username,account.name,account.permission,account.status,account.register_time,account.edit_time,account.visit_time,account.owner_id FROM api_user AS account WHERE owner_id = :owner_id ORDER BY account.register_time DESC');
        $this->db->bind(':owner_id',$owner_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    
    public function lock(){}
    public function unlock(){}
    public function delete(){}
}
?>
