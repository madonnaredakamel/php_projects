<?php 

require 'dbConnection.php';
if(isset($_SESSION['id'])){



 $id =  filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

 $message = '';

  if(filter_var($id,FILTER_VALIDATE_INT)){

    // CODE 
    $sql = "delete from bed_needs where id =".$id;

     $op = mysqli_query($con,$sql);
     
     if($op){
         $message = "item had bought";
     }else{
         $message = "Error in delete user";
     }


  }else{
     // error message 
     $message = "Invalid id ";
  }



    $_SESSION['message'] =  $message;

     header("Location: displaybed.php");
}else{
  header("Location: display.php");
}
?>

