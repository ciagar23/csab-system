
<link rel='stylesheet' type='text/css' href='demos/cupertino/theme.css' />
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='jquery/jquery-1.8.1.min.js'></script>
<script type='text/javascript' src='jquery/jquery-ui-1.8.23.custom.min.js'></script>
<script type='text/javascript' src='fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript'>

	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			events: [




<?php
if (!defined('WEB_ROOT')) {
	exit;
}


if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
	$catId = (int)$_GET['catId'];
	$sql2 = " AND p.cat_id = $catId";
	$queryString = "catId=$catId";
} else {
	$catId = 0;
	$sql2  = '';
	$queryString = '';
}

// for paging
// how many rows to show per page
$rowsPerPage = 1000;

$sql = "SELECT b_id,b_name,b_borrower,b_code,b_by ,b_bm ,b_bd ,b_bh ,b_bmi,b_ry ,b_rm ,b_rd ,b_rh ,b_rmi, b_purpose, b_gso 
        FROM tbl_borrowed where b_gso=1 ";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

$categoryList = buildCategoryOptions($catId);


$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
	
	$b_bm = $b_bm-1;
	$b_rm = $b_rm-1;
		
		
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
		
		$sql1 = "SELECT *
        FROM tbl_user where user_name='$b_borrower'";
		$result1 = mysql_query($sql1);
		$show = mysql_fetch_array($result1);	
		$firstname= $show['user_fname'];
		$lastname= $show['user_lname'];
		if($b_rh >= 12)
		{
		$thetime1 = ($b_bh-12).':'.$b_bmi.' PM';
		$thetime = ($b_rh-12).':'.$b_rmi.' PM';
		}
		else
		{
		$thetime1 = $b_bh.':'.$b_bmi.' AM';
		$thetime = $b_rh.':'.$b_rmi.' AM';
		}
		
		
?>




				{
					title: '\n<?php echo $thetime1.'-'.$thetime;?>\nPurpose: <?php echo $b_purpose;?>, Teacher: <?php echo $firstname;?> <?php echo $lastname;?>',
start: new Date(<?php echo $b_by;?>, <?php echo $b_bm;?>, <?php echo $b_bd;?>, <?php echo $b_bh;?> , <?php echo $b_bmi;?>),
end: new Date(<?php echo $b_ry;?>, <?php echo $b_rm;?>, <?php echo $b_rd;?>, <?php echo $b_rh;?> , <?php echo $b_rmi;?>),
					url: 'klkn',
					allDay: false
				},
  
  
  
  
  
  
  <?php
	} // end while
?>
 					{
					title: 'Welcome to CSAB',
					start: new Date(2012, 10, 1,1,0),
					end: new Date(2012, 5, 1,1,0),
					url: 'a.htm',
					allDay: false
				}
			]
		});
		
	});

</script>
<style type='text/css'>

	body {
		margin-top: 40px;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}

	#calendar {
		width: 100%;
		margin: 0 auto;
		}

</style>
</head>
<body>
<div id='calendar'></div>
</body>
</html>

<?php	
} else {
?>
  <tr> 
   <td colspan="5" align="center">No Items Yet</td>
  </tr>
  <?php
}
?>
