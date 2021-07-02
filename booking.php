<?php 
  require 'dbConnection.php';
   

  $sql = "select clothes.id from clothes inner join booking in clothes.id=booking.item_id  " ;

  $op = mysqli_query($con,$sql);

 

    $data = mysqli_fetch_assoc($op);
    
    $_SESSION['item_id']   =  $data['item_id'] ;
  
  
  $sql = "select users.id from users inner join booking in users.id=booking.user_id " ;

  $op = mysqli_query($con,$sql);

 

    $data = mysqli_fetch_assoc($op);
    
    $_SESSION['user_id']   =  $data['user_id'] ;
  



  function Clean($input){
    
    $input = trim($input);
    $input = htmlspecialchars($input);   // < &lt; > &gt;
    $input = stripcslashes($input);

    return $input;
   }


   $errorMessages = array();

   if($_SERVER['REQUEST_METHOD'] == "POST"){

    // code ....
 
      $date    = Clean($_POST['date']);


      if(count($errorMessages) > 0){
 
        foreach($errorMessages as $key => $data){
    
          echo $key.' >>> '.$data.'<br>';
    
        }
      }else{

   // db 

 $sql = "insert into booking (user_id,item_id,date) values ('$user_id','$item_id','$date)";
     
      $op  =  mysqli_query($con,$sql);

if($op){
  
 echo 'booking is done'; 
}else{
 echo 'Error Try Again !!';
}

      }
    
  


   }
   

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>booking</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
  <h2>booking</h2>

  <form   action="<?php  echo $_SERVER['PHP_SELF']; ?>"   method="post"  enctype ="multipart/form-data">
 
  <div class="form-group">
    <label for="exampleInputEmail1">date</label>
    <input type="date"   name="date"  class="form-control" id="exampleInputName"     aria-describedby="" placeholder="Enter date">
  </div>

  
  

 



        <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>
