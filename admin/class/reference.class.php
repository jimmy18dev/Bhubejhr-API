<?php
class Reference{

    public $id;
    public $method;
    public $user_id;
    public $category_id;
    public $category_name;
    public $name;
    public $description;
    public $example;
    public $create_time;
    public $update_time;
    public $ip;
    public $type;
    public $status;

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function create($method,$user_id,$category_id,$name,$description,$type){
        $this->db->query('INSERT INTO api_reference(method,user_id,category_id,name,description,create_time,ip,type) VALUE(:method,:user_id,:category_id,:name,:description,:create_time,:ip,:type)');
        $this->db->bind(':method'       ,$method);
        $this->db->bind(':user_id'      ,$user_id);
        $this->db->bind(':category_id'  ,$category_id);
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':create_time'  ,date('Y-m-d H:i:s'));
        $this->db->bind(':ip'           ,$this->db->GetIpAddress());
        $this->db->bind(':type'         ,$type);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function edit($reference_id,$method,$category_id,$name,$description,$type){
        $this->db->query('UPDATE api_reference SET method = :method, category_id = :category_id, name = :name, description = :description, update_time = :update_time, ip = :ip, type = :type WHERE id = :reference_id');
        $this->db->bind(':reference_id' ,$reference_id);
        $this->db->bind(':method'       ,$method);
        $this->db->bind(':category_id'  ,$category_id);
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':update_time'  ,date('Y-m-d H:i:s'));
        $this->db->bind(':ip'           ,$this->db->GetIpAddress());
        $this->db->bind(':type'         ,$type);
        $this->db->execute();
    }

    public function get($reference_id){
        $this->db->query('SELECT ref.id,ref.method,ref.user_id,ref.category_id,ref.name,ref.description,ref.example,ref.create_time,ref.update_time,ref.ip,ref.type,ref.status FROM api_reference AS ref WHERE id = :reference_id');
        $this->db->bind(':reference_id',$reference_id);
        $this->db->execute();
        $dataset = $this->db->single();

        $this->id = $dataset['id'];
        $this->name = $dataset['name'];
        $this->description = $dataset['description'];
        $this->example = $dataset['example'];
        return $dataset;
    }

    public function listAll($category_id){
        $select = 'SELECT ref.id ref_id,ref.method ref_method,ref.user_id ref_user_id,user.name ref_user_name,ref.category_id ref_category_id,category.name ref_category_name,ref.name ref_name,ref.description ref_description,ref.example ref_example,ref.create_time ref_create_time,ref.update_time ref_update_time,ref.ip ref_ip,ref.type ref_type,ref.status ref_status FROM api_reference AS ref LEFT JOIN api_category AS category ON ref.category_id = category.id LEFT JOIN api_user AS user ON ref.user_id = user.id ';
        $where = 'WHERE 1=1 ';
        if(!empty($category_id)){
            $where_category = ' AND category_id = :category_id ';
        }
        $order = 'ORDER BY ref.method';

        $query_string = $select.$where.$where_category.$order;
        $this->db->query($query_string);

        if(!empty($category_id)){
            $this->db->bind(':category_id',$category_id);
        }

        $this->db->execute();
        $dataset = $this->db->resultset();

        return $dataset;
    }

    public function listCategory(){
        $this->db->query('SELECT category.id,category.name,category.description,category.status,(SELECT COUNT(id) FROM api_reference WHERE category_id = category.id) total FROM api_category AS category ORDER BY category.id');
        $this->db->execute();
        $dataset = $this->db->resultset();

        return $dataset;
    }

    public function count(){
        $this->db->query('SELECT COUNT(id) total FROM api_reference');
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['total'];
    }

    public function delete($reference_id){
        $this->db->query('DELETE FROM api_reference WHERE id = :reference_id');
        $this->db->bind(':reference_id',$reference_id);
        $this->db->execute();
    }
}
?>
