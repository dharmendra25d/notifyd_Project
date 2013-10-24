<?php
include('../../../../wp-config.php');
if(isset($_POST['email']))
{
echo $email = $_POST['email'];
$sql = mysql_query("select id from wp_user where email='$email'");
if(mysql_num_rows($sql))
{
echo '<STRONG>'.$username.'</STRONG> is already in use.';
}
else
{
echo 'OK';
}
}
?>