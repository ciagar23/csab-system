<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$CASE = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'CASE'"));
$CABECS = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'CABECS'"));
$CON = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'CON'"));
$COE = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'COE'"));
$BED = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'BED'"));
$ORG = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'SCHOOL ORG'"));

$TOTAL = $CASE + $CABECS + $COE + $BED + $ORG + $CON;

?>
<br>
<br>
<br>
<font size="4">TOTAL: <?php echo $TOTAL;?></font>

<br>
<br>
<br>
<img src="bar.php?CABECS=<?php echo $CABECS;?>&CASE=<?php echo $CASE;?>&CON=<?php echo $CON;?>&COE=<?php echo $COE;?>&BED=<?php echo $BED;?>&ORG=<?php echo $ORG;?>" width="100%" />