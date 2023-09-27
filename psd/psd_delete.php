<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<section>
  <br>
  <div align="center">
    <h2>자료실 목록 보기</h2>

    <?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

    $sNo = $_REQUEST["sNo"];

    $sql = "SELECT img FROM examtbl_psd where sNo = $sNo";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $delFile= $row['img'];

    unlink("./files/$delFile"); // 파일 삭제
    
    $sql = "DELETE FROM examtbl_psd where sNo = $sNo"; // 레코드 삭제
    // 위에서 같은 이름의 변수여도 이미 끝났기 때문에 상관없음
    $conn->query($sql);

    $conn->close();

    header("location:psd_list.php"); // 바로가기(이동)
    
    ?>

  </div>
  <br>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>