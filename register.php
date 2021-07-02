<?php 

require 'dbConnection.php';


  # fetch user_category_id .... 

  $sql = "select * from user_category";
  $op  = mysqli_query($con,$sql);
  $count = mysqli_num_rows($op);
  




  # clean code function ... 
  function Clean($input){
    
    $input = trim($input);
    $input = htmlspecialchars($input);   // < &lt; > &gt;
    $input = stripcslashes($input);

    return $input;
   }


   $errorMessages = array();

   if($_SERVER['REQUEST_METHOD'] == "POST"){

    // code ....
 
      $name     = Clean($_POST['name']);
      $email    = Clean($_POST['email']);
      $password = Clean($_POST['password']);
      $phone     = Clean($_POST['phone']);
      $user_category_id    = filter_var($_POST['user_category_id'],FILTER_SANITIZE_NUMBER_INT);
 
     # METHOD 2 ... 
 
    if(empty($name)){
     
     $errorMessages['name'] = "Name Field Required";
        
     }else{
           if(strlen($name) < 3){
             $errorMessages['name']  = "Name must be >= 3";
           }elseif (!preg_match("/^[a-zA-Z\s*']+$/",$name)) {
               # code...
               $errorMessages['name']  = "Only chars allowed";
 
           }    
     }
 
 
 
    // Validate email 
    if(empty($email)){
       $errorMessages['email'] = "Email Field Required";
    }else{
     
     // filter_var($email,FILTER_VALIDATE_EMAIL))) == flase || 0 
     if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){    
         $errorMessages['email']  = "Invalid Email";
     }
 
    }
 
 
 
 
    // Validate Password . 
    if(empty($password)){
        $errorMessages['password'] = "Password Field Required";
    }else{
 
        if(strlen($password) < 6){
         $errorMessages['password'] = "Password Must Be >= 6 "; 
        }
 
    }
    
 
  




  
   



    



 
     // PRINT ERROR MESSAGES 
     if(count($errorMessages) > 0){
 
         foreach($errorMessages as $key => $data){
     
           echo $key.' >>> '.$data.'<br>';
     
         }
       }else{
 
    // db 

      $password = sha1($password);  // md5
if($user_category_id==5)
      { $sql = "insert into users (name,email,password,phone,user_category_id) values ('$name','$email','$password',$phone,$user_category_id)";
      }else{$sql = "insert into admins (name,email,password,phone,user_category_id) values ('$name','$email','$password',$phone,$user_category_id)";
      }

       $op  =  mysqli_query($con,$sql);

if($op){
   
  header("Location: display.php"); 
}else{
  echo 'Error Try Again !!';
}
 
       }
     
   


    }
    





?>





<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
  <h2>Register</h2>

  <form   action="<?php  echo $_SERVER['PHP_SELF']; ?>"   method="post"  enctype ="multipart/form-data">
 
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text"   name="name"  class="form-control" id="exampleInputName"     aria-describedby="" placeholder="Enter Name">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text"  name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
 
 
  <div class="form-group">
    <label for="exampleInputPassword1">phone</label>
    <input type="number" name="phone" class="form-control"  placeholder="phone">
  </div>
  

  <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Category</label>
                                <select class="form-control py-4" name="user_category_id" required>
                                    <?php   while($data = mysqli_fetch_assoc($op)){ ?>
                                    <option value="<?php echo $data['id'];?>"> <?php echo $data['category'];?></option>
                                    <?php } ?>
                                </select>
                            </div>




        <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>

















