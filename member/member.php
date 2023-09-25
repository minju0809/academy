<?php include $_SERVER["DOCUMENT_ROOT"]."/include/top.php" ?>

<section>
  <br>
  <div id='divsection' align=center>
    <h2>회원가입하기</h2>
    <form action="form_ok.php">
      <table border="1" width=400px height=200px>
        <tr>
          <td>&nbsp;아이디</td>
          <td><input type="text" name="id"></td>
        </tr>
        <tr>
          <td>&nbsp;비밀번호</td>
          <td><input type="password" name="password"></td>
        </tr>
        <tr>
          <td>&nbsp;이름</td>
          <td><input type="text" name="name"></td>
        </tr>
        <tr>
          <td>&nbsp;날짜</td>
          <td><input type="text" name="reg_date"></td>
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

<?php include $_SERVER["DOCUMENT_ROOT"]."/include/bottom.php" ?>