<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<section>
  <?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

  $array1 = array("ASP", "JSP", "PHP", "ASP.NET");
  $array2 = array(" 초급", " 중급", " 고급");
  $array3 = array("영심이", "둘리", "하니", "똘이", "하늘이");


  for ($i = 1; $i <= 20; $i++) {
    $randomNum0 = mt_rand(1, 100);
    $randomNum1 = mt_rand(0, 3);
    $randomNum2 = mt_rand(0, 2);
    $randomNum3 = mt_rand(0, 4);

    $title = $array3[$randomNum3] . $randomNum0;
    $content = $array1[$randomNum1] . $array2[$randomNum2] . $array3[$randomNum3];

    $sql = "insert into test (title, content) 
    values ('$title', '$content')";
    $conn->query($sql);
    echo $sql . "<br>";
  }
  ?>

  <div align="center">
    <br><br><br><br>
    <h1>저장완료!!</h1>
  </div>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>