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

if(isset($_SESSION['user_id']))
{
	include_once("Model/User.php");
	$user = new User();
	$data = $user->get_user_by_id($_SESSION['user_id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SAWA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SAWA Utility">
    <meta name="author" content="Hafiz K.Irshaid">
	<script src="js/jquery.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<div class="container">
<div class="row">
<div class="span9">
<h3 class="muted">SAWA</h3>
      </div>
      <div class="span3">
        <?php
		if(isset($data))
			{
				echo "Welcome <b>".$data['username']."</b>";			
				include_once("Model/Messege.php");
				$messeges = new Messege();
		?>
        </div>
        <div class="span3">
        <a id="messeges" class="btn">
		Messeges(<?php
			echo $messeges->get_number_of_unread_messeges($_SESSION['user_id']);

				?>)
		</a> 
        <a href="signout.php" class="btn btn-primary">Sign out</a>

		<?php

            //if this user is admin, show statisitcs button 
            /*if($_SESSION['user_id'] == 45)
            {
                //echo "<a id='statisitcs' class='btn'>Statistics</a>";
            }
            */
			}
	    ?>
      </div>
      </div>
      </div>
<!-- start of page container -->
<div class="container" id="page-container">

    <!-- start of header-->
    <div class="masthead" id="navigation-bar">
        
        <!-- nav bar -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li  id="_home">
                        	<a href="#" id="home">Home</a>
                        </li>
						
                        <li id="_signin">
                        	<a href="#" id="signin">Sign In</a>
                        </li>
                        <li id="_downloads"><a href="#" id="downloads">Downloads</a></li>
                        <li id="_services"><a href="#" id="services">Services</a></li>
                        <li id="_about"><a href="#" id="about">About</a></li>
                        <li id="_contact"><a href="#" id="contact">Contact</a></li>
                        <?php
                        if(isset($_SESSION['user_id']))
                        {
                            if($_SESSION['user_id'] == 45)
                            {
                                echo "<li id='_statistics'><a href=# id='statistics'>Statistics</a></li>";
                              //echo "<a id='statisitcs' class='btn'>Statistics</a>";
                            }
                        }

                    ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.nav bar -->
    </div>
    <!--end of header-->
    
    <!--  start of page body  -->
    <div id="page-body">
    
    </div>
    <!--  end of page body  -->

    <!--footer-->
    <div class="footer" id="footer-div">
    <hr>
            <div class="container">
            <p>&copy; SAWA 2013 all right reserved Hafiz & Mustafa</p>
        </div>
    </div>
    <!-- end of footer-->

</div>
<!-- end of page container -->

<!-- Placed at the end of the document so the pages load faster -->

<script src="js/myScript.js"></script>
<!--Bootstrap Libraries-->
<script src="js/bootstrap-transition.js"></script>
<script src="js/bootstrap-alert.js"></script>
<script src="js/bootstrap-modal.js"></script>
<script src="js/bootstrap-dropdown.js"></script>
<script src="js/bootstrap-scrollspy.js"></script>
<script src="js/bootstrap-tab.js"></script>
<script src="js/bootstrap-tooltip.js"></script>
<script src="js/bootstrap-popover.js"></script>
<script src="js/bootstrap-button.js"></script>
<script src="js/bootstrap-collapse.js"></script>
<script src="js/bootstrap-carousel.js"></script>
<script src="js/bootstrap-typeahead.js"></script>
<!--JQuery UI Libraries -->
<link rel="stylesheet" href="js/JQueryUI/themes/base/jquery.ui.all.css">	
<script src="js/JQueryUI/external/jquery.mousewheel.js"></script>
<script src="js/JQueryUI/external/globalize.js"></script>
<script src="js/JQueryUI/external/globalize.culture.de-DE.js"></script>
<script src="js/JQueryUI/ui/jquery.ui.core.js"></script>
<script src="js/JQueryUI/ui/jquery.ui.widget.js"></script>
<script src="js/JQueryUI/ui/jquery.ui.button.js"></script>
<script src="js/JQueryUI/ui/jquery.ui.spinner.js"></script>

<?php
if(isset($data))
{
//change the label sign in to Users
	?>
	<script>
		$("#signin").text("User Profile");
	</script>
	<?php
}
else
{
?>
<script>
	$("#signin").text("Login");
</script>
<?php
}
?>
</body>
</html>