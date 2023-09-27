<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<section>
  <?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

  // $_GET[''] : GET으로 보낸 것을 GET으로 받아옴, 
  // $_POST[''] : POST로 보낸 것을 POST로 받아옴
  // $_REQUEST[''] : 둘 다 받을 수 있음
  
  $sNo = $_REQUEST['sNo'];
  $sName = $_REQUEST['sName'];
  $img = $_FILES['img']['name']; // 파일의 이름
  $tmp = $_FILES['img']['tmp_name']; // 실제 파일
  
  // 동일한 파일이 있는지 여부 확인
  // if(file_exists("./files/$img")) {
  // echo "동일 파일 존재";
  // else {
  // echo "동일 파일이 존재하지 않음";
  // }
  
  if($img == '') {
    $img = 'space.png';
  } else {
    if (file_exists("./files/$img")) {
      echo "동일 파일 존재";
      $f1 = basename($img);
      echo $f1 . "<br>"; // image2.png
      $fname = basename($img, strrchr($img, '.'));
      echo "fname : " . $fname."<br>"; // fname : image2
      // 난수 받아올 경우 time 부분을 변경
      $time = date("His", time());
      echo "time : " . $time."<br>"; // time : 130702 시분초
      $ext = strrchr($img, '.');
      echo "ext : " . $ext."<br>"; // ext : .png
      $img = $fname . "_" . $time . $ext;
      echo "img : " . $img; // img : image2_130702.png
    } 
    move_uploaded_file($tmp, "./files/$img"); // 파일 저장
  }
  
  $sql = "insert into examtbl_psd (sNo, sName, img) 
  values ('$sNo', '$sName', '$img')";
  $conn->query($sql);
  ?>

  <div align="center">
    <br><br><br><br>
    <h1>저장완료!!</h1>
  </div>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>