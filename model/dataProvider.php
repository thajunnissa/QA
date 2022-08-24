<?php  
  class DataProvider {
        var $data = array();
        var $sku = array();
     public function getData(){
           return $this->data;
       }
       public function getSku(){
           return $this->sku;
       }
       
       public function setDataFrom($file){
        
    if (($handle = fopen($file, "r")) !== false) {
        while (($data = fgetcsv($handle, 4096, ",")) !== false) {
            if(in_array('SKU',$data) ||in_array('Measurements',$data)){
             continue;
            }
            $this->data[] = $data;
            $this->sku[]  = $data[1];
        }
    }
    }

       public function validator(){
        
       }

      
         
   }
  
?>