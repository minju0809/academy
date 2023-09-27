<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<section>
  <br>
  <div align="center">
    <h2>자료실 목록 보기</h2>

    <?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

    $count = 0;

    $sql = "SELECT * FROM examtbl_psd";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      ?>
      <table border="1" width=500>
        <tr>
          <td>번호</td>
          <td>이름</td>
          <td>파일명</td>
          <td>사진</td>
          <?
          while ($row = $result->fetch_assoc()) {
            $count++;
            ?>
          <tr>
            <td>
              <a href='psd_edit.php?sNo=<?=$row["sNo"]?>'><?= $row["sNo"] ?></a>
            </td>
            <td>
              <?= $row["sName"] ?>
            </td>
            <td>
              <?= $row["img"] ?>
            </td>
            <td>
              <img src="./files/<?= $row["img"] ?>" width="30" height="30" alt="이미지">
            </td>
          </tr>
        <?
          }
          ?>
      </table>
      전체 목록 수 :
      <?= $count ?>
    <?
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>

  </div>
  <br>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>