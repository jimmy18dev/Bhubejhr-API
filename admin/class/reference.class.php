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

    public function create($user_id,$name,$description,$example,$category,$method,$type){
        $this->db->query('INSERT INTO api_reference(method,user_id,category_id,name,description,create_time,ip,type) VALUE(:method,:user_id,:category,:name,:description,:create_time,:ip,:type)');
        $this->db->bind(':user_id'      ,$user_id);
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':create_time'  ,date('Y-m-d H:i:s'));
        $this->db->bind(':ip'           ,$this->db->GetIpAddress());
        $this->db->bind(':category'     ,$category);
        $this->db->bind(':method'       ,$method);
        $this->db->bind(':type'         ,$type);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function edit($ref_id,$name,$description,$example,$category,$method,$type){
        $this->db->query('UPDATE api_reference SET name = :name, description = :description,example = :example,category_id = :category,method = :method,type = :type,update_time = :update_time WHERE id = :ref_id');
        $this->db->bind(':ref_id'       ,$ref_id);
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':example'      ,$example);
        $this->db->bind(':category'     ,$category);
        $this->db->bind(':method'       ,$method);
        $this->db->bind(':type'         ,$type);
        $this->db->bind(':update_time'  ,date('Y-m-d H:i:s'));
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
        $this->method = $dataset['method'];
        $this->category_id = $dataset['category_id'];
        $this->type = $dataset['type'];
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

    public function alldayUsage($ref_id){
        $this->db->query('SELECT CONCAT(Hour,":00") AS hours ,COUNT(create_time) AS "usage" FROM api_log RIGHT JOIN ( SELECT 0 AS Hour UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9 UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12 UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15 UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18 UNION ALL SELECT 19 UNION ALL SELECT 20 UNION ALL SELECT 21 UNION ALL SELECT 22 UNION ALL SELECT 23 ) AS AllHours ON HOUR(create_time) = Hour WHERE (create_time BETWEEN CURDATE() AND NOW() AND ref_id = :ref_id) OR create_time IS NULL GROUP BY Hour ORDER BY Hour');
        $this->db->bind(':ref_id',$ref_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var){
            $dataset[$k]['usage'] = floatval($var['usage']);
        }

        return $dataset;
    }

    public function today($ref_id){
        $this->db->query('SELECT log.id log_id,log.executed log_executed,log.create_time log_time,log.param log_param,log.ref_id,ref.id ref_id,ref.name ref_name,ref.method ref_method,ref.type ref_type,category.name category_name,category.id category_id,app.id app_id,app.name app_name FROM api_log AS log LEFT JOIN api_reference AS ref ON log.ref_id = ref.id LEFT JOIN api_app AS app ON log.app_id = app.id LEFT JOIN api_category AS category ON ref.category_id = category.id WHERE log.ref_id = :ref_id AND DATE(log.create_time) = CURDATE() ORDER BY log.create_time DESC LIMIT 50');
        $this->db->bind(':ref_id',$ref_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    public function allday($ref_id){
        $this->db->query('SELECT log.id log_id,log.executed log_executed,log.create_time log_time,log.param log_param,log.ref_id,ref.id ref_id,ref.name ref_name,ref.method ref_method,ref.type ref_type,category.name category_name,category.id category_id,app.id app_id,app.name app_name FROM api_log AS log LEFT JOIN api_reference AS ref ON log.ref_id = ref.id LEFT JOIN api_app AS app ON log.app_id = app.id LEFT JOIN api_category AS category ON ref.category_id = category.id WHERE log.ref_id = :ref_id AND DATE(log.create_time) != CURDATE() ORDER BY log.create_time DESC LIMIT 50');
        $this->db->bind(':ref_id',$ref_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function totalRequest($ref_id){
        $this->db->query('SELECT COUNT(id) total FROM api_log WHERE ref_id = :ref_id');
        $this->db->bind(':ref_id',$ref_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['total'];
    }
    public function todayRequest($ref_id){
        $this->db->query('SELECT COUNT(id) total FROM api_log WHERE ref_id = :ref_id AND DATE(create_time) = CURDATE()');
        $this->db->bind(':ref_id',$ref_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['total'];
    }
    public function AvgExecuteTime($ref_id){
        $this->db->query('SELECT AVG(executed) executed FROM api_log WHERE ref_id = :ref_id AND DATE(create_time) = CURDATE()');
        $this->db->bind(':ref_id',$ref_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['executed'];
    }
}
?>
