<?php
  require("./include/variable_setting.php");
?>

<?php
  /**
   * connect to db
   */
  require("./include/db_connection.php");
?>

<?php
  // 取得SQL指令
  $SQL = "SELECT * ";
  $SQL .= " FROM $TABLE_NAME";
  $SQL = stripslashes($SQL);
?>

<?php
  /**
   * $HTML_TABLE
   */
  $HTML_TABLE = "";
  $HTML_TABLE .= '<table>';
  foreach ($TABLE_FIELD_NAME_ARRAY as $field_name) {
      if($field_name == "B_ID")
      {
          $SQL1="SELECT MAX(B_ID) FROM book";
          $result1=mysqli_query($link,$SQL1);
          $row1=mysqli_fetch_array($result1);
          $max=$row1['MAX(B_ID)'];
          $HTML_TABLE .= "<tr>";
          $HTML_TABLE .= "<td>$field_name:</td>";
          $HTML_TABLE .= '<td>'.($max+1).'<input type="hidden" name="' .$field_name . '" value="' . ($max+1) . '"></td>';
          $HTML_TABLE .= "</tr>";
      }
      else{
          $HTML_TABLE .= "<tr>";
          $HTML_TABLE .= "<td>$field_name:</td>";
          $HTML_TABLE .= '<td><input type="text" name="' . $field_name . '" require></td>';
          $HTML_TABLE .= "</tr>";
      }
  }
  $HTML_TABLE .= "</table>";
?>


<?php
/**
 * Page's HTML
 */
$PAGE_HTML = <<<HTML

<h2>資料庫管理系統-新增</h2>
<hr>

<p>
  <form action="controller.php" method="post">

    $HTML_TABLE

    <p>
      <input type="submit" name="operation_add" value="新增">
      <input type="reset" value="清除">
    </p>
  </form>
<form action="../">
     <input type="submit" name="page" value="回主畫面">
</form>
<form action="index.php">
     <input type="submit" name="page" value="回上一層">
</form>
</p>

<hr>

HTML;
?>



<?php
  /**
   * close db
   */
  require("./include/db_close.php");
?>

<?php
/**
 * Output HTML
 */
echo $PAGE_HTML;
?>
