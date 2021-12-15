<?php

  // connect to database
  $insert =false;
  $delete =false;
  $update =false;
$servername = "localhost";
$username = "root";
$password ="";
$database ="notes";

$conn = mysqli_connect($servername,$username,$password,$database);
// create connection
if(!$conn){
    die("Sorry WE Failed to connect".mysqli_connect_error());
    echo "<br>";
}
    // else
    // {
    // // echo "Welcome";
    // // echo "<br>";
    // }
  
    // echo $_GET['update'];
// exit();
if(isset($_GET['delete'])){
 $slno =$_GET['delete'];
 $sql="DELETE FROM `notes` WHERE `sno` = $slno";
 $result = mysqli_query($conn,$sql); 
$delete =true;
//  echo $slno;
}
    if($_SERVER["REQUEST_METHOD"]=="POST"){    
      if(isset($_POST['snoEdit'])){
        // update the record
        
        $slno =$_POST['snoEdit'];
        $title =$_POST['titleEdit'];
        $description =$_POST['descriptionEdit'];
  $sql = "UPDATE `notes` SET `title` = '$title' , `description`='$description' WHERE `notes`.`sno` = $slno";
  $result = mysqli_query($conn,$sql); 
  if($result){
    $update =true;

}else{
    echo "Not Updated";
}
  
      }else{
      $title =$_POST['title'];
      $description =$_POST['description'];
$sql = "INSERT INTO `notes`(`title`,`description`) VALUE ('$title','$description')";

$result = mysqli_query($conn,$sql); 

if($result){
  // echo "successful<br>";
  $insert= true;
}else{

  echo " unsuccessful<br>";
}
}
}
 ?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

  <title>||Notes APP||</title>

</head>

<body>
  <!-- edit modal -->
  <!-- Button trigger modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
Edit Modal
</button> -->

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit The Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/CRUD APP/index.php" method="post">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="exampleInputEmail1">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Notes Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">||PROJECT 1||</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="/CRUD APP/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>

      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
  <?php

if($insert){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Note Inserted Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}


?>
  <?php

if($delete){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Note Deleted Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if($update){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Note Updated Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}


?>
  <div class="container my-5">
    <h2 style="text-align: center;"> Add a Note</h2>
    <form action="/CRUD APP/index.php" method="post">
      <div class="form-group">
        <label for="exampleInputEmail1">Note Title</label>
        <input type="text" class="form-control" id="title" name="title">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Notes Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>


      <button type="submit" class="btn btn-primary">Add Notes</button>
    </form>
  </div>

  <div class="container my-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
 $sql="SELECT * FROM `notes`";
 $result = mysqli_query($conn,$sql);
$sno=0;
     while($row=mysqli_fetch_assoc($result))
     {
       $sno=$sno+1;
       echo '<tr><th scope="row">' .$sno .'</th>
       <td>'.$row['title'].'</td>
       <td>'.$row['description'].'</td>
      <td> 
      <button  class="edit btn btn-primary" id='.$row['sno'].'>Edit</button>  <button  class="delete btn btn-primary" id=d'.$row['sno'].'>Delete</button> </td>
     </tr>';
  
 }


 
 ?>

      </tbody>
    </table>
    <hr>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log('edit',);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        $('#editModal').modal('toggle');
        snoEdit.value = e.target.id;
        console.log(e.target.id);
      })
    })
  </script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener('click', (e) => {
        console.log('edit',);
        sno = e.target.id.substr(1,);
        if (confirm("Are You sure To delete this Note!")) {
          console.log("Yes");
          window.location = `/CRUD APP/index.php?delete=${sno}`;
        } else {
          console.log("No");

        }
      })
    })
  </script>
</body>

</html>