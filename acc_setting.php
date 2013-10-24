<?php
ob_start();
session_start();
/**
 * Template Name: Profile
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header("account"); ?>
</div>
</div>
<div class="center">
 <h2>My Dashboard</h2>

</div>

	<div class="login-page"> <!---login page div start here----->
   
    
    <div class="profile-page"> <!----Profile div start here---->
   
   		<div class="left-links">
        
       <ul>
        	<li  class="active"><a href="Profile.html">Profile</a></li>
         	<li><a href="My-sarches.html">My Searches</a></li>
        	<li><a href="Account-settings.html">Account Settings</a></li>
        </ul>


        </div> 

		
        <div class="text-boxes"> <!----text boxes div start here---->
        
        <form>
            First Name : <input type="text" class="profile-login-text" value="ABC"><br>
            Last Name : <input type="text" name="pwd" class="profile-login-text" value="xyz"><br>
            Address : &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="pwd" class="profile-login-text" value="#abc New Delhi. India"><br>
            Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="pwd" class="profile-login-text" value="abc@xyz.com"><br>
        </form>
                
                <div class="login-button">Save</div>
        
        
        </div>  <!----text boxes div close here---->


       
   </div>   <!----Profile div close here---->
       
    </div> <!---login page div close here----->
    
	        <div class="clr"></div>

<?php

get_footer(); ?>
