<?php
 include('wp-config.php'); 

if(isset($_POST['submit']))
{
 extract($_POST);
 $email;
 $query=mysql_query("select * from wp_user where email='$email'");
if(mysql_num_rows($query))
{
$reset_code=md5(uniqid(rand())); 
$sql2=mysql_query("INSERT INTO `reset_pass` (`id`, `email`, `random_code`) VALUES ('','$email' ,'$reset_code')");

$to = $email;
$subject = "Reset Password";
$header="from: Notifyd <dharma@cgcolors.com>";

// Your message
$message="Your Reset Password link \r\n";
$message.="Click on this link to activate your account \r\n";
$message.="http://www.cgcolors.com/dev/notifyd/wordpress/reset_password.php?pass_key=$reset_code";

// send email
$sentmail = mail($to,$subject,$message,$header);

 }
 
 if($sentmail)
 {
 echo "check your mail for your password";

 }
 }
 
?></div>
</div>
<div class="center">
 <h2>Login</h2>

</div>
    <form name="form1" method="post" action=" ">

	<div class="login-page">
   
    

   
    
    <div class="text-box-aligh">
     Email :<input name="myusername" type="email" placeholder="Email" required  class="login-text"><br><br>
     
     
    
    <input type="submit" name="Submit" class="login-button" value="Login">
    
    </div>
    
    </div>
   </form> 
   
    
    <div class="clr"></div>

	</div>
