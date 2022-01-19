<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Transaksi_SPM_update_rest extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        
    } 
   
    //Mengirim atau menambah data kontak baru
    function index_post() 
    {  
        $Status = $this->post('Status_db_antara');
        $Uraian = $this->post('Uraian'); 
        $data = array( 
            'Status' => $this->post('Status_db_antara'),  
            'Uraian' => $this->post('Uraian'),  
        );     
 
        $Tahun =$this->post('Tahun'); 
        $No_SPM =$this->post('No_SPM'); 
        $Nm_Penerima =$this->post('Nm_Penerima'); 
        $Bank_Penerima =$this->post('Bank_Penerima');  
        $DateCreate =$this->post('DateCreate');  
        $Nm_Unit =$this->post('Nm_Unit'); 
        $Nm_Sub_Unit =$this->post('Nm_Sub_Unit');
        $Rek_Penerima =$this->post('Rek_Penerima');   
 		
		$data['query'] = $this->db->query("UPDATE TrxSPM set Status=$Status, Uraian='$Uraian' WHERE Tahun='$Tahun' and No_SPM='".$No_SPM."'"); 

        $data2 = array(
            // 'data_db' => $data_db, 
            // 'data' => $data, 
            // 'where' => $where, 
            'status' => $Status, 
            // 'query' => $this->db->last_query(), 
        );
        $this->response($data2, 200); 
    } 
}
?>
