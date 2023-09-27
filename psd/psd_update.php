<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<section>
  <br>
  <? include $_SERVER["DOCUMENT_ROOT"]."/include/dbconn.php" ?>
  <?
  $sNo = $_REQUEST['sNo'];
  $sName = $_REQUEST['sName'];
  $img = $_FILES['img']['name']; // 파일의 이름
  $tmp = $_FILES['img']['tmp_name']; // 실제 파일
  
  $sql = "SELECT * from examtbl_psd where sNo = $sNo";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $delFile = $row['img']; // 삭제할 파일
  
  if ($img == '') {
    // 첨부파일이 없는 경우
    $update_sql = "UPDATE examtbl_psd set sName = '$sName' where sNo ='$sNo'";
  } else {
    // 첨부파일이 있는 경우
    if ($delFile != 'space.png') {
      unlink("./files/$delFile");
    }

    if (file_exists("./files/$img")) {
      $fname = basename($img, strrchr($img, '.'));
      $time = date("His", time());
      $ext = strrchr($img, '.');
      $img = $fname . "_" . $time . $ext;
    }
    move_uploaded_file($tmp, "./files/$img"); // 파일 저장
    $update_sql = "UPDATE examtbl_psd set sName = '$sName', img = '$img' where sNo ='$sNo'";
  }

  echo $update_sql;
  $conn->query($update_sql);
  // $conn->close();
  header("location:psd_list.php");
  ?>

  <div align="center">
    <br><br><br><br>
    <h1>수정완료!!</h1>
  </div>
</section>
<?

include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>