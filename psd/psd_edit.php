<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>
<!-- img 보여주기
sNo readonly
sName
img 수정하면 update / 바꾸지 않으면 컬럼이 없게
삭제 수정-> 이미지 수정, 이름 수정 input, 목록보기, 저장하기 -->

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

$sNo = $_REQUEST['sNo'];

$sql = "SELECT * from examtbl_psd where sNo = $sNo";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<section>
  <br>
  <div id='divsection' align=center>
    <h2>자료실 상세보기</h2>
    <form action="psd_update.php" method="post" enctype="multipart/form-data">
      <table border="1" width=400px height=200px>
        <tr>
          <td align=center colspan=2 ><img src=./files/<?= $row['img'] ?> alt="이미지" whidth=300 height=200></td>
        </tr>
        <tr>
          <td align=center>&nbsp;번호</td>
          <td>&nbsp;<input type="text" name="sNo" value="<?= $row['sNo'] ?>" readonly></td>
        </tr>
        <tr>
          <td align=center>&nbsp;이름</td>
          <td>&nbsp;<input type="text" name="sName" value="<?= $row['sName'] ?>"></td>
        </tr>
        <tr>
          <td align=center>&nbsp;사진</td>
          <td>&nbsp;<input type="file" name="img" arc="이미지1.png"></td>
        </tr>
        <tr>
          <td colspan="2" align=center>
            <input type="submit" value="수정하기">
          </td>
        </tr>
      </table>
    </form>
    <hr width=80%>

    <a href=psd_delete.php?sNo=<?=$row['sNo']?>>삭제하기</a> &emsp;
    <a href="psd_list.php">목록보기</a> &emsp;
    <a href="psd_form.php">저장하기</a> &emsp;
  </div>
  <br>
</section>
<?
$conn->close();

 include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>