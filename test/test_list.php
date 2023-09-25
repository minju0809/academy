<? include $_SERVER["DOCUMENT_ROOT"] . "/include/top.php" ?>
<section>

	<br>
	<div id=divsection align=center>
		<h2> Test 목록보기</h2>

		<? include $_SERVER["DOCUMENT_ROOT"] . "/include/dbconn.php";

		if ($start = $_GET['start'] == '') {
			$start = 0;
		} else {
			$start = $_GET['start'];
		}

		$page_size = 10;
		$ch1 = $_GET['ch1'];
		$ch2 = $_GET['ch2'];

		if ($ch1 == '' || $ch2 == '') {
			$sql = "SELECT * FROM test limit $start, $page_size ";
			$sql_tc = "SELECT count(*) tc FROM test";
		} else if ($ch1 == 'title') {
			$sql = "SELECT * FROM test  where title like '%$ch2%' limit $start, $page_size";
			$sql_tc = "SELECT count(*) tc FROM test where title like '%$ch2%'";

		} else if ($ch1 == 'content') {
			$sql = "SELECT * FROM test where content like '%$ch2%' limit $start, $page_size";
			$sql_tc = "SELECT count(*) tc FROM test where content like '%$ch2%'";
		}

		$result_tc = $conn->query($sql_tc);
		$row_tc = $result_tc->fetch_assoc();

		$result = $conn->query($sql);

		$total_page = ceil($row_tc["tc"] / $page_size);
		$now_page = ($start / $page_size) + 1;
		$end = ($total_page - 1) * $page_size;

		if ($result->num_rows > 0) {
			?>

			전체 레코드 수:
			<?= $row_tc['tc'] ?><br>
			전체 페이지 수:
			<?= $total_page ?><br>
			현재 페이지:
			<?= $now_page ?><br>

			<table border=1 width=500>
				<tr>
					<th>순번 </th>
					<th>번호 </th>
					<th>제목 </th>
					<th>내용 </th>
				</tr>
				<?
				while ($row = $result->fetch_assoc()) {
					$count++;
					if ($count % 2 == 0) {
						$bg = "#99aaCC";
					} else {
						$bg = "#aaffaa";
					}
					?>
					<tr bgcolor='<?= $bg ?>'>
						<td>
							<?= $count ?>
						</td>
						<td>
							<?= $row["num_id"] ?>
						</td>
						<td>
							<?= $row["title"] ?>
						</td>
						<td>
							<a href="test_delete.php?num_id=<?= $row['num_id'] ?>&ch1=<?= $ch1 ?>&ch2=<?= $ch2 ?>">
								<?= $row["content"] ?>
							</a>
						</td>
					</tr>
				<?
				}
				?>
			</table>
			<a href=test_list.php?start=0>처음으로</a>&emsp;
			<? if ($start == 0) {
				?> <a>이전</a>&emsp;
			<?
			} else { ?>
				<a href=test_list.php?start=<?= $start - 10 ?>>이전</a>&emsp;
			<? }
			if ($now_page != $total_page) { ?>
				<a href=test_list.php?start=<?= $start + 10 ?>>다음</a>&emsp;
			<? } else { ?>
				<a>다음</a>&emsp;
			<? } ?>
			<a href=test_list.php?start=<?= $end ?>>마지막으로</a>

			<form action="test_list.php" method=get>
				<select name="ch1">
					<option value="title">제목</option>
					<option value="content">내용</option>
				</select>
				<input type="text" name="ch2">
				<input type="submit" value="검색">
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

<? include $_SERVER["DOCUMENT_ROOT"] . "/include/bottom.php" ?>