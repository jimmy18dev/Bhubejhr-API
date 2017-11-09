<?php
class Log{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function save($app_id,$queries_id,$executed){
    	$this->db->query('INSERT api_log(app_id,queries_id,executed,create_time) VALUE(:app_id,:queries_id,:executed,:create_time)');
    	$this->db->bind(':app_id' 		,$app_id);
    	$this->db->bind(':queries_id' 	,$queries_id);
    	$this->db->bind(':executed' 		,$executed);
    	$this->db->bind(':create_time' 	,date('Y-m-d H:i:s'));
		$this->db->execute();
		return $this->db->lastInsertId();
    }

    public function listByAppID($app_id){
        $this->db->query('SELECT log.id log_id,log.app_id app_id,log.queries_id,queries.name queries_name,log.create_time log_time,log.executed log_executed FROM api_log AS log LEFT JOIN api_queries AS queries ON log.queries_id = queries.id WHERE log.app_id = :app_id AND DATE(log.create_time) = CURDATE() LIMIT 100');
        $this->db->bind(':app_id',$app_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function listByQID($qid){
        $this->db->query('SELECT log.id log_id,log.app_id,log.queries_id,log.create_time log_time,log.executed log_executed,app.name app_name FROM api_log AS log LEFT JOIN api_app AS app ON log.app_id = app.id WHERE log.queries_id = :qid AND DATE(log.create_time) = CURDATE() LIMIT 100');
        $this->db->bind(':qid',$qid);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function totalRequest($app_id){
        $this->db->query('SELECT COUNT(id) total FROM api_log WHERE app_id = :app_id');
        $this->db->bind(':app_id',$app_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['total'];
    }
    public function todayRequest($app_id){
        $this->db->query('SELECT COUNT(id) total FROM api_log WHERE app_id = :app_id AND DATE(create_time) = CURDATE()');
        $this->db->bind(':app_id',$app_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['total'];
    }
    public function AvgExecuteTime($app_id){
        $this->db->query('SELECT AVG(executed) executed FROM api_log WHERE app_id = :app_id AND DATE(create_time) = CURDATE()');
        $this->db->bind(':app_id',$app_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['executed'];
    }
    public function lastAccess($app_id){}
}
?>
