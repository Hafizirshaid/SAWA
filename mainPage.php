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

?>

    <!--   page contents   -->

        <div class="careosel-search">

            <!--   upper contents contain caresoul and search bar  -->
            <div class="row" id="upper-contents">
            	<?php

            	if(!isset($_SESSION['user_id']))
            	{


            	?>
                <!--   start of carousel -->
                <div class="span9" id="mycarsol">
                    <!--carousel implementation -->
                    <div id="myCarousel" class="carousel slide">
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="active item">
                                <img src="img/mainimage.jpg" width="870px" height="340px">
                                <div class="carousel-caption" style="color:#FFF">
                                
                                    this is example of caption image 1
                                </div>

                            </div>

                            <div class="item">
                                <img src="img/img2.jpg" width="870px" height="340px">
                                <div class="carousel-caption" style="color:#FFF">
                                    this is example of caption image 2
                                </div>

                            </div>

                            <div class="item">
                                <img src="img/img3.jpg" width="870px"  height="340px">
                                <div class="carousel-caption" style="color:#FFF">
                                    this is example of caption image 3
                                </div>

                            </div>

                            <div class="item">
                                <div style="height:340px">
                                    sirghsaiuhgiuahug
                                </div>
                                <div class="carousel-caption" style="color:#FFF">
                                    this is example of caption image 2
                                </div>

                            </div>
                        </div>
                        <!-- Carousel nav -->
                        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                    </div>
                    <!--   end of carousel -->



                    <!-- start of search bar-->
                </div>

                <?php
                	}
                	else 
                	{
                ?>
					<div class="span9">
					<?php
						include("last_trips.php");
					?>
					</div>
                <?php
                	}
                ?>

                <?php
			  if(isset($_SESSION['user_id']))
			  {
			  ?>
                  <div class="span3">
                    <a id="offer_trip" class="btn btn-primary btn-large" href="#">Offer Trip</a>
                    <a id="request_trip" class="btn btn-primary btn-large" href="#">Request Trip</a>
                                      <div class="span3" style="height:10px" ></div>

                     <!--
                    <a id="trip_state" class="btn btn-primary" href="#">My Trips State</a>
                    -->
                    </div>
                <?php
				}   
                ?>
                   
                <div class="span3" id="search-bar">

                <div class="span3">
                <div><h3>
                	Search a Trip
                </h3>
                <hr>
                </div>
                    <form class="navbar-search pull-left" id="search_form">
                    <div>
						<div class=""span1>From</div>
              <select name="from">
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
                    
            <div>
		    <div class=""span1>To</div>
            <select name="to">
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
                    
                    <div>
						<div class=""span1>Date</div>
                        <input type="date" name="date" required>
                    </div>
                    
                    <div>
                    <label>Time</label>
                        <input id="time" name="time" value="08:30 PM"style="height:25px;width:190px" required >		
                        </div>
                    
                    <div class="clear">
                    
                    </div>
                    <div class=span3 style="height:10px"></div>
                    
                        <div class="span1">
                    
                       	<input type="submit" class="btn" value="Search">
                       </div> 			
                       
                    </form>
                  </div>
                  
                  <div class="span3" style="height:10px" ></div>
              
                </div>
                <!-- end of search bar-->

            </div>
            <!--  end of row  upper contents contain caresoul and search bar  -->

        </div>

        <hr>

        <div class="row-fluid">

            <div class="span4">
                <h2>Last News</h2>
                <marquee  behavior="scroll" scrollamount="5" direction="up" onmouseover="this.stop()" onmouseout="this.start()">
				<ul>
				<li><a href="#">Checkpoint in Nablus-Ramallah Road.</a></li>
				<li><a href="#">Accident in Hebron-Bethlehem</a></li>
				<li><a href="#">Road closed due to maintenance</a></li>
				<li><a href="#">Something else here</a></li>
				<li><a href="#">Separated link</a></li>
				</ul>
				</marquee>
            </div>
		
			<div class="span4">
                <h2>Last Trips</h2>
                <marquee  behavior="slide" scrollamount="3" direction="left" onmouseover="this.stop()" onmouseout="this.start()">
				<ul>
				<li><a href="#">Nablus -> Ramallah</a></li>
				<li><a href="#">Hebron -> Bethlehem</a></li>
				<li><a href="#">Gaza   -> Jerusalem</a></li>
				<li><a href="#">Something else here</a></li>
				<li><a href="#">Separated link<?php $date_array = getdate(); $min = $date_array['minutes']; $hour = $date_array['hours']; echo $hour.":".$min;?></a></li>
				</ul>
				</marquee>
            </div>
            
			<div class="span4">
                <h2>Weather</h2><!--http://www.freecurrencyrates.com/get-widget--><!--Currency Widget-->
				<div id="cont_65f5b457a4940a814e583e1a6490c161">
				  <span id="h_65f5b457a4940a814e583e1a6490c161">Weather <a id="a_65f5b457a4940a814e583e1a6490c161" href="http://www.theweather.com/jerusalem.htm" target="_blank" style="color:#656565;font-family:Sans-serif;font-size:14px;">Jerusalem</a></span>
				  <script type="text/javascript" src="http://www.theweather.com/wid_loader/65f5b457a4940a814e583e1a6490c161"></script>
				</div>
				
            </div>

            
        </div>
        
        <!-- end of contents -->
        
        <script>
		//events handllers for some of the buttons and links in this page 
		
		//clicking on trip state
		$("#trip_state").click(function(e)
	    {
            $("#page-body").load("trip_state.php");
        });
		
		//clicking on request trip 
		$("#request_trip").click(function()
		{
			$("#page-body").load("RequestTrip.php");
		});
		
		//clicking on offer trips 
		$("#offer_trip").click(function()
		{
			$("#page-body").load("OfferTrip.php");
		});
		
		//@todo implement this event
		$("#search_form").submit(
			function(event)
			{
				var $form = $("#search_form");

				//print on console the data from the form 
				//console.log($form.serialize());
				
				$("#page-body").load("search_trip.php",$form.serialize());
				//let this function to get the result and load a page that contain the result or
				//let the loaded page to get the result 
				//just pass search form param to the loaded page and its responsipility to show the results 
				
				//prevent the form to move to the action page 
				event.preventDefault();
			});
		</script>
        
	<script>
	
	//this code for time snipper from jquery UI garbage
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

		_format: function( value ) 
		{
			return Globalize.format( new Date(value), "t" );
		}
	});

	$(function() 
	{
		$( "#time" ).timespinner();
	});
	</script>