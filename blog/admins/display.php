<?php            

include '../operations/functions.php';
include '../operations/checkLogin.php';
include '../operations/checkpermission.php';
include '../operations/connection.php';
include '../header.php';


 $sql = "select * from admins";
 $op  = mysqli_query($con,$sql);


?>

<?php   
       include '../nav.php';
    ?>


   <div id="layoutSidenav">
             
    <?php   
       include '../sideNav.php';
    ?>
     
    <body class="sb-nav-fixed">
      
  
    

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

        <div class="page-header">
            <h1>all admins </h1>   (<?php  echo $_SESSION['name'];  ?>)  || <a href="logout.php">Logout </a>

        </div>

        <!-- PHP code to read records will be here -->





        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>password</th>
                <th>phone</th>
                <th>Action</th>
            </tr>


           <?php 
           
           while($data = mysqli_fetch_assoc($op))
           {
           ?>

           <tr>
           <td><?php echo $data['id'];?></td>
           <td><?php echo $data['name'];?></td>
           <td><?php echo $data['email'];?></td>
           <td><?php echo $data['password'];?></td>
           <td><?php echo $data['phone'];?></td>
           <td><!-- table body will be here -->
                <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>  
            </td>    
           </tr>

        <?php } ?>

            
               



            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
       
  
