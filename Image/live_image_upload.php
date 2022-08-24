<?php
require '/home/thajunnissa/vendor/autoload.php';
$files = array();
$dir = opendir('.');
while($file = readdir($dir)) 
{
	if(($file != ".") and ($file != "..") and ($file != "test.php") and ($file != "live_image_upload.php")) 
		{
         	 	$files[] = $file; // put in array.
     		}
}
$firstgroup=array();
sort($files); // sort.
$res=array();
groupElements($files, sizeof($files)); 
function groupElements($files, $n) 
{ 
	$tok=Apitocken();	//create token
	echo $tok;
	echo  "\n";
	$newtoken=trim($tok,'"');
    // Initialize all elements as not visited 
       $visited = array($n); 
    for ($i=0; $i<$n; $i++) 
   	 {
         $visited[$i] = 0; 
   	 }
    // Traverse all elements 
   	 $firstgroup="";
    for ($i=0; $i<$n; $i++) 
    	{ 
        // Check if this is first occurrence  
         if ($visited[$i]!== 1) 
               {
            // If yes, print it and all subsequent occurrences 
          	  echo  "\n";
         	  $name1 = substr($files[$i], 0, strrpos($files[$i], '.')); 
         	  $name=substr($name1, 0, -1);
         	  echo  "\n\n";
           //Split first two character for creating folder name
         	  $f=substr($name, 0, 1);
         	  $s=substr($name, 1, 1);
         	  $z=0;
             	          $firstgroup.=$files[$i]; 
          	 for ($j=$i+1; $j<$n; $j++) 
           	     { 
            	    	if(strpos($files[$j],$name)!== false)
             	         {
		           $firstgroup.=":";
             	         $firstgroup.=$files[$j];
		            $visited[$j] = 1;                    
                	} 
                    } 
          		 echo "SKU =".$name."\n\n";
           	   //split names
          	     $filenames= explode(":", $firstgroup);
      	  	     foreach($filenames as $fname)
      	   		 {     
      	   		 $sourcefile=$fname;
      	   		 $exten=substr(strrchr($fname,'.'),1);
      	           if($exten=="JPG")     
      	           {
      	           $imagefile= substr_replace($fname , 'jpg', strrpos($fname, '.') +1);
 	           }
      	           elseif($exten=="PNG")
      	            {
      	            $imagefile= substr_replace($fname , 'png', strrpos($fname , '.') +1);
             	       }
             	       else
             	         {
             	       	$imagefile=$fname;
             	         } 
      	        	     $z=$z+1;
      	        	    //$imagefile=trim($fname);      	        	
            		 $cmd="aws s3 cp ".$sourcefile." s3://fashionrerun/media/catalog/product/".$f."/".$s."/".$imagefile;
            		 // $cmd="aws s3 cp ".$imagefile." s3://fashionrerun/media/catalog/product/s/t/".$imagefile;
            		 $sresu=shell_exec($cmd);
               	  echo $sresu."\n";
              	     //echo $cmd."\n";
                      }                    
                      $RESULT="";
          	       $zz=1;    
            foreach($filenames as $values)
      	         {
      	   		 //$img2=trim($values); 
      	   	 $exten=substr(strrchr($values,'.'),1);
      	           if($exten=="JPG")     
      	           {
      	           $img2= substr_replace($values , 'jpg', strrpos($values, '.') +1);
 	           }
      	           elseif($exten=="PNG")
      	            {
      	            $img2= substr_replace($values , 'png', strrpos($values , '.') +1);
             	       }
             	       else
             	         {
             	       	$img2=$values;
             	         } 
             	          if($z==1)
             	         {
     $xyz="\n	{\n        \"media_type\": \"image\",\n        \"label\": \"".$name."\",\n        \"position\": 0,\n        \"disabled\": false,\n        \"types\": [\n              \"image\",\n            \"small_image\",\n            \"thumbnail\"\n,\n            \"base_image\"\n,\n            \"swatch_image\"\n        ],\n        \"content\": {\n          \"base64_encoded_data\": \"iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAWtJREFUeNpi/P//P8NgBkwMgxyMOnDUgTDAyMhIDNYF4vNA/B+IDwCxHLoakgEoFxODiQRXQUYi4e3k2gfDjMRajsP3zED8F8pmA+JvUDEYeArEMugOpFcanA/Ef6A0CPwC4uNoag5SnAjJjGI2tKhkg4rLAfFGIH4IxEuBWIjSKKYkDfZCHddLiwChVhokK8YGohwEZYy3aBmEKmDEhOCgreomo+VmZHxsMEQxIc2MAx3FO/DI3RxMmQTZkI9ALDCaSUYdOOrAIeRAPzQ+PxCHUM2FFDb5paGNBPRa5C20bUhxc4sSB4JaLnvxVHWHsbVu6OnACjyOg+HqgXKgGRD/JMKBoD6LDb0dyAPE94hwHAw/hGYcujlwEQmOg+EV9HJgLBmOg+FMWjsQVKR8psCBoDSrQqoDSSmoG6Hpj1wA6ju30LI9+BBX4UsC+Ai0T4BWVd1EIL5PgeO+APECmoXgaGtm1IE0AgABBgAJAICuV8dAUAAAAABJRU5ErkJggg==\",\n          \"type\": \"image/png\",\n          \"name\": \"".$img2."\"\n        }\n      }";       
     $RESULT.=$xyz;
     mageupload($RESULT,$newtoken,$name);
		}
		 else if($zz==1)
             	         {
     $xyz="\n	{\n        \"media_type\": \"image\",\n        \"label\": \"".$name."\",\n        \"position\": 0,\n        \"disabled\": false,\n        \"types\": [\n              \"image\",\n            \"small_image\",\n            \"thumbnail\"\n,\n            \"base_image\"\n,\n            \"swatch_image\"\n        ],\n        \"content\": {\n          \"base64_encoded_data\": \"iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAWtJREFUeNpi/P//P8NgBkwMgxyMOnDUgTDAyMhIDNYF4vNA/B+IDwCxHLoakgEoFxODiQRXQUYi4e3k2gfDjMRajsP3zED8F8pmA+JvUDEYeArEMugOpFcanA/Ef6A0CPwC4uNoag5SnAjJjGI2tKhkg4rLAfFGIH4IxEuBWIjSKKYkDfZCHddLiwChVhokK8YGohwEZYy3aBmEKmDEhOCgreomo+VmZHxsMEQxIc2MAx3FO/DI3RxMmQTZkI9ALDCaSUYdOOrAIeRAPzQ+PxCHUM2FFDb5paGNBPRa5C20bUhxc4sSB4JaLnvxVHWHsbVu6OnACjyOg+HqgXKgGRD/JMKBoD6LDb0dyAPE94hwHAw/hGYcujlwEQmOg+EV9HJgLBmOg+FMWjsQVKR8psCBoDSrQqoDSSmoG6Hpj1wA6ju30LI9+BBX4UsC+Ai0T4BWVd1EIL5PgeO+APECmoXgaGtm1IE0AgABBgAJAICuV8dAUAAAAABJRU5ErkJggg==\",\n          \"type\": \"image/png\",\n          \"name\": \"".$img2."\"\n        }\n      },";       
     $RESULT.=$xyz;
		}
		else if($zz<$z)
		           {
      $xyz="\n	{\n        \"media_type\": \"image\",\n        \"label\": \"".$name."\",\n        \"position\": 0,\n        \"disabled\": false,\n        \"types\": [\n              \"additional_image\"\n        ],\n        \"content\": {\n          \"base64_encoded_data\": \"iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAWtJREFUeNpi/P//P8NgBkwMgxyMOnDUgTDAyMhIDNYF4vNA/B+IDwCxHLoakgEoFxODiQRXQUYi4e3k2gfDjMRajsP3zED8F8pmA+JvUDEYeArEMugOpFcanA/Ef6A0CPwC4uNoag5SnAjJjGI2tKhkg4rLAfFGIH4IxEuBWIjSKKYkDfZCHddLiwChVhokK8YGohwEZYy3aBmEKmDEhOCgreomo+VmZHxsMEQxIc2MAx3FO/DI3RxMmQTZkI9ALDCaSUYdOOrAIeRAPzQ+PxCHUM2FFDb5paGNBPRa5C20bUhxc4sSB4JaLnvxVHWHsbVu6OnACjyOg+HqgXKgGRD/JMKBoD6LDb0dyAPE94hwHAw/hGYcujlwEQmOg+EV9HJgLBmOg+FMWjsQVKR8psCBoDSrQqoDSSmoG6Hpj1wA6ju30LI9+BBX4UsC+Ai0T4BWVd1EIL5PgeO+APECmoXgaGtm1IE0AgABBgAJAICuV8dAUAAAAABJRU5ErkJggg==\",\n          \"type\": \"image/png\",\n          \"name\": \"".$img2."\"\n        }\n      },";        
     $RESULT.=$xyz;
         }            
     	 else
          	{
           $xyz1="\n	{\n        \"media_type\": \"image\",\n        \"label\": \"".$name."\",\n        \"position\": 0,\n        \"disabled\": false,\n        \"types\": [\n              \"additional_image\"\n        ],\n        \"content\": {\n          \"base64_encoded_data\": \"iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAWtJREFUeNpi/P//P8NgBkwMgxyMOnDUgTDAyMhIDNYF4vNA/B+IDwCxHLoakgEoFxODiQRXQUYi4e3k2gfDjMRajsP3zED8F8pmA+JvUDEYeArEMugOpFcanA/Ef6A0CPwC4uNoag5SnAjJjGI2tKhkg4rLAfFGIH4IxEuBWIjSKKYkDfZCHddLiwChVhokK8YGohwEZYy3aBmEKmDEhOCgreomo+VmZHxsMEQxIc2MAx3FO/DI3RxMmQTZkI9ALDCaSUYdOOrAIeRAPzQ+PxCHUM2FFDb5paGNBPRa5C20bUhxc4sSB4JaLnvxVHWHsbVu6OnACjyOg+HqgXKgGRD/JMKBoD6LDb0dyAPE94hwHAw/hGYcujlwEQmOg+EV9HJgLBmOg+FMWjsQVKR8psCBoDSrQqoDSSmoG6Hpj1wA6ju30LI9+BBX4UsC+Ai0T4BWVd1EIL5PgeO+APECmoXgaGtm1IE0AgABBgAJAICuV8dAUAAAAABJRU5ErkJggg==\",\n          \"type\": \"image/png\",\n          \"name\": \"".$img2."\"\n        }\n     }";
           $RESULT.=$xyz1;
           mageupload($RESULT,$newtoken,$name);
           }          
           $zz=$zz+1;
           }
           }
            $firstgroup="";     
       }  
} 
   function mageupload($RESULT,$newtoken,$name)
      {     
        
           $curl = curl_init();
  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://uat.fashionrerun.com/rest/V1/products/".$name."",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS =>" {\n     \"product\": {\n \"media_gallery_entries\": [\n".$RESULT."  \n    ]\n }\n }",
       CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$newtoken."",
    "Content-Type: application/json",
    "Cookie: PHPSESSID=tvsstbt4uch3d4ss65dah9adfm"
  ),
));
 $response = curl_exec($curl);
 curl_close($curl);
 echo $response; 
    }
   function Apitocken()
	{
	  $curl = curl_init();
	  curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://uat.fashionrerun.com/rest/V1/integration/admin/token",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "{\n\t\t\n\t\t\"username\" : \"productupload\",\n\t\t\"password\" : \"product@2cloud\"\n\t\t\n\t}",
	  CURLOPT_HTTPHEADER => array(
	    "Content-Type: application/json",
	    "Postman-Token: 4fe92052-a82b-4009-877f-909fc37a48c5",
	    "cache-control: no-cache"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) 
	  {
  	  echo "cURL Error #:" . $err;
	  } else {
  	return $response;
}
}
?>
