
<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$CASE = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'CASE'"));
$CABECS = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'CABECS'"));
$CON = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'CON'"));
$COE = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'COE'"));
$BED = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = 'BED'"));
$ORG = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_department = ''"));

$TOTAL = $CASE + $CABECS + $COE + $BED + $ORG + $CON;

?>

<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/menu.js" ></script>

<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/enhance.js"></script>	
<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/include/js-include/jqBarGraph.1.1.min.js"></script>

<script>
	$(function(){
		arrayOfData = new Array(
			 [<?php echo $BED;?>,'BED','#ff0000'],
			 [<?php echo $CABECS;?>,'CABECS','#fffc00'],
			 [<?php echo $CASE;?>,'CASE','#52a600'],
			 [<?php echo $CON;?>,'CON','#ff97c8'],
			 [<?php echo $COE;?>,'COE','#fe8900'],
			 [<?php echo $ORG;?>,'ORG','#0066FF']
		);
		
		$('#barGraph').jqBarGraph({ data: arrayOfData }); 
	});
</script>

<br>
<br>
<br>
<font size="4">TOTAL: <?php echo $TOTAL;?></font>

<br>
<br>
<br>
                        <div class="rightCol-inside">
                             <div class="tab">        
								<div id="barGraph" style="margin:0 auto;">
                                </div>
                             </div> 