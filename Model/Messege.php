<?php

/*
 * This code written by Hafiz K.Irshaid 
 * Email : hkmmi.2010@gmail.com
 * Najah National University 
 * Computer Engineering Department
 * Date :  Oct 6, 2013
 */

/**
 * Description of Messege
 *  
 * @author Hafiz
 */
class Messege 
{
    //put your code here
    protected $messege_id;
    protected $sender_id;
    protected $receiver_id;
    protected $title;
    protected $body;
    protected $messege_date;
	protected $is_read;
    protected $database_conn;
    
    /**
     * @todo init the database conncection
	 **/
    public function __construct() 
    {
       //Include database connection file and get the connection reference.
        include_once ("/../Database_connection.php");
        $database = new Databse_connection();
        $this->database_conn = $database->return_database_conncection();
    }
    
	public function isread()
	{
		return $this->is_read;	
	}
	
	public function get_number_of_unread_messeges($userid)
	{
		$query = "select COUNT(*) from messeges where receiver_id=$userid and is_read='no'";
		$result = $this->database_conn->query($query);
		$num = $result->fetch_array(MYSQLI_NUM);
		return $num[0];
		//return result;
	}
	
    /**
     * this function set the sender id 
     * @todo 
     */
    public function set_sender($senderId)
    {
        $this->sender_id = $senderId;   
    }
	
    /**
     * this function insert the messege in messege table in the database
     */
    public function send_messege()
    {
        //$this->receiver_id = $receiverID;
		
		$query = "insert into messeges values(0,$this->sender_id,$this->receiver_id,'no','$this->title','$this->body'
				 ,'$this->messege_date')";
		$result = $this->database_conn->query($query);
		
		if(isset($result))
		{
			//ok
			return true;
		}
		else
		{
			//error in sending 
			return false;
		}
    }
			
	public function initMessege($title, $body, $receiver)
	{
		$this->title = $title;
		$this->body = $body;
		$this->receiver_id = $receiver;
		$this->messege_date = date('Y-m-d h:i:s');
	}
		
	
	//get all messeges sent by this user
	public function get_user_sent_messeges($userid)
	{
		$query = "select * from messeges where sender_ID=$userid ORDER BY messege_date desc";
		
		$result = $this->database_conn->query($query);
		
		return $result;
	}
	
	//get all messeges received by this user
    public function get_user_received_messeges($userid)
	{
		
		$query = "SELECT * FROM  messeges WHERE receiver_ID =$userid ORDER BY messege_date desc";
		
		$result = $this->database_conn->query($query);
		//print_r($result);
		return $result;
	}
	
	
	//this fucnton return messege body by id 
	public function get_messege_body_by_messege_id($id)
	{
		$query = "SELECT body FROM  messeges WHERE Messege_ID =$id";
		$result = $this->database_conn->query($query);
		$body = $result->fetch_assoc();	
		return $body['body'];
	}
	
    /**
     * destructor
     */
    public function __destruct() 
    {
        
    }
}

?>