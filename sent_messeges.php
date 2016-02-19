<?php
include("Auth.php");
/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */

/**
 * Description of Requested_Trip
 *  
 * @author Hafiz
 */
?>


<div class="row">
<div class="span12">

<h1>Sent Messeges</h1>
<hr>
</div>

<div class="span12">

<!-- this div contain all messeges received by the user  -->
<div class="span3">

<?php
//here get all messeges by this user .
include_once("Model/Messege.php");
include_once("Model/User.php");

$username_getter = new User(); 
$messege = new Messege();

//all messeges received is in $user_messeges
$user_messeges = $messege->get_user_sent_messeges($_SESSION['user_id']);
?>


<ul class="nav nav-list bs-docs-sidenav">
<?php

$i = 0;
while($row = $user_messeges->fetch_assoc())
{
	$i++;
?>
    	 <li id=<?php echo $i; ?> onClick="show_messege_id(<?php echo $row['Messege_ID'];?>,<?php echo $i; ?>)">
            	<?php echo $username_getter->get_user_full_name_by_id($row['receiver_ID']);?>
            <br>
            	<?php  echo $row['title']; ?>
	
        </li>
    <?php	
}

	?>
    <ul>
</div>
<!--this div contain the messege itself -->
<div class="span8" id="messege_body" style="border:solid 1px;height:250px;overflow:scroll">
</div>
</div>

<script>


//to send messege
$("#send_messege").click(function()
{
	$("#page-body").load("send_messege.php");
});

$("#sent_messeges").click(function(e)
{	
	$("#page-body").load("sent_messeges.php");
});


function remove_all_li_active_state()
{
	$("li").prop("class","");	
}

//show the messege in messesge div 
function show_messege_id(id,li_id)
{
	//you should remove all class acitve from non clicked list item
	remove_all_li_active_state();
	$("#" + li_id).prop("class","active");
    var $data = "messege_id=" + id;
	$.post(
	"show_messege_body.php",
	$data,
	function(res)
	{
		$("#messege_body").html(res);
	});	
}
</script>
</div>


</div>