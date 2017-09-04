<?php
class Analytics{

	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listPatient(){
    	$this->db->query('SELECT * FROM patient LIMIT 5');
		$this->db->execute();
		$dataset = $this->db->resultset();
		return $dataset;
    }

    public function appoint(){
        $this->db->query('SELECT COUNT(id) count FROM visit_appoint WHERE date(dateappoint) = "2017-06-01"');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function patient_ipd(){
        $this->db->query('SELECT COUNT(an) countan FROM ipd WHERE ISNULL(dischargedate)');
        $this->db->execute();
        $dataset = $this->db->single();
        $dataset['countan'] = floatval($dataset['countan']);
        return $dataset;
    }

    public function clinic($clinic_id){
        $this->db->query('SELECT a.id patient_id,a.visitdate patient_date,p.hn patient_hn,p.fname patient_fname,p.lname patient_lname FROM visit as a INNER JOIN visit_clinic as b ON a.id = b.id INNER JOIN patient as p ON p.hn = a.hn WHERE DATE(a.visitdate) = "2017-06-01" AND b.clinic = :clinic_id LIMIT 10');
        $this->db->bind(':clinic_id',$clinic_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach($dataset as $k => $var){
            $dataset[$k]['patient_id'] = floatval($var['patient_id']);
            $dataset[$k]['patient_hn'] = floatval($var['patient_hn']);
            $dataset[$k]['patient_date'] = $this->db->datetime_thaiformat($var['patient_date']);
        }
        return $dataset;
    }

    public function count_admit(){
        $this->db->query('SELECT count(ipd.admitdate) count_admit FROM ipd WHERE MONTH(ipd.admitdate) = 06');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function count_dsc(){
        $this->db->query('SELECT count(ipd.dischargedate) as count_dsc FROM ipd WHERE MONTH(ipd.dischargedate) = 06');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    
    public function count_refer_out(){
        $this->db->query('SELECT COUNT(an) as  count_refer_out  FROM refer WHERE MONTH(daterefer) = 06');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

}
?>

