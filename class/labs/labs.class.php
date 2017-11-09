<?php
class Labs{
    
	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }
     public function lab_opd($hn){
        if(empty($hn)) return null;
        
        $this->db->query('SELECT  v.visitdate,labr.TestName,labr.Result,labr.ReferLow,labr.ReferHigh
,if(REPLACE(labr.Result,",","") BETWEEN labr.ReferLow and labr.ReferHigh,"Normal",
if(REPLACE(labr.Result,",","") > labr.ReferHigh,"High",
if(REPLACE(labr.Result,",","") < labr.ReferLow,"Low","Normal"))
)as report
FROM lis_request_result labr
INNER JOIN visit v ON v.id = labr.visit_id 
WHERE v.HN = :hn
ORDER BY v.visitdate desc');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        $dataset = $this->db->resultset();

        if(!empty($dataset['hn']) && isset($dataset['hn'])){
            $dataset['hn']      = floatval($dataset['hn']);
            $dataset['cid']     = floatval($dataset['cid']);
        }

        return $dataset;
    }
}
?>
