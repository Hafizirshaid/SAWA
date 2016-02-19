/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 8, 2013
 */
 
//this function used to remove the placeholder on the navigation bar div 
function remove_class_from_nav()
{
	$("#_home").removeClass("active");
	$("#_signin").removeClass("active");
	$("#_downloads").removeClass("active");
	$("#_services").removeClass("active");
	$("#_about").removeClass("active");
	$("#_contact").removeClass("active");
	$("#_statistics").removeClass("active");
		
}

//here is the code that load the pages in  page content div when user click on the navigator icon
//onready function to load the page when the main page is ready
$(document).ready(function(e) 
{
	//load the mainpage.php at first time 
	$("#page-body").load("mainPage.php");
	$("#_home").addClass("active" ); 
	//when user click on any of the nav icons the content must change 
	
	//clicking on sign up button in sing in page 
	$("#signup").click(function()
	{
		$("#page-body").load("signup.php");
	});
		

	//clicking on messege link
	$("#messeges").click(function()
	{
		$("#page-body").load("messeges.php");
	});	
	
	//clicking on Statisitics 
	$("#statistics").click(function()
	{
		remove_class_from_nav();
		$("#_statistics").addClass("active" ); 
		$("#page-body").load("statistics.php");
	});

		
	//clicking on Home
	$("#home").click(function()
	{
		remove_class_from_nav();
		$("#_home").addClass("active" ); 
		$("#page-body").load("mainPage.php");
	});
	
	//clicking on sign in
	$("#signin").click(function()
	{
		remove_class_from_nav();
		$("#_signin").addClass("active" ); 
		$("#page-body").load("signin.php");
	});
	
	//clicking on downloads
	$("#downloads").click(function()
	{
		remove_class_from_nav();
		$("#_downloads").addClass("active" ); 
		$("#page-body").load("downloads.php");
	});
	
	//clicking on services
	$("#services").click(function()
	{
		remove_class_from_nav();
		$("#_services").addClass("active" ); 
		$("#page-body").load("services.php");
	});
	
	//clicking on about
	$("#about").click(function()
	{
		remove_class_from_nav();
		$("#_about").addClass("active" ); 
		$("#page-body").load("about.php");
	});
	
	//clicking on contact
	$("#contact").click(function()
	{
		remove_class_from_nav();
		$("#_contact").addClass("active" ); 
		$("#page-body").load("contact.php");
	});

});