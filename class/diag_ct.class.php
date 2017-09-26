<?php
class Diagct{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listDiagCT($month,$year){
        
        if(empty($year)) return false;

        $this->db->query('SELECT "OPD",date(visitdate) as vdate,"C00-C09" as codediag,cr.rightname as rightname,COUNT(aa.id) as countid,
            SUM((IFNULL((SELECT sum(drugpriceacc)FROM visit_drug  where aa.id = visit_drug.id group by visit_drug.id),0)+
                 IFNULL((SELECT sum(drugpricenoacc)FROM visit_drug where aa.id = visit_drug.id group by visit_drug.id),0)+
                 IFNULL((SELECT sum(operatpriceacc)FROM visit_operation where aa.id = visit_operation.id group by visit_operation.id),0)+
                 IFNULL((SELECT sum(operatpricenoacc)FROM visit_operation where aa.id = visit_operation.id group by visit_operation.id),0)+
                 IFNULL((SELECT sum(priceacc)FROM visit_servexpense where aa.id = visit_servexpense.id group by visit_servexpense.id),0)+
                 IFNULL((SELECT sum(pricenoacc)FROM visit_servexpense where aa.id = visit_servexpense.id group by visit_servexpense.id),0))
                 ) as summonny
            FROM visit as aa
            LEFT JOIN visit_diag as bb on aa.id = bb.id
            LEFT JOIN visit_ins as ii on ii.id = aa.id
            INNER JOIN c_righthos as cr on cr.rightcode = ii.inshos
            LEFT JOIN patient d on d.hn = aa.hn 
            LEFT JOIN view_PatAddressType1 As e on e.hn = d.HN
            LEFT JOIN c_prename As f on f.prenamecode = d.prename
            WHERE MONTH(aa.visitdate) = :month
            AND YEAR(aa.visitdate) = :year
            AND bb.diseasecode BETWEEN "C00" AND "C09"
            GROUP BY ii.inshos
           /*     UNION
                        SELECT "OPD",date(visitdate) as vdate,"I05-I09 , I20-I52" as codediag,cr.rightname as rightname,COUNT(aa.id) as countid,
            SUM((IFNULL((SELECT sum(drugpriceacc)FROM visit_drug  where aa.id = visit_drug.id group by visit_drug.id),0)+
                 IFNULL((SELECT sum(drugpricenoacc)FROM visit_drug where aa.id = visit_drug.id group by visit_drug.id),0)+
                 IFNULL((SELECT sum(operatpriceacc)FROM visit_operation where aa.id = visit_operation.id group by visit_operation.id),0)+
                 IFNULL((SELECT sum(operatpricenoacc)FROM visit_operation where aa.id = visit_operation.id group by visit_operation.id),0)+
                 IFNULL((SELECT sum(priceacc)FROM visit_servexpense where aa.id = visit_servexpense.id group by visit_servexpense.id),0)+
                 IFNULL((SELECT sum(pricenoacc)FROM visit_servexpense where aa.id = visit_servexpense.id group by visit_servexpense.id),0))
                 ) as summonny
            FROM visit as aa
            LEFT JOIN visit_diag as bb on aa.id = bb.id
            LEFT JOIN visit_ins as ii on ii.id = aa.id
            INNER JOIN c_righthos as cr on cr.rightcode = ii.inshos
            LEFT JOIN patient d on d.hn = aa.hn 
            LEFT JOIN view_PatAddressType1 As e on e.hn = d.HN
            LEFT JOIN c_prename As f on f.prenamecode = d.prename
            WHERE MONTH(aa.visitdate) = :month
            AND YEAR(aa.visitdate) = :year
            AND ((bb.diseasecode BETWEEN "I05" AND "I09") OR (bb.diseasecode BETWEEN "I20" AND "I52"))
            GROUP BY ii.inshos
                UNION

                    SELECT "IPD",date(dischargedate) as vdate, "C00-C09" as codediag,cr.rightname as rightname,COUNT(aa.an) as countan,
            SUM((IFNULL((SELECT sum(drugpriceacc)FROM ipd_drug  where aa.an = ipd_drug.an group by ipd_drug.an),0)+
                 IFNULL((SELECT sum(drugpricenoacc)FROM ipd_drug where aa.an = ipd_drug.an group by ipd_drug.an),0)+
                 IFNULL((SELECT sum(operatpriceacc)FROM ipd_operation where aa.an = ipd_operation.an group by ipd_operation.an),0)+
                 IFNULL((SELECT sum(operatpricenoacc)FROM ipd_operation where aa.an = ipd_operation.an group by ipd_operation.an),0)+
                 IFNULL((SELECT sum(priceacc)FROM ipd_servexpense where aa.an = ipd_servexpense.an group by ipd_servexpense.an),0)+
                 IFNULL((SELECT sum(pricenoacc)FROM ipd_servexpense where aa.an = ipd_servexpense.an group by ipd_servexpense.an),0))
                 ) as summonny
            FROM ipd as aa
            LEFT JOIN ipd_diag as bb on aa.an = bb.an
            LEFT JOIN visit as c on c.id = aa.visitid
            LEFT JOIN ipd_ins as ii on ii.an = aa.an
            INNER JOIN c_righthos as cr on cr.rightcode = ii.inshos
            LEFT JOIN patient d on d.hn = c.hn 
            LEFT JOIN view_PatAddressType1 As e on e.hn = d.HN
            LEFT JOIN c_prename As f on f.prenamecode = d.prename
            WHERE MONTH(aa.dischargedate) = :month
            AND  YEAR(aa.dischargedate) = :year
            AND bb.diseasecode BETWEEN "C00" AND "C09"
            GROUP BY ii.inshos
                UNION
                SELECT "IPD",date(dischargedate) as vdate,"I05-I09 , I20-I52" as codediag,cr.rightname as rightname,COUNT(aa.an) as countan,
            SUM((IFNULL((SELECT sum(drugpriceacc)FROM ipd_drug  where aa.an = ipd_drug.an group by ipd_drug.an),0)+
                 IFNULL((SELECT sum(drugpricenoacc)FROM ipd_drug where aa.an = ipd_drug.an group by ipd_drug.an),0)+
                 IFNULL((SELECT sum(operatpriceacc)FROM ipd_operation where aa.an = ipd_operation.an group by ipd_operation.an),0)+
                 IFNULL((SELECT sum(operatpricenoacc)FROM ipd_operation where aa.an = ipd_operation.an group by ipd_operation.an),0)+
                 IFNULL((SELECT sum(priceacc)FROM ipd_servexpense where aa.an = ipd_servexpense.an group by ipd_servexpense.an),0)+
                 IFNULL((SELECT sum(pricenoacc)FROM ipd_servexpense where aa.an = ipd_servexpense.an group by ipd_servexpense.an),0))
                 ) as summonny
            FROM ipd as aa
            LEFT JOIN ipd_diag as bb on aa.an = bb.an
            LEFT JOIN visit as c on c.id = aa.visitid
            LEFT JOIN ipd_ins as ii on ii.an = aa.an
            INNER JOIN c_righthos as cr on cr.rightcode = ii.inshos
            LEFT JOIN patient d on d.hn = c.hn 
            LEFT JOIN view_PatAddressType1 As e on e.hn = d.HN
            LEFT JOIN c_prename As f on f.prenamecode = d.prename
            WHERE MONTH(aa.dischargedate) = :month
            AND YEAR(aa.dischargedate) = :year
            AND ((bb.diseasecode BETWEEN "I05" AND "I09") OR (bb.diseasecode BETWEEN "I20" AND "I52"))
            GROUP BY ii.inshos
            */');
        $this->db->bind(':month',$month);
        $this->db->bind(':year',$year);
        $this->db->execute();
        return $dataset = $this->db->resultset(); 
    }
}
?>

