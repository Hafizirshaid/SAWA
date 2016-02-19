<?php
include("Auth.php");

?>

<div class=row>
<div class="span3">

</div>

<div class="span6">

<h1 align="center">Offer Trip Form </h1>

<hr>
    
    <form  id="offered_trip_form" method="GET">
		<div class="span6">
        	<div class="span1">
            	<span>From</span>
            </div>
            <div class="span4">
                 <select name="from" id="from">
        	<?php
			include_once("Model/cities.php");
				$cities = new cities();
				$cities_array = $cities->get_all_cities();
				
				foreach($cities_array as $city)
				{
					echo "<option value=$city>$city</option>";	
				}
			
			?>
            </select>
            </div>
        </div>    
    
    	<div class="span6">
        	<div class="span1">
            	<span>To</span>
            </div>
            <div class="span4">
                <select name=to id="to">
        	<?php
			include_once("Model/cities.php");
				$cities = new cities();
				$cities_array = $cities->get_all_cities();
				
				foreach($cities_array as $city)
				{
					echo "<option value=$city>$city</option>";	
				}
			
			?>
            </select>
            </div>
        </div>    
    	
        <div class="span6">
        	<div class="span1">
            	<span>Date</span>
            </div>
            <div class="span4">
                <input type="date" name="tripDate" id="tripDate" required>
            </div>
        </div>    
    	
		 <div class="span6">
        	<div class="span1">
            	<span>Time</span>
            </div>
            <div class="span4">
                <input type="time" name="tripTime" id="tripTime" min="00" max="23" value="12:15:00" required>
            </div>
        </div>  
		
		<div class="span6">
        	<div class="span1">
            	<span>Car Type</span>
            </div>
            <div class="span4">
                <input type="text" name="car_type" required>
            </div>
        </div>   
		
        <div class="span6">
        	<div class="span1">
            	<span>Car Model</span>
            </div>
            <div class="span4">
                <input type="number" value="2000" min="1990" name="car_model" required>
            </div>
        </div>    
    	
        <div class="span6">
        	<div class="span1">
            	<span>Smoking</span>
            </div>
            <div class="span4">
               	<select name="smoking">
                	<option value="yes">Yes</option>
                    <option value="no">No</option>
                    
                </select>
            </div>
        </div>    
    	
        
        <div class="span6">
        	<div class="span1">
            	<span>Car Speed</span>
            </div>
            <div class="span4">
                <input type="number" value="50" name="car_speed" required>
				<span class="input-group-addon">km/h</span>
            </div>
        </div>    
        
        <div class="span6">
        	<div class="input-group">
			<div class="span1">
			<span class="input-group-addon">Trip cost</span>
			</div>
			<div class="span4">
			<input type="number" name="tripCost"value="5" class="form-control">
			<span class="input-group-addon">$</span>
			</div>
</div>
        </div>    
    	
        <div class="span6">
        	<div class="span1">
            	<span>Luggage</span>
            </div>
            <div class="span4">
                <input type="text" name="car_luggage" required>
            </div>
        </div>    
        
        
		<div class="span6">
        	<div class="span1">
            	<span># of available seats</span>
            </div>
            <div class="span4">
                <input type="number" value="3" name="seats" required>
            </div>
        </div>   
		
        <div class="span6">
        	<div class="span1">
            	<span>Comments</span>
            </div>
            <div class="span4">
                <textarea name="comments">
                
                </textarea>
            </div>
        </div>    
    	
        <div class="span6">
        	<input class="btn btn-large btn-primary" type="submit" value="Post Trip">
        </div>
    	
    </form>
</div>

<div class="span3">

</div>

</div>

<script>
$("#offered_trip_form").submit(
function(event)
{
	$("#page-body").load("add_offered_trip.php", $("#offered_trip_form").serialize());
	
    event.preventDefault();	
}
);

</script>