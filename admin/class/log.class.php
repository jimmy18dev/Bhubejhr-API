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

    // public function listByAppID($app_id){
    //     $this->db->query('SELECT log.id log_id,log.app_id app_id,log.queries_id,queries.name queries_name,log.create_time log_time,log.executed log_executed FROM api_log AS log LEFT JOIN api_queries AS queries ON log.queries_id = queries.id WHERE log.app_id = :app_id AND DATE(log.create_time) = CURDATE() LIMIT 100');
    //     $this->db->bind(':app_id',$app_id);
    //     $this->db->execute();
    //     $dataset = $this->db->resultset();
    //     return $dataset;
    // }

    // public function listByQID($qid){
    //     $this->db->query('SELECT log.id log_id,log.app_id,log.queries_id,log.create_time log_time,log.executed log_executed,app.name app_name FROM api_log AS log LEFT JOIN api_app AS app ON log.app_id = app.id WHERE log.queries_id = :qid AND DATE(log.create_time) = CURDATE() LIMIT 100');
    //     $this->db->bind(':qid',$qid);
    //     $this->db->execute();
    //     $dataset = $this->db->resultset();
    //     return $dataset;
    // }

    public function last7day($app_id){
        $this->db->query('SELECT CURDATE() - INTERVAL diffs.diff DAY AS day,COUNT(id) AS total FROM ( SELECT 0 as diff UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 ) diffs LEFT JOIN api_log AS log ON (DATE(log.create_time) = CURDATE() - INTERVAL diffs.diff DAY) AND log.app_id = :app_id GROUP BY day');
        $this->db->bind(':app_id',$app_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var){
            $dataset[$k]['day'] = date('D',strtotime($var['day']));
            $dataset[$k]['total'] = floatval($var['total']);
        }
        return $dataset;
    }

    /*

    SELECT   CONCAT(Hour, ':00') AS Hours
  ,      COUNT(create_time) AS `usage`
FROM     api_log
  RIGHT JOIN (
                   SELECT  0 AS Hour
         UNION ALL SELECT  1 UNION ALL SELECT  2 UNION ALL SELECT  3
         UNION ALL SELECT  4 UNION ALL SELECT  5 UNION ALL SELECT  6
         UNION ALL SELECT  7 UNION ALL SELECT  8 UNION ALL SELECT  9
         UNION ALL SELECT 10 UNION ALL SELECT 11 UNION ALL SELECT 12
         UNION ALL SELECT 13 UNION ALL SELECT 14 UNION ALL SELECT 15
         UNION ALL SELECT 16 UNION ALL SELECT 17 UNION ALL SELECT 18
         UNION ALL SELECT 19 UNION ALL SELECT 20 UNION ALL SELECT 21
         UNION ALL SELECT 22 UNION ALL SELECT 23
  )      AS AllHours ON HOUR(create_time) = Hour
WHERE    create_time BETWEEN CURDATE() AND NOW() OR create_time IS NULL
GROUP BY Hour
ORDER BY Hour
    */

    public function today($app_id){
        $this->db->query('SELECT log.id log_id,log.executed log_executed,log.create_time log_time,log.param log_param,log.ref_id,ref.id ref_id,ref.name ref_name,ref.method ref_method,ref.type ref_type,category.name category_name,category.id category_id FROM api_log AS log LEFT JOIN api_reference AS ref ON log.ref_id = ref.id LEFT JOIN api_category AS category ON ref.category_id = category.id WHERE log.app_id = :app_id AND DATE(log.create_time) = CURDATE() ORDER BY log.create_time DESC LIMIT 50');
        $this->db->bind(':app_id',$app_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    public function allday($app_id){
        $this->db->query('SELECT log.id log_id,log.executed log_executed,log.create_time log_time,log.param log_param,log.ref_id,ref.id ref_id,ref.name ref_name,ref.method ref_method,ref.type ref_type,category.name category_name,category.id category_id FROM api_log AS log LEFT JOIN api_reference AS ref ON log.ref_id = ref.id LEFT JOIN api_category AS category ON ref.category_id = category.id WHERE log.app_id = :app_id AND DATE(log.create_time) != CURDATE() ORDER BY log.create_time DESC LIMIT 50');
        $this->db->bind(':app_id',$app_id);
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
