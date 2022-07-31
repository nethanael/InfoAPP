 <?php  
 //export.php  
 if(isset($_POST["create_word"]))  
 {  
           header("Content-type: application/vnd.ms-word");  
           header("Content-Disposition: attachment;Filename=".rand().".doc");  
           header("Pragma: no-cache");  
           header("Expires: 0");  
           echo $_POST["tablin"]; 
 }  
 ?>  