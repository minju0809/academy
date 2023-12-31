<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>

<section>
	<br>
	<div id='divsection' align="center">
		<h2>Test 목록 보기</h2>

		<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

		$start = $_GET['start'];
		$page_size = 10;
		if ($start == '') {
			$start = 0;
		} else {
			$start = $_GET['start'];
		}

		$ch1 = $_GET["ch1"];
		$ch2 = $_GET["ch2"];

		if ($ch1 == "" || $ch2 == "") {
			$sql = "SELECT * FROM test limit $start, $page_size";
			$sql_tc = "SELECT count(*) tc from test";
		} else if ($ch1 == 'title') {
			$sql = "SELECT * FROM test where title like '%$ch2%' limit $start, $page_size";
			$sql_tc = "SELECT count(*) tc from test where title like '%$ch2%'";
		} else if ($ch1 == 'content') {
			$sql = "SELECT * FROM test where content like '%$ch2%' limit $start, $page_size";
			$sql_tc = "SELECT count(*) tc from test where content like '%$ch2%'";
		}

		$result = $conn->query($sql);
		$count = 0;

		// 전체 레코드 시작
		$result_tc = $conn->query($sql_tc);
		$row_tc = $result_tc->fetch_assoc();

		// 전체 레코드 끝
		$total_page = ceil($row_tc["tc"] / $page_size);

		// 현재 페이지
		$now_page = ($start / $page_size) + 1;

		if ($result->num_rows > 0) {
			?>
			<br>
			전체레코드 수:
			<?= $row_tc['tc'] ?><br>
			총 페이지 수:
			<?= $total_page ?><br>
			현재페이지:
			<?= $now_page ?>

			<table border="1" width=500>
				<tr bgcolor="#FFD700">
					<td>순번</td>
					<td>제목</td>
					<td>내용</td>
					<?
					while ($row = $result->fetch_assoc()) {
						if ($count % 2 == 0) {
							$bgcolor = "#FFD5B4";
						} else {
							$bgcolor = "FAEBCD";
						}
						$count++;
						?>
					<tr bgcolor='<?= $bgcolor ?>'>
						<td>
							<?= $count ?>
						</td>
						<td>
							<?= $row["title"] ?>
						</td>
						<td>
							<?= $row["content"] ?>
						</td>
					</tr>
				<? } ?>
			</table>
			<?
			// 페이지 이동
			// 내 방법
			if ($start < $page_size) {
				?>
				<a>첫 페이지</a>&emsp;
				<a href=test_list.php?start=<?= $start + 10 ?>&ch1=<?=$ch1?>&ch2=<?=$ch2?>>다음</a>
			<?
			} else if ($now_page == $total_page) { ?>
				<a href=test_list.php?start=<?= $start - 10 ?>&ch1=<?=$ch1?>&ch2=<?=$ch2?>>이전</a>&emsp;
				<a>마지막 페이지</a>
			<? } else {
				?>
				<a href=test_list.php?start=<?= $start - 10 ?>&ch1=<?=$ch1?>&ch2=<?=$ch2?>>이전</a>&emsp;
				<a href=test_list.php?start=<?= $start + 10 ?>&ch1=<?=$ch1?>&ch2=<?=$ch2?>>다음</a>
			<? } ?>
			<br>

			<!-- 선생님 방법 -->
			<? if ($start == 0) { ?>
				이전
			<? } else { ?>
				<a href=test_list.php?start=<?= $start - 10 ?>&ch1=<?=$ch1?>&ch2=<?=$ch2?>>이전</a>
			<? } ?>
			&emsp;
			<? if ($now_page != $total_page) { ?>
				<a href=test_list.php?start=<?= $start + 10 ?>&ch1=<?=$ch1?>&ch2=<?=$ch2?>>다음</a>
			<?
			} else { ?>
				다음
			<? } ?>

			<form>
				<select name="ch1">
					<option value="title">제목</option>
					<option value="content">내용</option>
				</select>
				<input name="ch2" type="text">
				<input type="submit" value="검색하기">
			</form>
		<? } else {
			echo "0 results";
		}
		$conn->close(); ?>
	</div>
	<br>
</section>

<?php include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>