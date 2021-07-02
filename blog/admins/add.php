<?php             
   
   include '../operations/functions.php';
   include '../operations/checkLogin.php';
   include '../operations/checkpermission.php';
   include '../operations/connection.php';
   include '../header.php';
            
 
    # select role .. 
    $sql = "select * from user_category";
    $op  = mysqli_query($con,$sql);


   # Logic ...
   
   $errorMessages  = array();
   $message = ""; 
   if($_SERVER['REQUEST_METHOD'] == "POST"){
 


    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    
    $phone    = Clean($_POST['phone']);
    // $user_category_id=clean($post['user_category_id']);

    //$gender   = $_POST['gender'];





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





 //validate phone




    if(empty($phone)){
        $errorMessages['phone'] = "phone Field Required";
           
        }else{
              if(strlen($phone) < 10){
                $errorMessages['phone']  = "phone must be >= 10";
              }
              elseif (!preg_match("/^\d{11}$/",$phone)) { 
                  # code...
                  $errorMessages['phone']  = "Only Numbers allowed";
     
              }    
        }
    


   
       
        



     if(count($errorMessages) == 0){

      $password = sha1($password);
      $sql = "insert into admins ( `name`, `phone`, `password`, `email`,'user_category_id') values ('$name','$phone','$password','$email','6')";

      $op = mysqli_query($con,$sql);

      if($op){
          $message = "Inserted";
      }else{
          $message = "Try Again";
      }
 
        $_SESSION['message'] = $message;
      // header("Location: display.php");
     }else{
        $_SESSION['error_messsage'] = $errorMessages;
        // header("Location: add.php");


     }





   }


  
?>

<body class="sb-nav-fixed">


    <?php   
       include '../nav.php';
    ?>


    <div id="layoutSidenav">

        <?php   
       include '../sideNav.php';
    ?>



        <div id="layoutSidenav_content">
            <main>


                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard  :  (Add Admin)</li>
                    </ol>



                    <?php
            
     if(isset($_SESSION['error_messsage']) ){

        foreach($_SESSION['error_messsage'] as $key => $value){
            echo '* '.$key.' : '.$value.'<br>';
        }
     }
  echo $message;

   ?>




                    <!-- form  -->


                    <div class="card-body">
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            
                        <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Name</label>
                                <input class="form-control py-4" name="name" id="inputEmailAddress" type="text"
                                    placeholder="Enter name " required />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email"
                                    placeholder="Enter email" required />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Password</label>
                                <input class="form-control py-4" name="password" id="inputEmailAddress" type="password"
                                    placeholder="Enter Password" required />
                            </div>


                          



                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Phone</label>
                                <input class="form-control py-4" name="phone" id="inputEmailAddress" type="text"
                                    placeholder="Enter Phone " required />
                            </div>




                            <!-- <label class="small mb-1" for="inputEmailAddress">Gender</label>

                            <div class="form-group">
                                <input name="gender"   type="radio"   value="male" />
                                 <label >male</label>
                                 <input  name="gender"  type="radio"  value= "female" />
                                 <label >Female</label>

                            </div> -->







                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>


                </div>
        </div>



        </main>





        <?php 
            
            include '../footer.php';
            
            ?>