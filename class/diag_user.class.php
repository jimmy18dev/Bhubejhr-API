<?php
class Diag_user{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listDiag_user(){
        
        $this->db->query('SELECT "IPD" as work,su.uid,su.fname,su.lname,COUNT(di.an) as num
            FROM visit v
            INNER JOIN ipd i ON v.id = i.visitid
            INNER JOIN ipd_diag di ON di.an = i.an
            INNER JOIN sys_user su ON su.uid = di.userupdate
            INNER JOIN sys_access_user_group sg ON su.uid = sg.uid AND sg.gid = 2 
            WHERE date(i.dischargedate) 
            BETWEEN date(DATE_SUB((DATE_SUB(now(),INTERVAL 1 MONTH)),INTERVAL day(NOW())-1 DAY)) 
            AND date(DATE_SUB(now(),INTERVAL day(now()) DAY))
            GROUP BY su.uid
            UNION 
            SELECT "OPD" as work,su.uid,su.fname,su.lname,COUNT(vd.id) as num
            FROM visit v
            INNER JOIN visit_diag vd ON v.id = vd.id
            INNER JOIN sys_user su ON su.uid = vd.userupdate
            INNER JOIN sys_access_user_group sg ON su.uid = sg.uid AND sg.gid = 2 
            WHERE date(v.visitdate) 
            BETWEEN date(DATE_SUB((DATE_SUB(now(),INTERVAL 1 MONTH)),INTERVAL day(NOW())-1 DAY)) 
            AND date(DATE_SUB(now(),INTERVAL day(now()) DAY))
            GROUP BY su.uid
            LIMIT 100');
        $this->db->execute();
        return $dataset = $this->db->resultset();
    }
}
?>

