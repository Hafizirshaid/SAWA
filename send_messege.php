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
<div class="span12">
<h1>New Messege</h1>
</div>

<div class="span2">
</div>

<div class="span8">

<div class=span2>
<p>Receiver</p>
</div>
<div class=span6>


<form id=f>

<select name="receiver">
<?php

	include_once("Model/User.php");
	$allusers = new User();
	$all = $allusers->get_all_users_ids();
	while($value = $all->fetch_assoc())
	{
		echo "<option value=".$value['user_id'].">".$value['username']."</option>";
	}
?>

</select>
</div>


<div class=span2>
<p>Title</p>
</div>
<div class=span6>
<input type="text" name="title">
</div>


<div class=span2>
<p>Messege Body</p>
</div>
<div class=span6>
<textarea name="Messege_body"></textarea>
</div>

<div class=span8>
<input type=submit value="Send Messege" class="btn">

</div>

</div>


<div class="span2">
</div></form>


</div>
<script>

	$("#f").submit(function(e)
	{
		alert("hafiz");
		console.log("klsdfngisdufgvb");
		var $form = $("#f");
		
		$input = $form.find("receiver, title, Messege_body");
		
		$data = $form.serialize();
		//console.log($form.serialize());
		/*$request = $.ajax({
			url: "send_messege_function.php",
			type:POST,
			data:$data
			});
			
		$request.done(
		function (response, textStatus, jqXHR)
		{
        // log a message to the console
        console.log(response);
		});*/
		
		$.post("send_messege_function.php",$data,function(res){
			//console.log(res);
			//alert(res);
			if(res == "SUCESS")
			{
				//ok
			}
			else if(res == "FAIL")
			{
				//error 
			}
			else 
			{
				//unknown
			}
			});
	
		//prevent sending the form 
		e.preventDefault();
	});	
</script>