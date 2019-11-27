<?php
session_start();
/* Php code dealing with all user actions;*/
require_once 'meekrodb.2.3.class.php';
require_once 'AfricasTalkingGateway.php';
DB::$user = 'root';
DB::$password = 'Korir9993';
DB::$dbName = 'my_app';

//handle errors;
DB::$error_handler=false;
DB::$throw_exception_on_error=true;

class CompanyOperations {
    public function registerUser($fname,$lname,$phone,$username,$password) {
        $response="";
        $hashed_password=md5($password);
        try{
            $number=$this->userNameExists($username);
            if ($number==1){
                $response="Username has been Taken.Try another username.Thank you";
            }
            elseif ($number==0){
                DB::insert('users',array('fname'=>$fname,'lname'=>$lname,'phone'=>$phone,'username'=>$username,'password'=>$hashed_password));
                $response="You have been successfully Registered.Thank you.";
            }

        }
        catch (MeekroDBException $e){
            $response="There is an error:".$e->getMessage();

        }
        return $response;

        
    }

    public function userNameExists($username){
        $number=0;
        try{
            DB::query("SELECT username FROM users WHERE username=%s",$username);
            $number=DB::count();
        }
        catch (MeekroDBException $exception){
            echo 'Exception '.$exception->getMessage();
        }
        return $number;
    }

    //This is the function to login the user In;

    public function loginUser($username,$password){
        $response="";
        $status=false;
        $hashed_password=md5($password);
        $account=DB::queryRaw("SELECT * FROM users WHERE username=%s AND password=%s",$username,$hashed_password);
        $row=$account->fetch_assoc();
        $records_returned=DB::count();

        if($records_returned==1){
            $_SESSION['phone']=$row['phone'];
            $_SESSION['username']=$row['username'];


            header("location:my_profile.php");
            $status=true;
            exit();
        }
        else{
            $response="You have Supplied Wrong Login Credentials.Try again with Correct Value";

        }
        return $response;
    }


    //Register Yoour Items;
    public  function registerItems($username,$category,$regNumber,$description){
        $response="";
        try{
            $number=$this->isItemRegistered($regNumber);
            if ($number==1){
                $response="The Item Has been Registered .Check your Registered Items";
            }
            elseif ($number==0) {
                DB::insert('items', array('owner_username' => $username, 'registration_number' => $regNumber, 'item_category' => $category, 'description' => $description));
                $response = "Item Registered Successfully";
            }

        }
        catch (MeekroDBException $exception){
            echo 'Exception '.$exception->getMessage();
        }
        return $response;
    }

    //Check if the item is registered;
    public function isItemRegistered($registration_number){
        $number=0;
        try{
            DB::query("SELECT registration_number FROM items WHERE registration_number=%s",$registration_number);
            $number=DB::count();
        }
        catch (MeekroDBException $exception){
            echo 'Exception '.$exception->getMessage();
        }
        return $number;

    }

    //Get List of your Registered Items;
    public  function getMyItems($username){
        $myitems= DB::query("SELECT * FROM items WHERE owner_username=%s",$username);
        return $myitems;
    }

    //Save Found Items to the database;
    public function saveFoundItems($registration_number,$finder_phone)
    {
        $response="";
        try {
        DB::insert('found_items', array('registration_number' => $registration_number, 'finder_contact' => $finder_phone));
        if(count($this->getOwnerDetails($registration_number))==1){
            //Send Sms To the Owner;
            $response=$this->sendMessage($finder_phone,$registration_number);
            if($response==true){
                $response = "Item Saved successfully and Owner messaged successfully.Thank you for informing him/her";
            }
            else{
                $response = "The item was saved successfully but there was a problem in messaging the owner";
            }


        }
        else{
            $response = "Item Saved successfully and Owner is not registered on the platform";
        }


        }
    catch (MeekroDBException $exception){
            echo 'Exception '.$exception->getMessage();
        }
        return $response;
    }

    //Get Details of the found item Owner;
public function getOwnerDetails($registration_number){
        $ownerDetails= DB::query("SELECT * FROM users INNER JOIN items ON users.username=items.owner_username WHERE registration_number=%s",$registration_number);
        return $ownerDetails;

}
//Prepare passed phone number;
public function preparePhone($received_phone){
        $returned_phone="";
        $intermediate="";
        if($received_phone[0]==0 and strlen($received_phone)==10 ){
            $returned_phone="+254".ltrim($received_phone,0);
            return $returned_phone;

        }
        else {
            return $received_phone;

        }

}

//Here we sent the message now;
public function sendMessage($founder_phone,$registration_number){
    $response=false;
    // Specify your authentication credentials
    $username   = "kilimoc";
    $apikey     = "2a5d8060389822ecb580c3104b718dd430fb7eb7d064b48b7587e1a8afb26f60";

    //Get owner Details;
    $ownerDet=$this->getOwnerDetails($registration_number);
    $phone="";
    $name="";
    $registration="";
    $category="";
    foreach ($ownerDet as $column) {
        $phone=$column['phone'];
        $name=$column['fname']." " .$column['lname'];
        $registration=$column['registration_number'];
        $category=$column['item_category'];

    }
    $recepient=$this->preparePhone($phone);

    $message_to_owner="GOODNEWS ".$name.". You lost your ".$category." Item with the following registration number ".$registration." and was found.  Call ".$founder_phone. " to confirm.";
            //modify number;
    //$preparednumber=$this->preparePhone($phone);
            // Create a new instance of our awesome gateway class
    $gateway    = new AfricasTalkingGateway($username, $apikey);
    try
            {

                $results = $gateway->sendMessage($recepient, $message_to_owner);

                $response=true;
            }
            catch ( AfricasTalkingGatewayException $e )
            {
                $response= false;
            }
            return $response;

        }
        /*Get the contact if a founder
        applied in case someone has posted a lost item and it was found;
        */
   public function getFounderPhone($registration_number){
        $details=DB::query("SELECT * FROM found_items WHERE registration_number=%s LIMIT 1",$registration_number);
        $number=DB::count();
        $results=array($number=>$details);
        return $results;
        }

        //Save the lost Item and inform the owner about the details of the founder;

    public function sendMessageIfExists($item_registration,$myphone){
            $response="";
            $results=$this->getFounderPhone($item_registration);
        $number=0;
        $phone="";
        $date_found="";
        foreach($results as $x=>$columns)
        {
            $number=intval($x);
            foreach ($columns as $column){
                $phone=$column['founder_contact'];
                $date_found=$column['founder_contact'];
            }

        }
       //Check Rows Returned;
        if ($number==1){
            //Save to database
            $responseFromSaving=$this->saveLostItem($item_registration,$myphone);
            //Send details of the founder to the owner;
            $recipient=$this->preparePhone($myphone);
            $message="GOODNEWS. You lost an item and was found by ".$phone." on ".$date_found;
            $result_from_api=$this->sendMessageMulti($recipient,$message);
            if ($result_from_api==true){
                $response=$responseFromSaving."You have been messaged the details of the owner";
            }
            else{
                $response=$responseFromSaving." .The system experienced a problem in texting you the founder details";

            }

        }
        //Save it in the database;
        else{
            $response=$this->saveLostItem($item_registration,$myphone);
        }
        return $response;

    }

    //save to database;
    public function saveLostItem($registration_number,$owner_phone){
            $response="";
            try{
            DB::insert('lost_items',array('registration_number'=>$registration_number,'owner_contact'=>$owner_phone));
            $response="Item Saved Successfully.Thank you for posting";
            }
            catch (MeekroDBException $exception){
                $response="There was an error saving data".$exception->getMessage();
            }
            return $response;

    }
    public function saveUpdateLostItem($registration_number,$owner_phone){
        $response="";
       $number=$this->checkExistenceofLostItem($registration_number);
       //Update;
        if($number ==1) {
            DB::update('lost_items', array(
                'owner_contact' =>$owner_phone
            ), "registration_number=%s", $registration_number);
            //Let us get the finder contact if item has been found;
            $data=$this->getFinderContact($registration_number);
            if(count($data)==1){
                //Here it means it has been found;
                //Give details of the owner;
                $phone="";
                foreach ($data as $row){
                    $phone=$row['finder_contact'];
                }
                $response="You Item was saved successfully.YOUR ITEM WAS FOUND.Contact:".$phone;
            }
            else{
                $response="Your Item has not been posted on our site .We haved saved it successfully";
            }

        }
       //Save;
       else if($number==0){
           DB::insert('lost_items',array('registration_number'=>$registration_number,'owner_contact'=>$owner_phone));
           $response="Item Saved Successfully.Thank you for posting";
       }
        return $response;

    }
    public function checkExistenceofLostItem($registration_number){
       DB::query("SELECT registration_number FROM lost_items WHERE registration_number=%s",$registration_number);
       $counter=DB::count();
       return $counter;
    }
    //check finder details in order to sent an sms to the person who losed the item;
    public function getFinderContact($registration_number){
        $data=DB::query("SELECT * FROM found_items WHERE registration_number=%s",$registration_number);
        return $data;
    }

    //Function to send the message to either the loser or the owner of the item;
    public function sendMessageMulti($recipient,$message){
         $response=false;
        // Specify your authentication credentials
        $username   = "kilimoc";
        $apikey     = "2a5d8060389822ecb580c3104b718dd430fb7eb7d064b48b7587e1a8afb26f60";

        //Get owner Details;
        //$ownerDet=$this->getOwnerDetails($registration_number);
        $message="";
        $phone="";
        $name="";
        $registration="";
        $category="";       // $message="GOODNEWS ".$name.". You lost your ".$category." Item with the following registration number ".$registration." and " .$founder_phone."  found it.Call to confirm.";
        //modify number;
        //$preparednumber=$this->preparePhone($phone);
        // Create a new instance of our awesome gateway class
        $gateway    = new AfricasTalkingGateway($username, $apikey);
        try
        {

            $results = $gateway->sendMessage($recipient, $message);
            $response=true;
        }
        catch ( AfricasTalkingGatewayException $e )
        {
            $response= false;
        }
        return $response;

    }


    public function handleUSSD($number){
         $response="";
           $results=DB::query("SELECT * FROM found_items WHERE registration_number=%s",$number);
           $count=DB::count();
           if($count>=1){
               foreach ($results as $result){
                   $id=$result['registration_number'];
                   $contact=$result['finder_contact'];
               };
               $response="Item Registration Number:".$id."\n Found By:".$contact;

           }
           else {
               $response="Your Item has not been Posted yet.Keep checking";

           }
           return $response;
    }
    //Get all found Items
    public function getFoundItems(){
       $results=DB::query("SELECT DISTINCT registration_number,finder_contact FROM found_items");
       return $results;

    }





   
}
?>




