<?php
class Patient{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function get($cid){
        if(empty($cid)) return null;

        $this->db->query('SELECT p.hn as  hn,p.fname as fname,p.lname as lname,p.dob as dob,if(p.gender = 1,"ชาย","หญิง") as gender,p.cid as cid,cn.nationname as nationality,CONCAT(pa.address," ม.",pa.moo," ",pa.subdistrictname," ",pa.districtname," ",pa.provincename) as address,p.tel as tel,cb.bloodgroupname as blood,pd.drug as drugallergy FROM patient p left JOIN view_PatAddressType1 pa ON p.hn = pa.hn  left join c_bloodgroup cb on cb.bloodgroupcode = p.blood left join c_nation cn on p.nationality = cn.nationcode LEFT JOIN pt_drugallergy pd ON p.hn = pd.hn WHERE p.cid = :cid or p.hn = :cid');
        $this->db->bind(':cid',$cid);
        $this->db->execute();
        $dataset = $this->db->single();

        // Get Height Weight
        $HeightWeight = $this->getHeightWeight($dataset['hn']);

        if(!empty($dataset['hn']) && isset($dataset['hn'])){
            $dataset['hn']      = floatval($dataset['hn']);
            $dataset['cid']     = floatval($dataset['cid']);
            $dataset['height']  = (!empty($HeightWeight['height'])?floatval($HeightWeight['height']):NULL);
            $dataset['weight']  = (!empty($HeightWeight['weight'])?floatval($HeightWeight['weight']):NULL);
            $dataset['tel']     = (strlen($dataset['tel'])!=9||strlen($dataset['tel'])!=10?NULL:$dataset['tel']);
        }

        return $dataset;
    }

    public function getHeightWeight($hn){
        $this->db->query('SELECT vs.height,vs.weight FROM visit v INNER JOIN visit_vitalsign vs on v.id = vs.id WHERE v.hn = :hn ORDER BY v.visitdate DESC LIMIT 1');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        $dataset = $this->db->single();

        return $dataset;
    }

    public function listVisit($hn){
        
        if(empty($hn)) return false;

        $this->db->query('SELECT v.id,v.hn,CONCAT(YEAR(visitdate)-1957,lpad(MONTH(visitdate),2,"0"),lpad(visitno,5,"0")) AS vn
,v.visitdate,UNIX_TIMESTAMP(v.visitdate) visitdate_timestamp,dis.dischargetypename,symtom,vi.insmain main_hosname_id,h.hosname main_hosname_name,cr.rightname AS rightname,pd.drug AS drug_allergy FROM visit AS v INNER JOIN visit_ins vi ON v.id = vi.id INNER JOIN c_righthos cr ON vi.inshos = cr.rightcode LEFT JOIN c_hospital h ON h.hoscode = vi.insmain LEFT JOIN c_dischargetype dis ON v.dischargetype = dis.dischargetypecode LEFT JOIN pt_drugallergy pd ON v.hn = pd.hn WHERE v.hn = :hn ORDER BY visitdate DESC LIMIT 100');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['id'] = floatval($var['id']);
            $dataset[$k]['hn'] = floatval($var['hn']);
            $dataset[$k]['vn'] = floatval($var['vn']);
            $dataset[$k]['visitdate_timestamp'] = floatval($var['visitdate_timestamp']);
            $dataset[$k]['main_hosname_id'] = floatval($var['main_hosname_id']);
        }

        return $dataset;
    }

    public function listVitalSign($hn){
        
        if(empty($hn)) return false;

        $this->db->query('SELECT DATE(visitdate) visitdate,vs.weight,vs.height,vs.bmi,vs.bp,vs.pulse,vs.temperature,vs.respiration,vs.waist FROM visit v INNER JOIN visit_vitalsign vs ON v.id = vs.id WHERE v.hn = :hn ORDER BY visitdate DESC');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['weight'] = floatval($var['weight']);
            $dataset[$k]['height'] = floatval($var['height']);
            $dataset[$k]['bmi'] = floatval($var['bmi']);
            $dataset[$k]['pulse'] = floatval($var['pulse']);
            $dataset[$k]['waist'] = floatval($var['waist']);
        }

        return $dataset;
    }

    public function listLab($hn){
        
        if(empty($hn)) return false;

        $this->db->query('SELECT RequestDateTime datetime,TestName test,Result result FROM lis_request_result lab WHERE hn = :hn AND lab.TestName in ("TPHA (serum)","HBs-Ag","HIV Ab (CMIA)","Hct","MCV")');
        $this->db->bind(':hn',$hn);
        $this->db->execute();
        $dataset = $this->db->resultset();

        return $dataset;
    }
}
?>
