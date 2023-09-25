<?php include $_SERVER["DOCUMENT_ROOT"]."/include/top.php" ?>

<section>
  <?php include $_SERVER["DOCUMENT_ROOT"]."/include/dbconn.php"; 

  $id = $_GET['id'];
  $password = $_GET['password'];
  $name = $_GET['name'];
  $reg_date = $_GET['reg_date'];

  $sql = "insert into member (id, password, name, reg_date) 
  values ('$id', '$password', '$name', '$reg_date')";
  $conn->query($sql);
  ?>

  <div align="center">
    <br><br><br><br>
    <h1>저장완료!!</h1>
  </div>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"]."/include/bottom.php" ?>