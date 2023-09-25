<?php include $_SERVER["DOCUMENT_ROOT"]."/include/top.php" ?>

<section>
  <br>
  <div id='divsection' align="center">
    <h2>회원관리 목록 보기</h2>

    <?php include $_SERVER["DOCUMENT_ROOT"]."/include/dbconn.php";
    $ch1 = $_GET["ch1"];
    $ch2 = $_GET["ch2"];
    echo "ch1: " . $ch1 . ", ch2: " . $ch2;

    if ($ch1 == "" || $ch2 == "") {
      $sql = "SELECT * FROM member limit 0, 7";
    } else if ($ch1 == 'id') {
      $sql = "SELECT * FROM member where id like '%$ch2%'";
    } else if ($ch1 == 'name') {
      $sql = "SELECT * FROM member where name like '%$ch2%'";
    }

    $result = $conn->query($sql);
    $count = 0;

    if ($result->num_rows > 0) {
      ?>
      <table border="1" width=500>
        <tr bgcolor="#52E4DC">
          <td>순번</td>
          <td>아이디</td>
          <td>비밀번호</td>
          <td>이름</td>
          <td>날짜</td>
          <?
          while ($row = $result->fetch_assoc()) {
            if ($count % 2 == 0) {
              $bgcolor = "#96FFFF";
            } else {
              $bgcolor = "#C8C8FF";
            }
            $count++;
            ?>
          <tr bgcolor='<?= $bgcolor ?>'>
            <td>
              <?= $count ?>
            </td>
            <td>
              <?= $row["id"] ?>
            </td>
            <td>
              <?= $row["password"] ?>
            </td>
            <td>
              <?= $row["name"] ?>
            </td>
            <td>
              <?= substr($row["reg_date"], 0, 4) ?> 년
              <?= substr($row["reg_date"], 5, 2) ?> 월
              <?= substr($row["reg_date"], 8, 2) ?> 일
            </td>
          </tr>
        <?
          }
          ?>
      </table>
      <form>
        <select name="ch1">
          <option value="id">아이디</option>
          <option value="name">이름</option>
        </select>
        <input name="ch2" type="text">
        <input type="submit" value="검색하기">
      </form>
    <?
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>

  </div>
  <br>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"]."/include/bottom.php" ?>










