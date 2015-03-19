<?php

  require("config.inc.php");

  if (!empty($_POST)) {

      if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['phone']) || empty($_POST['lname']) || empty($_POST['fname'])|| !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      
     
        $response["success"] = 0;

        $response["message"] = "Oops!,it looks you have enterd an invalide email address or username or password.";

         die(json_encode($response));
        
     }
     $query        = " SELECT 1 FROM parliament_users WHERE username = :user";

     //now lets update what :user should be

     $query_params = array(

        ':user' => $_POST['username']

    );

    try {

        // These two statements run the query against your database table. 

        $stmt   = $db->prepare($query);

        $result = $stmt->execute($query_params);

    }
     catch (PDOException $ex) {

        // Note: On a production website, you should not output $ex->getMessage(). 

        // It may provide an attacker with helpful information about your code.  

        die("Failed to run query: " . $ex->getMessage());



                //You eventually want to comment out the above die and use this one:

                $response["success"] = 0;

                $response["message"] = "Database Error. Please Try Again!";

                die(json_encode($response));

     }
     $row = $stmt->fetch();

     if ($row) {

        die("This username is already in use");

                //You could comment out the above die and use this one:

                $response["success"] = 0;

                $response["message"] = "I'm sorry, this username is already in use";

                die(json_encode($response));

    }
    $query = "INSERT INTO parliament_users(fname,lname,email,password,username,phone,user_type ) VALUES ( :fname, :lname, :email,md5(:pass),:user,:phone,:user_type)";



    //Again, we need to update our tokens with the actual data:

     $query_params = array(

        ':user' =>   $_POST['username'],

        ':pass' =>   $_POST['password'],

        ':phone' =>  $_POST['phone'],

        ':lname' =>  $_POST['lname'],
 
        ':fname' =>  $_POST['fname'],

        ':email' =>  $_POST['email'],

        ':user_type' => 'Admin'

    );

    //time to run our query, and create the user

    try {

        $stmt   = $db->prepare($query);

        $result = $stmt->execute($query_params);

    }

    catch (PDOException $ex) {

        // Again, don't display $ex->getMessage() when you go live. 

        die("Failed to run query: " . $ex->getMessage());

                //You could comment out the above die and use this one:

                $response["success"] = 0;

                $response["message"] = "Database Error. Please Try Again!";

                die(json_encode($response));

    }

        $response["success"] = 1;

        $response["message"] = "Username Successfully Added!";

        echo json_encode($response);
  }

?>
