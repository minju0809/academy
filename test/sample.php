<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<!---------------------------------------------------------->
<!-- vscode 기존 파일 div 안에 내용 지우고 테이블 생성, 합계, 평균, 평점 추가 -->
<!-- 테이블 밑에 전체 학생 수 찍기, 테이블 가장 하단에 레코드 두 줄 추가(tr)해서 각 컬럼의 누적 합, 누적 평균 찍기 -->
<!-- 평점이 f 인 친구들의 이름을 빨간색으로, 학번을 학년, 반, 번호로 나누기 -->
<!-- 이름 옆에 사진 컬럼 추가하여 이미지 넣기 -->
<!-- 학년, 반, 번호 셀 나누어서 표시하고 이름, 평점(테이블에 없음)으로 검색 추가  -->
<section>
  <br>
  <div align=center>
    <table border=1 width=600>
      <h2>학생 성적 처리 프로그램</h2>
      <? include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

      $ch1 = $_GET["ch1"];
      $ch2 = $_GET["ch2"];

      if ($ch1 == '' || $ch2 == '') {
        $sql = "SELECT * FROM examtbl";
      } else if ($ch1 == 'sName') {
        $sql = "SELECT * FROM examtbl where sName like '%$ch2%'";
      } else if ($ch1 == 'grade') {
        $ch2 = strtoupper($_GET['ch2']); // 대문자로 변경
        if ($ch2 == 'A') {
          $sql = "SELECT * FROM examtbl where (kor+eng+math+hist)/4>=90";
        } else if ($ch2 == 'B') {
          $sql = "SELECT * FROM examtbl where (kor+eng+math+hist)/4>=80 and (kor+eng+math+hist)/4<90";
        } else if ($ch2 == 'C') {
          $sql = "SELECT * FROM examtbl where (kor+eng+math+hist)/4>=70  and (kor+eng+math+hist)/4<80";
        } else if ($ch2 == 'F') {
          $sql = "SELECT * FROM examtbl where (kor+eng+math+hist)/4<70";
        }
      }

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        ?>

        <tr>
          <th>학년</th>
          <th>반</th>
          <th>번호</th>
          <th>이름</th>
          <th>사진</th>
          <th>국어</th>
          <th>영어</th>
          <th>수학</th>
          <th>역사</th>
          <th>합계</th>
          <th>평균</th>
          <th>평점</th>
        </tr>

        <?
        $count = 0; // 변수 초기화를 위해 작성해줌(초기값) (없어도 오류가 나타나지 않게 처리해두면 나타나지 않음)
        while ($row = $result->fetch_assoc()) {
          $count++;

          $snoyear = substr($row["sNo"], 0, 1);
          $snoclass = substr($row["sNo"], 1, 2);
          $snonum = substr($row["sNo"], 3, 2);

          $sum = $row["kor"] + $row["eng"] + $row["math"] + $row["hist"];
          $avg = round($sum / 4, 1);

          if ($avg >= 90) {
            $grade = "A";
          } else if ($avg >= 80) {
            $grade = "B";
          } else if ($avg >= 70) {
            $grade = "C";
          } else {
            $grade = "F";
          }

          if ($grade == 'F' ? $bg = '#ff0000' : $bg = '#cccccc')
            ;

          $ksum += $row["kor"];
          $esum += $row["eng"];
          $msum += $row["math"];
          $hsum += $row["hist"];
          $tsum += $sum;
          $asum += $avg;
          ?>

          <tr>
            <td align=center>
              <?= $snoyear ?>
            </td>
            <td align=center>
              <?= $snoclass ?>
            </td>
            <td align=center>
              <?= $snonum ?>
            </td>
            <td align=center bgcolor="<?= $bg ?>">
              <?= $row["sName"] ?>
            </td>
            <td>
              <img src="./img/image<?= $count ?>.png" alt="이미지<?= $count ?>" width=40>
            </td>
            <td>
              <?= $row["kor"] ?>
            </td>
            <td>
              <?= $row["eng"] ?>
            </td>
            <td>
              <?= $row["math"] ?>
            </td>
            <td>
              <?= $row["hist"] ?>
            </td>
            <td>
              <?= $sum ?>
            </td>
            <td>
              <?= $avg ?>
            </td>
            <td align=center>
              <?= $grade ?>
            </td>
          </tr>

        <? } ?>

        <tr>
          <td align=center colspan="5">누적합</td>
          <td>
            <?= $ksum ?>
          </td>
          <td>
            <?= $esum ?>
          </td>
          <td>
            <?= $msum ?>
          </td>
          <td>
            <?= $hsum ?>
          </td>
          <td>
            <?= $tsum ?>
          </td>
          <td>
            <?= $asum ?>
          </td>
          <td align=center rowspan="2"></td>
        </tr>
        <tr>
          <td align=center colspan="5">누적평균</td>
          <td>
            <?= round($ksum / $count, 1) ?>
          </td>
          <td>
            <?= round($esum / $count, 1) ?>
          </td>
          <td>
            <?= round($msum / $count, 1) ?>
          </td>
          <td>
            <?= round($hsum / $count, 1) ?>
          </td>
          <td>
            <?= round($tsum / $count, 1) ?>
          </td>
          <td>
            <?= round($asum / $count, 1) ?>
          </td>
        </tr>
      </table>
      학생 수 :
      <?= $count ?><br>

      <form action="sample.php" method="get">
        <select name="ch1">
          <option value="sName">이름</option>
          <option value="grade">평점</option>
        </select>
        <input type="text" name="ch2">
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

<!---------------------------------------------------------->
<!-- 밖은 while문, 안은 for문으로 구구단 찍기 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1">
      <tr>
        <th colspan="9">구구단</th>
      </tr>
      <?
      $dan = 2;
      while ($dan <= 9) {
        ?>
        <tr>
          <? for ($i = 1; $i <= 9; $i++) {
            ?>
            <td>
              <?= $dan ?>X
              <?= $i ?>=
              <?= $dan * $i ?>
            </td>
          <?
          }
          ?>
        </tr>
        <?
        $dan++;
      } ?>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- 밖은 for문, 안은 while문에서 홀수단만 찍기 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1">
      <tr>
        <th colspan="9">구구단</th>
      </tr>
      <? for ($dan = 2; $dan <= 9; $dan++) {
        ?>
        <tr>
          <?
          $i = 1;
          while ($i <= 9) {
            if ($dan % 2 != 0) {
              ?>
              <td>
                <?= $dan ?>X<?= $i ?>=<?= $dan * $i ?>
              </td>
            <?
            }
            $i++;
          }
          ?>
        </tr>
      <?
      } ?>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- 밖은 for문, 안은 while문으로 구구단 찍기 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1">
      <tr>
        <th colspan="9">구구단</th>
      </tr>
      <? for ($dan = 2; $dan <= 9; $dan++) {
        ?>
        <tr>
          <?
          $i = 1;
          while ($i <= 9) {
            ?>
            <td>
              <?= $dan ?>X<?= $i ?>=<?= $dan * $i ?>
            </td>
            <?
            $i++;
          }
          ?>
        </tr>
      <?
      } ?>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- 2중 for문으로 구구단 가로로 찍기 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1">
      <tr>
        <th colspan="9">구구단</th>
      </tr>
      <? for ($dan = 2; $dan <= 9; $dan++) {
        ?>
        <tr>
          <?
          for ($i = 1; $i <= 9; $i++) {
            ?>
            <td>
              <?= $dan ?>X<?= $i ?>=<?= $dan * $i ?>
            </td>
          <?
          }
          ?>
        </tr>
      <?
      } ?>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- 2중 while문으로 구구단 찍기 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1" width=400>
      <tr>
        <th colspan="9">구구단</th>
      </tr>
      <? $dan = 2;
      while ($dan <= 9) {
        ?>
        <tr>
          <? $i = 1;
          while ($i <= 9) {
            ?>
            <td>
              <?= $dan ?>X<?= $i ?>=<?= $dan * $i ?>
            </td>
            <?
            $i++;
          } ?>
        </tr>
        <? $dan++;
      } ?>

    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- for문으로 div 안에 내용 다 지우고 테이블 생성, 가로로 2~9까지 출력 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1">
      <tr>
        <?
        for ($i = 2; $i <= 9; $i++) {
          ?>
          <td>
            <?= $i ?>
          </td>
          <?
        } ?>
      </tr>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- while문으로 div 안에 내용 다 지우고 테이블 생성, 가로로 2~9까지 출력 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1">
      <tr>
        <?
        $i = 2;
        while ($i < 10) {
          ?>
          <td>
            <?= $i ?>
          </td>
          <? $i++;
        } ?>
      </tr>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- while문으로 3단 구구단 옆으로 찍기 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1" width=400>
      <? $dan = 3 ?>
      <tr>
        <th colspan="9">
          <?= $dan ?> 단
        </th>
      </tr>
      <tr>
        <? $i = 1;
        while ($i <= 9) {
          ?>
          <td>
            <?= $dan ?>X<?= $i ?>=<?= $dan * $i ?>
          </td>
          <?
          $i++;
        } ?>
      </tr>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- while문으로 3단 구구단 아래로 찍기 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1" width=400>
      <? $dan = 3 ?>
      <tr>
        <th>
          <?= $dan ?> 단
        </th>
      </tr>
      <? $i = 1;
      while ($i <= 9) {
        ?>
        <tr>
          <td>
            <?= $dan ?> X <?= $i ?> = <?= $dan * $i ?>
          </td>
        </tr>
        <?
        $i++;
      } ?>
    </table>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- 번호의 누적합 -->
<!-- <section>
  <br>
  <div align=center>
    <table border="1" width=400>
      <tr>
        <th>번호</th>
        <th>이름</th>
        <th>나이</th>
      </tr>
      <? $i = 5;
      while ($i >= 1) {
        $randomNum = mt_rand(1, 50);
        ?>
        <tr>
          <td>
            <?= $i ?>
          </td>
          <td>영심이
            <?= $i ?>
          </td>
          <td>
            <?= $randomNum ?>
          </td>
        </tr>
        <?
        $s += $i;
        $i--;
      } ?>
    </table>
    누적 합:
    <?= $s ?>
  </div>
  <br>
</section> -->

<!---------------------------------------------------------->
<!-- while문 사용해서 레코드 5개 나타내기 + 나이 난수로 받기 -->
<!-- <table border="1" width=400 align=center>
    <tr>
      <th>번호</th>
      <th>이름</th>
      <th>나이</th>
    </tr>
    <?
    $i = 1;
    while ($i < 6) {
      ?>
      <tr>
        <td>
          <?= $i ?>
        </td>
        <td>영심이<?= $i ?></td>
        <td>나이</td>
      </tr>
      <? $i++;
    } ?>
  </table> -->

<!---------------------------------------------------------->
<!-- for문 사용 해서 레코드 5개 나타내기 + 나이 난수로 받기 -->
<!-- <table border="1" width=400 align=center>
    <tr>
      <th>번호</th>
      <th>이름</th>
      <th>나이</th>
    </tr>
    <?
    $count = 0;
    for ($i = 0; $i < 5; $i++) {
      $randomNum = mt_rand(1, 40);
      $count++;
      ?>
      <tr>
        <td>
          <?= $count ?>
        </td>
        <td>영심이</td>
        <td><?= $randomNum ?></td>
      </tr>
    <? } ?>
  </table> -->

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>