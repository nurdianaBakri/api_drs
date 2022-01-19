<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Potongan_rest extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        
    }
 
    //Mengirim atau menambah data kontak baru
    function index_post() 
    { 
        //KONEK KE DATABASE 
        $CI = get_instance(); 
        $CI->config->config['database_host2']=$this->post('HOST');
        $CI->config->config['database_user2']=$this->post('USERNAME');
        $CI->config->config['database_pass2']=$this->post('PASSWORD');  
         
 
        $No_SP2D = $this->post('No_SP2D') ; 
        // $data2['query'] = $this->db->query("SELECT * FROM TrxSP2D_Potongan WHERE NO_SP2D='$NO_SP2D'")->result_array();
        
        $data2 = $this->db->query("SELECT * FROM TrxSP2D_Potongan WHERE No_SP2D='$No_SP2D'");

        $data = array();
        
        $data['last_q_get_potongan'] = $this->db->last_query();
        if($data2->num_rows()>0)
        {
            $data['kosong']=false;
            $data['NO_SP2D']=$No_SP2D;
            $data['query'] = $data2->result_array();

            if ($data['query']) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            } 
        }
        else{
            $data['kosong']=true; 
            $data['NO_SP2D']=$No_SP2D; 
            $this->response($data, 200);
        }  
    }
 
}
?>
