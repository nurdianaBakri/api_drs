<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Transaksi_pencairan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        
    } 
   
    //Mengirim atau menambah data kontak baru
    function index_post() 
    {      
		$Cair = $this->post('Cair');    
		$Uraian = $this->post('Uraian');
		$TglCair2 = $this->post('TglCair');
		$No_SP2D = $this->post('No_SP2D'); 

        $date = new DateTime($TglCair2);
        // $TglCair =  $date->format('m/d/Y H:i:s');  
        $TglCair =  $date->format('Y-m-d H:i:s');    

		$status = $this->db->query("UPDATE TrxSP2D SET Cair=$Cair, TglCair=getdate(),  Uraian='$Uraian' WHERE No_SP2D='$No_SP2D'");

		if ($status==false) 
		{
			$data2 = array( 
				'db' => true,      
				'status' => $status, 
				// 'query' => $this->db->last_query(), 
				'pesan' =>'Proses pencairan gagal',    
			);

			//jika ada potongan  
			$this->response($data2, 200); 
		}
		else
		{
			$data2 = array( 
				'db' => true,      
				'status' => $status,
				// 'query' => $this->db->last_query(),  
				'pesan' =>'Proses pencairan berhasil',    
			);

			//jika ada potongan  
			$this->response($data2, 200);
		} 
    } 
}
?>
