<?php
include("Auth.php");

//echo "Hi form here";
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
	<script>
	
	//this gabage code for time snipper 
	$.widget( "ui.timespinner", $.ui.spinner,
	 {
		options:
		 {
			// seconds
			step: 60 * 1000,
			// hours
			page: 60,
		
		},

		_parse: function( value )
		 {
			if ( typeof value === "string" ) 
			{
				// already a timestamp
				if ( Number( value ) == value ) 
				{
					return Number( value );
				}
				return +Globalize.parseDate( value );
			}
			return value;
		},

		_format: function( value ) {
			return Globalize.format( new Date(value), "t" );
		}
	});

	$(function()
	 {
		$( "#time" ).timespinner();
	});
	</script>
    
<div class=row>
<div class="span3">

</div>

<div class="span6">

<h1 align="center">Request Trip Form </h1>

<hr>
    <!--content is gonna be here -->
    <form  id="request_trip_form">
    
    <div class="span6">
        <div class="span1">
        	<span>From</span>
        </div>
        
        <div class="span4">
        <select name=from>
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
        <select name=to>
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
        	 Time
        </div>
        
        <div class="span4">
        <!--
        <input id="time" name="time" value="08:30 PM"style="height:25px;width:190px" required >
    -->
          <span>H:</span><input type="number" name="hours" style="width:32px;height:20px" min="1" max="12" value="12">
          <span>M:</span><input type="number" name="minits" style="width:32px;height:20px" min="00" max="59" value="0">
            <select name="AM_PM" style="height:30px;width:90px;">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
            </select>	
        </div>
    </div>
    <div class=span6 style="height:10px;"></div>
    
     <div class="span6">
        <div class="span1">
        	Date 
        </div>
        
        <div class="span4">
        
    
       	<input type="date" name="date" required>
        </div>
    </div>
     
    <div class="span6">
        <div class="span1">
        Is Smoking
        </div>
        
        <div class="span4">
        <select name="is_somking">
        <option value="yes">Yes</option>
        <option value="no">No</option>
        </select>
        </div>
    </div>
     
    <div class="span6">
        <div class="span1">
        Number of luggage
        </div>
        
        <div class="span4">
        <input type="number" name="number_of_laggage" min="0" value="0" required>
        </div>
    </div>
     
    <div class="span6">
        <div class="span1">
        Comments
        </div>
        
        <div class="span4">
        	<textarea name="comments">
            
            </textarea>
        </div>
    </div>
    
    <div class="span6">
    
    <div class="span2"></div>
    <div class="span2"><input type="submit" value="Post Trip" class="btn btn-primary"></div>
    <div class="span2"></div>
    
    </div>
    
    </form>    
</div>

<div class="span3">

</div>

</div>

<script>
//this function is gonna validate all elements in the form 
//you should show error messege of all errors, error messege should be the bootstrap error messege, see bootstrap.

$("#request_trip_form").submit(
	function(event)
	{
		//get the form data
		var $data = $("#request_trip_form").serialize();
		//you have to validate all data 
		
		$.post("add_requested_trip.php",$data,
		function(response)
		{
			$("#page-body").html(response);
		});
		
		event.preventDefault();
	}
);
</script>