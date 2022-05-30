<?php     
   header("Access-Control-Allow-Origin: *");
   header("Access-Control-Allow-Methods: PUT, GET, POST");
   header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
   
   include 'dbConfig.php';
   
    $folderPath = "uploads/";
    $postdata = file_get_contents("php://input");     
    if(!empty($postdata)){
    $request = json_decode($postdata);
    $image_parts = explode(";base64,", $request->image);      
    $image_type_aux = explode("image/", $image_parts[0]); 
    $image_base64 = base64_decode($image_parts[1]);      
    $file = $folderPath . uniqid() . '.png';      
    if(file_put_contents($file, $image_base64)){
		$insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$file."', NOW())");	
		if($insert){
			$response = array('status'=>true,'msg'=>'Successfully uploaded');
		}else{
			$response = array('status'=>false,'msg'=>'Failed to upload image');
		} 		
    
    }      
     echo json_encode($response);
   }
?>