<?php
class Appoint{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($hn){
        $this->db->query('SELECT p.hn
,date(va.dateappoint) as appointdate
,time(va.dateappoint) as timeappoint
,apt.appointtypedesc
,va.appointcause as comment
,GROUP_CONCAT(o.operatdesc) as Lab
,date(applab.datelabappoint) as labdate
,time(applab.datelabappoint) as labtime
,if(va.xrayappoint <> 2,"XRAY","NOT XRAY") AS xray
,if(va.remedication <> 2,"มารับยาเดิม","") as medication
FROM visit_appoint va
INNER JOIN patient p ON va.hn = p.hn
INNER JOIN c_appointtype apt ON apt.appointtypecode = va.appointtypecode
LEFT JOIN visit_appoint_lab applab ON applab.visitlabappointid = va.id
LEFT JOIN c_operation o ON applab.operatcode = o.operatcode
WHERE va.hn = :hn
GROUP BY va.id limit 100');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
}
?>
