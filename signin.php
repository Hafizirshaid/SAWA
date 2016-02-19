<?php
session_start();
/*
	
	this code wriiten by Hafiz K.Irshaid
	
	E-mail: hkmmi.2010@gmail.com
	
	Computer Engineering 
	
	Najah National University 
	
	Software Graduation Project : SAWA
	
	Date created 15/9/2013 by Hafiz K.Irshaid

*/

if(!isset($_SESSION['user_id']))
{
?>
<h1>Sign in </h1>
<hr>
<div class="row">

	<div class="span4">
    <p> If you do not have account </p>
     <a id=signup class="btn btn-large btn-primary">Register Now</a></div>
    <div class="span4">
    <!--class="form-signin"-->
            <form method="post" id="login_form">
                <h2 class="form-signin-heading">Please sign in</h2>
                
               <div class="alert alert-error" id="error_box">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning!</strong> Error.
                </div>
                
  <input type="text" name="username" id="username" class="input-block-level" placeholder="Email address">
                <input id="password" name="password" type="password" class="input-block-level" placeholder="Password">
                <label class="checkbox">
                  <input type="checkbox" value="remember-me"> Remember me
                </label>
                <input type="submit" class="btn btn-large btn-primary" value="Sign In"/>
                
               
            </form>
    </div>
	<div class="span4"></div>
      
</div>
      
<script type="text/javascript">
	  $(document).ready(function(e) 
	 {
		 $error_box = $("#error_box");
		 $error_box.hide();
		 $form = $("#login_form");
		 $form.submit(function(event)
		 {
				 var error_messege = "";
				event.preventDefault();
				$username = $("#username");
				$password = $("#password");
				
				if($password.val() == "")
				{
					error_messege += "Password Requerd ";
				}
				
				if($username.val() == "")
				{
					error_messege += ",Username Requerd ";
				}
				
				
				$.post("login_check.php",$form.serialize(),
				function (response)
				{
					
					if(response == "ERROR")
					{
						error_messege = "Username or Password Error";
						var html =  "<button type=button class=close data-dismiss=alert>&times;</button>";
					 $error_box.html(error_messege + html);
					 $error_box.show(); 
						
						//alert("kifgnoisuhf");
					}
					else if(response == "SUCESS")
					{
						//console.log("hhhhhhhhhhhhh");
						location.reload();
						//refresh the page 
					}
				});//respose event
				
				
				 if(error_messege != "")
				 {
					 var html =  "<button type=button class=close data-dismiss=alert>&times;</button>";
					 $error_box.html(error_messege + html);
					 $error_box.show(); 
				 }
			 
		 });
		 
           // this function is responsible to validate input data and send it to server
		 // $(".alert").hide();
			//clicking on submit button
			$("#submit").click(function()
			{
			  //alert($("#userMail").val());
			  $(".alert").show();
			//  $("#login_form").submit();
			  
			});
			$("#signup").click(function()
			{
				$("#page-body").load("signup.php");
			});
    });
</script>



<?php
}
else 
{
	include("userProfile.php");
	
}


/*


?>

<h1>User</h1>

<?php  
include_once("Model/User.php");

$user = new User();

$data = $user->get_user_by_id($_SESSION['user_id']);
//print_r($data);
include_once("Model/Messege.php");

$messeges = new Messege();

?>
<a href="signout.php">Sign out</a>
<a href="messeges.php">Messeges(<?php
echo $messeges->get_number_of_unread_messeges($_SESSION['user_id']);

		
?>)
</a>

<?php
$userData = $user->get_user_by_id($_SESSION['user_id']);


?>
 <script>
 $("#error_box").hide();
 </script>
 
 
 
 <!------------------>
 
 
<div class="row-fluid">
	  <div class="span"></div>
  <div class="span6">
  <div class="container">
    <div class="span2">
    <img src="UsersImages/<?php echo $userData['UsersImages'];?>" alt="" class="img-rounded">
    </div>
    <div class="span4">
	<table class="table">
	<tr>
	<td> 
    <strong><p>First name:</p></strong></td><td><span class="badge"><?php echo $userData['firstname'];?></span>
    </td>
	</tr>
	<tr>
	<td><strong><p>Last name:</p></strong></td><td><span class="badge"><?php echo $userData['lastname'];?></span></td>
	</tr>
	<tr>
	<td><strong><p>Birth date:</p></strong></td><td><span class="badge"><i class="icon-gift"></i><?php echo $userData['birthdate'];?></span></td>
	</tr>
	<tr>
	<td><strong><p>Country:</p></strong></td><td><span class="badge"><i class="icon-map-marker"></i><?php echo $userData['country'];?></span></td>
	</tr>
	<tr>
	<td>
    <strong><p>Email:</p></strong></td>
    <td><span class="badge"><i class="icon-envelope"></i><?php echo $userData['email'];?></span></td>
	</tr>
	<tr>
	<td><strong><p>Mobile Number:</p></strong></td><td><span class="badge"><?php echo $userData['mobilenumber'];?></span></td>
	</tr>
	<tr>
	<td><strong><p>Registered since:</p></strong></td><td><span class="badge"><?php echo $userData['RegistrationDate'];?></span></td>
	</tr>
	<tr>
	<td><strong><p>Rate:</p></strong></td><td><span class="badge"><i class="icon-globe"></i><?php echo $userData['Rate'];?></span></td>
	</tr>	
	</table>
    </div>
    </div></div>
	</div>
	<div class="span6">
    <h5>Rating for Mustafa</h5>
    <strong>Punctuality</strong><span class="pull-right">30%</span>
    <div class="progress progress-danger active">
    <div class="bar" style="width: 30%;"></div>
    </div>
    <strong>Agreements</strong><span class="pull-right">50%</span>
    <div class="progress progress-info active">
    <div class="bar" style="width: 50%;"></div>
    </div>
    <strong>Well being</strong><span class="pull-right">99%</span>
    <div class="progress progress-success active">
    <div class="bar" style="width: 99%;"></div>
    </div>
    <strong>Others</strong><span class="pull-right">60%</span>
    <div class="progress progress-warning active">
    <div class="bar" style="width: 60%;"></div>
    </div>
    <p>
    <a href="#" class="btn btn-large btn-success">Rate</a>
    </p>
    </div>
 <?php
 
 
}//else*/
?>
 <!---------->
 
 
 