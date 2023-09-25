<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

$num_id = $_GET['num_id'];
$ch1 = $_GET['ch1'];
$ch2 = $_GET['ch2'];

$sql = "DELETE from test where num_id = '$num_id'";

$conn->query($sql);
$conn->close();

?>

<script>
  // 검색 했던 결과값 그대로 돌아가기
  location.href = "test_list.php?ch1="+'<?=$ch1?>'+"&ch2="+'<?=$ch2?>';
</script>