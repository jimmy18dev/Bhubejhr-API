<?php
class App{

	private $db;

	public $id;
	public $name;
	public $description;
	public $toekn;
	public $create_time;
	public $update_time;
	public $active_time;
	public $ip;
	public $type;
	public $status;
	public $owner_id;
	public $owner_name;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($app_id){
    	$this->db->query('SELECT app.id app_id,app.user_id owner_id,user.name owner_name,app.name app_name,app.description app_description,app.token app_token,app.create_time app_create_time,app.update_time app_update_time,app.active_time app_active_time,app.ip app_ip,app.type app_type,app.status app_status FROM api_app AS app LEFT JOIN api_user AS user ON app.user_id = user.id WHERE app.id = :app_id');
    	$this->db->bind(':app_id',$app_id);
		$this->db->execute();
		$dataset = $this->db->single();

		$this->id = $dataset['app_id'];
		$this->owner_id = $dataset['owner_id'];
		$this->owner_name = $dataset['owner_name'];
		$this->name = $dataset['app_name'];
		$this->description = $dataset['app_description'];
		$this->token = $dataset['app_token'];
		$this->create_time = $dataset['app_create_time'];
		$this->update_time = $dataset['app_update_time'];
		$this->active_time = $dataset['app_active_time'];
		$this->ip = $dataset['app_ip'];
		$this->type = $dataset['app_type'];
		$this->status = $dataset['app_status'];

		return $dataset;
    }

	public function authentication($token){

		if(!$this->tokenValid($token)) return 0;

		$this->db->query('SELECT id FROM api_app WHERE token = :token');
		$this->db->bind(':token',$token);
		$this->db->execute();
		$dataset = $this->db->single();

		return $dataset['id'];
	}

    public function createApp($user_id,$name,$description){
    	
    	$token = $this->tokenGenerate(); // New Token

    	$this->db->query('INSERT INTO api_app(user_id,name,description,token,create_time,ip) VALUE(:user_id,:name,:description,:token,:create_time,:ip)');
    	$this->db->bind(':user_id' 		,$user_id);
    	$this->db->bind(':name' 		,$name);
    	$this->db->bind(':description' 	,$description);
    	$this->db->bind(':token' 		,$token);
    	$this->db->bind(':create_time' 	,date('Y-m-d H:i:s'));
    	$this->db->bind(':ip' 			,$this->db->GetIpAddress());
		$this->db->execute();
		return $this->db->lastInsertId();
    }

    public function editApp($app_id,$name,$description){
    	$this->db->query('UPDATE api_app SET name = :name, description = :description, update_time = :update_time, ip = :ip WHERE id = :app_id');
    	$this->db->bind(':app_id' 		,$app_id);
    	$this->db->bind(':name' 		,$name);
    	$this->db->bind(':description' 	,$description);
    	$this->db->bind(':update_time' 	,date('Y-m-d H:i:s'));
    	$this->db->bind(':ip' 			,$this->db->GetIpAddress());
		$this->db->execute();
    }

    public function deleteApp($app_id,$user_id){
    	$this->db->query('DELETE FROM api_app WHERE id = :app_id AND user_id = :user_id');
    	$this->db->bind(':app_id' 		,$app_id);
    	$this->db->bind(':user_id' 		,$user_id);
		$this->db->execute();
    }

    public function toggleStatus($app_id){

		$this->get($app_id);

		if($this->status == 'active')
			$status = 'disable';
		else
			$status = 'active';

		$this->db->query('UPDATE api_app SET status = :status, update_time = :update_time, ip = :ip WHERE id = :app_id');
		$this->db->bind(':app_id' 		,$app_id);
		$this->db->bind(':status' 		,$status);
		$this->db->bind(':ip' 			,$this->db->GetIpAddress());
		$this->db->bind(':update_time' , date('Y-m-d H:i:s'));
		$this->db->execute();
	}

    private function tokenGenerate(){
		$token = md5(bin2hex(mt_rand()));
		$token = substr_replace($token,'d',11,0); //eggxs
		return $token;
	}
	private function tokenValid($token){
		if(substr($token,11,1) == 'd')
			return true;
		else
			return false;
	}

    public function listAll($user_id){
    	$this->db->query('SELECT app.id app_id,app.name app_name,app.description app_description,app.token app_key,app.create_time app_create_time,app.update_time app_update_time,app.active_time app_active_time,app.ip app_ip,app.type app_type,app.status app_status,user.id user_id,user.username user_username,(SELECT COUNT(id) FROM api_log WHERE app_id = app.id AND DATE(create_time) = CURDATE()) request_count FROM api_app AS app LEFT JOIN api_user AS user ON app.user_id = user.id WHERE user_id = :user_id ORDER BY app.create_time DESC');
    	$this->db->bind(':user_id',$user_id);
		$this->db->execute();
		$dataset = $this->db->resultset();

		return $dataset;
    }

    public function log($app_id){
    	$this->db->query('SELECT log.id log_id,log.executed log_executed,log.create_time log_time,log.ref_id,ref.id ref_id,ref.name ref_name,ref.method ref_method,ref.type ref_type,category.name category_name,category.id category_id FROM api_log AS log LEFT JOIN api_reference AS ref ON log.ref_id = ref.id LEFT JOIN api_category AS category ON ref.category_id = category.id WHERE log.app_id = :app_id ORDER BY log.create_time DESC LIMIT 50');
    	$this->db->bind(':app_id',$app_id);
		$this->db->execute();
		$dataset = $this->db->resultset();
		return $dataset;
    }

    public function count(){
    	$this->db->query('SELECT COUNT(id) total FROM api_app');
		$this->db->execute();
		$dataset = $this->db->single();
		return $dataset['total'];
    }

    public function requestCounter($app_id){
        $this->db->query('SELECT create_time,COUNT(id) request FROM api_log WHERE app_id = :app_id GROUP BY DATE(create_time) ORDER BY create_time DESC LIMIT 7');
        $this->db->bind(':app_id',$app_id);
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
