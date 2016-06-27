<?php

$dean = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_dean =0"));
$president = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_president =0"));
$imc = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_imc =0"));
$gso = mysql_num_rows(mysql_query("SELECT * FROM tbl_borrowed where b_gso =0"));


?>


<img src="<?php echo WEB_ROOT;?>images/facade.png" width="100%" height="200">

<table height="100%" width="100%">
<tr><td height="100%" >
<br><br><br>
<font size="3" color="#FF0000">
* <?
if ($position =='Dean')
{

echo 'You have '.$dean.' pending confirmation';

}
else if ($position =='President')
{

echo 'You have '.$president.' pending confirmation';

}
else if ($position =='IMC')
{

echo 'You have '.$imc.' pending confirmation';

}
else if ($position =='GSO')
{

echo 'You have '.$gso.' pending confirmation';

}
else
{

echo 'Welcome to CSAB Homepage';

}

if ($position =='GSO' || $position=='IMC' || $position =='Dean' || $position =='President')
{
include 'list.php';
include 'aproval.php';
}
else
{
include 'aproval.php';
}


?>





</table>