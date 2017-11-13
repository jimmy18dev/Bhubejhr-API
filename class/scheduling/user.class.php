<?php
class User{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function firstOPDCard($date){
        if(empty($date)){
            // To Day
            $this->db->query('SELECT s.fname,s.lname,vc.registertime,count(vc.clinic) as num from visit v INNER JOIN visit_clinic vc ON v.id = vc.id INNER JOIN sys_user s ON s.uid = vc.registeruser INNER JOIN sys_access_user_group sg ON s.uid = sg.uid AND sg.gid = 2 WHERE date(visitdate) = DATE(NOW()) and vc.registertime is not null GROUP BY s.uid limit 100');
        }else{
            $this->db->query('SELECT s.fname,s.lname,vc.registertime,count(vc.clinic) as num from visit v INNER JOIN visit_clinic vc ON v.id = vc.id INNER JOIN sys_user s ON s.uid = vc.registeruser INNER JOIN sys_access_user_group sg ON s.uid = sg.uid AND sg.gid = 2 WHERE date(visitdate) = :date and vc.registertime is not null GROUP BY s.uid limit 100');
            $this->db->bind(':date',$date);
        }
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    public function Diag_user(){
        
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
    public function Diag_desc($uid){
        $this->db->query('
            SELECT i.an as seq,di.diseasecode,di.diagtype,cd.diseasethai,di.dateupdate,if(cd.diseasecode is not NULL,"T","F") as flag
            FROM ipd i 
            INNER JOIN ipd_diag di ON i.an = di.an
            LEFT JOIN c_disease cd ON di.diseasecode = cd.diseasecode
            WHERE di.userupdate = :uid
            and date(i.dischargedate) 
            BETWEEN date(DATE_SUB((DATE_SUB(now(),INTERVAL 1 MONTH)),INTERVAL day(NOW())-1 DAY)) 
            AND date(DATE_SUB(now(),INTERVAL day(now()) DAY))

            UNION

            SELECT CONCAT(RIGHT(YEAR(v.visitdate)+543,2),LPAD(MONTH(v.visitdate),2,"0"),LPAD(v.visitno,5,"0")) as seq,
            vd.diseasecode,vd.diagtype,cd.diseasethai,vd.dateupdate,if(cd.diseasecode is not NULL,"T","F") as flag
            FROM visit v
            INNER JOIN visit_diag vd ON vd.id = v.id
            LEFT JOIN c_disease cd ON vd.diseasecode = cd.diseasecode
            WHERE vd.userupdate = :uid
            and date(v.visitdate) 
            BETWEEN date(DATE_SUB((DATE_SUB(now(),INTERVAL 1 MONTH)),INTERVAL day(NOW())-1 DAY)) 
            AND date(DATE_SUB(now(),INTERVAL day(now()) DAY))
            order by flag,seq limit 10000');
        $this->db->bind(':uid',$uid);
        $this->db->execute();
        return $dataset = $this->db->resultset();
    }
}
?>
