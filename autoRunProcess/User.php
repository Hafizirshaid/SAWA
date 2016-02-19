<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 2, 2013
 */


/**
 * Description of User 
 *  user class contain all information that require to insert the user in the 
 *  database, and contain all information about this user;
 * @author Hafiz
 */
 
class User 
{
    protected $user_id;
    protected $username;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $mobile_number;
    protected $gender;
    protected $registration_date;
    protected $birthdate;
    protected $password;
    protected $personal_image;
    public $database_connection;
    
   /**
    * constructor only initialise database
    * 
    * */
    public function __construct()
    {
      
        //include database connection file and get the connection reference.
        include_once ("/../Database_connection.php");
        $database = new Databse_connection();
        $this->database_connection = $database->return_database_conncection();
		//echo $this->database_connection;
		
    }
    
    /**
     * @todo implement this function
     * this function has to save the result of changing of attrebutes in database
     */
    public function commit()
    {
        $query = "update users set where user_id=".$this->user_id;
        
        $this->database_connection -> query($query);
    }
    
    /**
     * this function do such and such
     */
    public function initWithData($firstname, $lastname, $username, $email, $mobileNumber,
            $gender,$birthdate, $password, $personal_image)
    {
		
	
        $this->username = $username;
        //store all functions arguents in the class 
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->mobile_number = $mobileNumber;
        $this->gender = $gender;
        $this->birthdate = $birthdate;
		
		//password must encrepted
        $this->password = md5($password);
        $this->personal_image = $personal_image;
        
        //insert to database	
        $res = $this->insert_user_into_database();
        if($res)
        {
            return true;
		}
		else
        {
            return false;
		}
    }
    
    /**
     * 
     * @author Hafiz K.Irshaid <hkmmi.2010@gmail.com>
     * 
     * this function insert all class attiputes in table users 
     */
    private function insert_user_into_database()
    {
		echo "<br>";
		echo $this->password;
				echo "<br>";
		//echo md5($this->password);
		echo "<br>";
        //current date is the registration date
		$date = date('Y-m-d h:i:s');
		
        $this->registration_date = $date;
        
        //query to insert this user in the database
        $query = "insert into users values (
		0,
		'".$this->username.       "',
		'".$this->firstname.      "',
		'".$this->lastname.		  "',
		'".$this->email.		  "',
		'". $this->mobile_number. "',
	    '".$this->gender.		  "',
		'".$this->registration_date ."',
        '".$this->birthdate.	  "',
		'".$this->password.		  "',
	    '".$this->personal_image. "'
				 )";
        
        //execute the query 
        $result = $this-> database_connection -> query($query);
        
        if($result)
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
    
    /**
     * @todo implement the query and return value 
     * this function should return  user that have the given id
     */
    public function get_user_by_id($id)
    {
        
        //write query
        $query = "select * from users where user_id=".$id;
       // echo $query;
        $result = $this->database_connection->query($query);
		$row = $result->fetch_assoc();
  
		return $row;
        //here you have to store the result in the member variables
    }
    
    /**
     * this function should return array of users that have the given name
     * @todo implement the query and return value
     */
    public function get_users_by_username($name)
    {
        
        //write query
        $query = "select * from users where username='".$name."'";
        
        $result = $this->database_connection -> query($query);
        if($result)
		{
         	$row = $result->fetch_assoc();
		}
         //here you have to store the result in the member variables
		 
		//$this->password = $row['password'];
		
		return $row;
    }
    
	
    /**
     * 
     * i wanna implement all setters and getters 
     * note that in setter you should validate all given parameters 
     * @todo validate all setters 
     */
    
     
    /**
     * setter and getter for user name 
     */
    public function set_username($username)
    {
        $this->username = $username;
    }
    public function get_username()
    {
        return $this->username;
    }
    
    /**
     * setter and getter for first-name 
     */
    public function set_firstname($firstname)
    {
        $this->firstname = $firstname;
    }
    public function get_firstname()
    {
        return $this->firstname;
    }
    
    /**
     * setter and getter for last name
     * 
     */
    public function set_lastname($lastname)
    {
        $this->lastname = $lastname;
    }
    public function get_lastname()
    {
        return $this->lastname;
    }
    
    
    /**
     * setter and getter for email 
     */
    public function set_email($email)
    {
        $this->email = $email;
    }
    public function get_email()
    {
        return $this->email;
    }
    
    /**
     * setter and getter for mobile number
     */
    public function set_mobile_number($mobile_number)
    {
        $this->mobile_number = $mobile_number;
    }
    public function get_mobile_number()
    {
        return $this->mobile_number;
    }
    
    /**
     * setter and getter for gender
     */
    public function set_gender($gender)
    {
         $this->gender = $gender;
    }
    public function get_gender()
    {
        return $this->gender;
    }
    
    /**
     * setter and getter for birth date
     */
    public function set_birthdate($birthdate)
    {
        $this->$birthdate = $birthdate;
    }
    public function get_birthdate()
    {
        return $this->birthdate;
    }
    
    /**
     * setter and getter for password
     */
    public function set_password($password)
    {
        $this->password = $password;
    }
    public function get_password()
    {
        return $this->password;
    }
    
    /**
     * setter and getter for personal image
     */
    public function set_personal_image($image)
    {
        $this->personal_image = $image; 
    }
    public function get_personal_image()
    {
        return $this->personal_image;
    }
    
    
    /**
     * 
     * @todo this function should return all current user messeges
     */
    public function get_user_messeges()
    {
        //please use messege class
    }
    
	public function is_user_exist_by_id($id)
	{
		
	    $query = "select * from users where user_id=".$id."";
    
        $result = $this->database_connection -> query($query);
        if($result)
         	$row = $result->fetch_assoc();
		 if(isset($row))
		 {
			 return $row;
		 }
		 else
		 {
			  return NULL;
		 }
	}
	
	public function is_user_exist_by_username($username)
	{	
		$query = "select * from users where username='".$username."'";	
        $result = $this->database_connection->query($query);
        
		if($result)
		{
         	$row = $result->fetch_assoc();
		}
		 if(isset($row))
		 {
			 return $row;
		 }
		 else
		 {
			  return NULL;
		 }
	}
	
	public function get_all_users_ids()
	{
		
		$query = "SELECT * FROM users";	
		$result = $this->database_connection->query($query);
		//print_r($result);
		//$data = $result->fetch_assoc();
		return $result;
	}
	
	
	/**
	
	this function is gonna get username by the given id 
	**/
	public function get_username_by_id($id)
	{
		$query = "select username from users where user_id=$id";
		$result = $this->database_connection->query($query);
		echo "hjafishvv";
		return $result;
		
	}
	
	
	//this function return a string contain user full name 
	public function get_user_full_name_by_id($id)
	{
		//echo $id;
	    $query = "select * from users where user_id=$id";
		$result = $this->database_connection->query($query);
		//$fullname = $result->fetch_assoc();
		$name = mysqli_fetch_row($result);
		return $name[2]." ".$name[3];
		//return "HAFIZ K.Irshaid";
	}
	
	
	
	public function get_users_mail($id)
    {
 
        $query = "select email from users where user_id=".$id;
        
        $result = $this->database_connection-> query($query);
        if($result){
         $row = $result -> fetch_assoc();
         return $row;}
    }
	
    /**
     * destructor only close the database connection
     */
    public function __destruct()
    {
        //close database connection 
        mysqli_close($this->database_connection);
    }
	
	
}

?>
