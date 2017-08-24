<?php
class Queries{

    public $id;
    public $name;
    public $description;
    public $query;
    public $url_example;
    public $create_time;
    public $update_time;
    public $ip;
    public $type;
    public $status;

    public $user_id;
    public $user_username;

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function getQuery($qid){
    	$this->db->query('SELECT query FROM api_queries WHERE id = :qid');
    	$this->db->bind(':qid',$qid);
		$this->db->execute();
		$dataset = $this->db->single();

		return $dataset['query'];
    }

    public function get($qid){
        $this->db->query('SELECT queries.id queries_id,queries.name queries_name,queries.description queries_description,queries.query queries_query,queries.url_example queries_url_example,queries.create_time queries_create_time,queries.update_time queries_update_time,queries.ip queries_ip,queries.type queries_type,queries.status queries_status,user.id user_id,user.username user_username FROM api_queries AS queries LEFT JOIN api_user AS user ON queries.user_id = user.id WHERE queries.id = :qid');
        $this->db->bind(':qid',$qid);
        $this->db->execute();
        $dataset = $this->db->single();

        $this->id               = $dataset['queries_id'];
        $this->name             = $dataset['queries_name'];
        $this->description      = $dataset['queries_description'];
        $this->query            = $dataset['queries_query'];
        $this->url_example      = $dataset['queries_url_example'];
        $this->create_time      = $dataset['queries_create_time'];
        $this->update_time      = $dataset['queries_update_time'];
        $this->ip               = $dataset['queries_ip'];
        $this->type             = $dataset['queries_type'];
        $this->status           = $dataset['queries_status'];

        $this->user_id          = $dataset['user_id'];
        $this->user_username    = $dataset['user_username'];

    }

    public function process($query,$parameter){
    	$this->db->query($query);
        try {
            foreach ($parameter as $k => $v) {
                if($k != 'calling' && $k != 'qid'&& $k != 'token'){
                    $this->db->bind(":".$k,$v);
                }
            }

            $this->db->execute();
            $dataset = $this->db->resultset();
            return $dataset;
        } catch (Exception $e) {
            return 'Invalid parameter number: parameter was not defined';
        }
    }

    public function createQuery($user_id,$name,$description,$query,$example,$type){

        $this->db->query('INSERT INTO api_queries(user_id,name,description,query,url_example,create_time,ip,type) VALUE(:user_id,:name,:description,:query,:url_example,:create_time,:ip,:type)');
        $this->db->bind(':user_id'      ,$user_id);
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':query'        ,$query);
        $this->db->bind(':url_example'  ,$url_example);
        $this->db->bind(':create_time'  ,date('Y-m-d H:i:s'));
        $this->db->bind(':ip'           ,$this->db->GetIpAddress());
        $this->db->bind(':type'         ,$type);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function editQuery($qid,$name,$description,$query,$url_example){
        $this->db->query('UPDATE api_queries SET name = :name, description = :description, query = :query, url_example = :url_example, update_time = :update_time, ip = :ip WHERE id = :qid');
        $this->db->bind(':qid'          ,$qid);
        $this->db->bind(':name'         ,$name);
        $this->db->bind(':description'  ,$description);
        $this->db->bind(':query'        ,$query);
        $this->db->bind(':url_example'  ,$url_example);
        $this->db->bind(':update_time'  ,date('Y-m-d H:i:s'));
        $this->db->bind(':ip'           ,$this->db->GetIpAddress());
        $this->db->execute();
    }

    public function deleteQuery($qid){
        $this->db->query('DELETE FROM api_queries WHERE id = :qid');
        $this->db->bind(':qid',$qid);
        $this->db->execute();
    }

    public function toggleStatus($qid){
        $this->get($qid);

        if($this->status == 'active')
            $status = 'disable';
        else
            $status = 'active';

        $this->db->query('UPDATE api_queries SET status = :status, update_time = :update_time, ip = :ip WHERE id = :qid');
        $this->db->bind(':qid'          ,$qid);
        $this->db->bind(':update_time'  ,date('Y-m-d H:i:s'));
        $this->db->bind(':ip'           ,$this->db->GetIpAddress());
        $this->db->bind(':status'       ,$status);
        $this->db->execute();
    }

    public function listAll(){
        $this->db->query('SELECT queries.id queries_id,queries.name queries_name,queries.description queries_description,queries.query queries_query,queries.url_example queries_url_example,queries.create_time queries_create_time,queries.update_time queries_update_time,queries.ip queries_ip,queries.type queries_type,queries.status queries_status,user.id user_id,user.username user_username,(SELECT COUNT(id) FROM api_log WHERE queries_id = queries.id AND DATE(create_time) = CURDATE()) request_count FROM api_queries AS queries LEFT JOIN api_user AS user ON queries.user_id = user.id ORDER BY queries.create_time DESC LIMIT 50');
        $this->db->execute();
        $dataset = $this->db->resultset();

        return $dataset;
    }

    public function requestCounter($qid){
        $this->db->query('SELECT create_time,COUNT(id) request FROM api_log WHERE queries_id = :qid GROUP BY DATE(create_time) ORDER BY create_time DESC LIMIT 7');
        $this->db->bind(':qid',$qid);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['request']   = floatval($var['request']);
            $dataset[$k]['create_time'] = $this->db->shortdate_thaiformat($var['create_time']);
        }

        return $dataset;
    }
}
?>
