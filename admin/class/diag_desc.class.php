<?php
class Diag_desc{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listDiag_desc($uid){
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
            AND date(DATE_SUB(now(),INTERVAL day(now()) DAY)) LIMIT 10000 ');
        $this->db->bind(':uid',$uid);
        $this->db->execute();
        return $dataset = $this->db->resultset();
    }
}
?>

