<?php
//include("Auth.php");
?>
<div class="row">
<div class="span2"></div>
<div class="span10">
<form class="form" name="changePassword" action="updatePassword.php" method="POST" role="form">
  <div class="form-group">
    <strong>New Password:&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" class="form-control input-lg" name="inputPassword1" id="inputPassword1" placeholder="New Password">
  </div>
  <div class="form-group">
    <strong>Confirm Password:&nbsp;&nbsp;</strong><input type="password" class="form-control" name="inputPassword2" id="inputPassword2" placeholder="Confirm Password">
    <div class="col-lg-10">
      
    </div>
  </div>
  <div class="form-group">
		<div class="span2"></div>
	  <div class="col-lg-offset-2 col-lg-10">
      <button class="btn btn-primary" onclick="checkPassword()">Save</button>
	  </div>
  </div>
</form>
</div> 
<div class="span2"></div>
<div class="span5">
<div class="alert alert-success" id="successful" style="visibility:hidden;">Your password has been successfuly updated.</div></div>
<div class="span12"></div>
<div class="span6">
<div class="alert alert-danger" id="failed" style="visibility:hidden;"><strong>Failed! The two passwords do not match</strong></div></div>
<div class="span12"></div>
<div class="span6">
<div class="alert alert-warning" id="info" style="visibility:hidden;"><strong>Info: The password can't be less than 8 characters.</strong></div></div>

</div>