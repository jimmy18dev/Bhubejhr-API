<?php
class Drug{
    
	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }
    public function drug_opd($hn){
        if(empty($hn)) return null;
        
        $this->db->query('select date(v.visitdate) as visit,d.drugname,vd.drugspcnote,vd.timedesc,vd.frequencydesc,vd.drugamount,du.unitname FROM visit v 
				INNER JOIN visit_drug vd on v.id = vd.id INNER JOIN c_drug d on vd.drugcode = d.drugcode INNER JOIN c_drugunit du ON d.drugunitcode = du.unitcode WHERE v.hn = :hn order by v.visitdate desc' );
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
