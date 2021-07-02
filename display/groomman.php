<?php 
   require '../dbConnection.php';
   
  


   $sql = "select item_img from clothes where item_category='5'";
       $op =  mysqli_query($con,$sql);



?>

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

    <div class="page-header">
        <h1>suites for groomman </h1>   (<?php  echo $_SESSION['name'];  ?>)  || <a href="logout.php">Logout </a>

    </div>

    <!-- PHP code to read records will be here -->





    <table class='table table-hover table-responsive table-bordered'>
        <!-- creating our table heading -->
        <tr>
            
            <th>image</th>
           
            <th>Action</th>
        </tr>


       <?php 
       
       while($data = mysqli_fetch_assoc($op))
       {
       ?>

       <tr>
       
      <td> <img width="400" height="500"src="../groomman/<?php echo $data['item_img'];?>"></td>
      
       <td><!-- table body will be here -->
            <a href='booking.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>booking</a>
             
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