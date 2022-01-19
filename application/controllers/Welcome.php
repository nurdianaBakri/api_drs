<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Welcome extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        
    } 


  public function index_post($bin_nr, $decimal_i) {
     
     $hasil1 = $this->convertBindec($bin_nr);
     $hasil2 = $this->convertDecBin($decimal_i); 

     $data2 = array( 
        'hasil1' => $hasil1,      
        'hasil2' => $hasil2,     
      ); 
      //jika ada potongan  
      $this->response($data2, 200); 
 
  } 
   

  public function convertBindec($bin_nr) {
     $base=1;
     $dec_nr=0;
     $bin_nr=explode(",", preg_replace("/(.*),/", "$1", str_replace("1", "1,", str_replace("0", "0,", $bin_nr))));
     for($i=1; $i<count($bin_nr); $i++) $base=$base*2;
     foreach($bin_nr as $key=>$bin_nr_bit) {
         if($bin_nr_bit==1) {
             $dec_nr+=$base;
             $base=$base/2;
         }
         if($bin_nr_bit==0) $base=$base/2;
     } 
     // $k = (array("string"=>chr($dec_nr), "int"=>$dec_nr)); 
     return $dec_nr;
  }

   public function convertDecBin($decimal_i) {
      bcscale(0);

     $binary_i = '';
     do
      {
       $binary_i = bcmod($decimal_i,'2') . $binary_i;
       $decimal_i = bcdiv($decimal_i,'2');
      } while (bccomp($decimal_i,'0'));

     return($binary_i);
  } 
 
}
