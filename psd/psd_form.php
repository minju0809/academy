<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

// sNo +1 씩 자동 부여
$sql = "SELECT max(sNo)+1 as sNo from examtbl_psd";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $sNo = $row["sNo"];

  if ($row["sNo"] == null) {
    $sNo = '1001';
  } else {
    $sNo = $row['sNo'];
  }
}

?>

<section>
  <br>
  <div id='divsection' align=center>
    <h2>자료실 폼 만들기</h2>
    <form action="psd_form_ok.php" method="post" enctype="multipart/form-data">
      <table border="1" width=400px height=200px>
        <tr>
          <td align=center>&nbsp;번호</td>
          <td>&nbsp;<input type="text" name="sNo" value="<?= $sNo ?>"></td>
        </tr>
        <tr>
          <td align=center>&nbsp;이름</td>
          <td>&nbsp;<input type="text" name="sName"></td>
        </tr>
        <tr>
          <td align=center>&nbsp;사진</td>
          <td>&nbsp;<input type="file" name="img" arc="이미지1.png"></td>
        </tr>
        <tr>
          <td colspan="2" align=center>
            <input type="submit" value="저장하기">
          </td>
        </tr>
      </table>
    </form>
  </div>
  <br>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>