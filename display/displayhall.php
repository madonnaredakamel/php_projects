<?php 
   require '../dbConnection.php';
   
  


   $sql = "select * from holes";
    $op =  mysqli_query($con,$sql);



?>

<!DOCTYPE HTML <html>

<head>
    <title>holes</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <?php 
    
      if(isset($_SESSION['message'])){
           echo $_SESSION['message'];
           unset($_SESSION['message']);
      }

    if(isset($_SESSION['errorMessage'])){
        unset($_SESSION['errorMessage']);

    }



    ?>
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>

                                                <th>#id</th>
                                                <th>name</th>
                                                <th>place</th>
                                                <th>image</th>
                                                <th>action</th>
                            
                                            </tr>
                                        </thead>
                            
                                        <tbody>
                                        
                                        <?php 
                                           while($data = mysqli_fetch_assoc($op)){
                                        ?>

                                             <tr>
                                                <td><?php echo $data['id'];?></td>
                                                <td><?php echo $data['hole_name'];?></td>
                                                <td><?php echo $data['place'];?></td>
                                                
                                                
                                                
                                                <td> <img src="../halls/<?php echo $data['hole_image'];?>" width="150px" height="150px" >  </td>
                                                <td><!-- table body will be here -->
                                                     <a href='booking.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>booking</a>
                 
                                                 </td>
           
                                               
                                            </tr>
                                      <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



    </div>
</body>