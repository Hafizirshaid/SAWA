<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 ?>
<div class="row">
<div class="span4"></div>
<div class=span4>

        <h2 align="center">Sign Up</h2>
        
        <form method="post" id="signup_form" action="addNewUser.php" enctype="multipart/form-data">
        <div class="alert alert-error" id="error_box">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <p id=error_messege> ERROR </p>
        </div>
        
           <hr>
           
            <div class="span4">
            <p>User Name</p>
            <input type="text" name="username" required>
            </div>
            
            <div class="span4">
            <p>First Name</p>
            <input type="text" name="firstname" required>
            </div>
            
            <div class="span4">
            <p>Second Name</p>
            <input type="text" name="secondname" required >
            </div>
            
            <div class="span4">
            <p>E-Mail</p>
            <input type="email" name="email" required>
            </div>
            
            
            <div class="span4">
            <p>Mobile Number</p>
            <input type="tel" name="mobilenum" required>
            </div>
            
            
            <div class="span4">
            <p>User Name</p>
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            </div>
            
			            
            <div class="span4">
            <p>Birth Date</p>
            <input type="date" name="birthdate">
            </div>
            
            
            <div class="span4">
            <p>Password</p>
            <input type="password" name="password" required>
            </div>
            
            <div class="span4">
            <p>Repeate Password</p>
            <input type="password" name="password2" required>
            </div>
            
            <div class="span4">
            <p>Personal Image</p>
            <input type="file" name="image" accept="image/jpeg">
            </div>
            
            
            
            <div class=span4>
            <label>
            	<input type="checkbox" name="terms" id="terms" required> 
                I agree with the <a href="#">Terms and Conditions</a>.
            </label>
            </div>
                       <hr>
            <!--sign up button-->
            <div class=span4>
            <input type="button" value="Signup" class="btn btn-primary" onClick="validate_form()">
       </div>
    	</form>
</div>
<div class=span4></div>
	
 </div>
 <script>
 //@todo must validate 
 //this function responsiple for validate the form values 
 function validate_form()
 {
	  
	 console.log("hafiz");
	 $("#signup_form").submit();
 }
 
 
 $(document).ready(function(e) 
 {
		//hide error mesege
	 $("#error_box").hide();
	
});
 
 </script>