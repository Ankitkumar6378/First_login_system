<?php
$message = '';
require_once "db_con2.php";
//<---------------MAIN--------------->//
if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);
    $length_user= strlen($_POST['username']);
    $length_pass= strlen($_POST['password']);


// <-------------USERNAME AND PASSWORD CAN NOT BE BLANK------------->

	if (empty($uname)) {
		 header("Location: index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: index.php?error=Password is required");
	    exit();
    }




//<--------------USERNAME VALIDATION LOGIC--------------------------->


    elseif($length_user<5 || $length_user>20){
    header("Location: index.php?error=User Name Must be Greater Then 7 and less than 20 ");  
    exit();
    } 
  
    elseif (!preg_match("/[A-Z]/", $uname)) {
        header("Location: index.php?error= Username should contain at least one Capital ");  
        exit();
    }
    elseif (!preg_match("/[a-z]/", $uname)) {
        header("Location: index.php?error= Username should contain at least one lower ");  
        exit();
    }
    elseif (!preg_match("/\W/", $uname)) {
        header("Location: index.php?error=Username should contain at least one Special Character ");  
        exit();
    }
    elseif (!preg_match("/^[^#@$%&*()].*/", $uname)) {
        header("Location: index.php?error= Special Characters are not allowed at Begining ");  
        exit();
    }
    elseif (!preg_match("/^\S+(?: \S+)*$/", $uname)) {
        header("Location: index.php?error= Space are not allowed at Begining ");  
        exit();
    }




   
    
//<---------------PASSWORD VALIDATION LOGIC---------------------------->
    
    elseif($length_pass<5 || $length_pass>20){
    header("Location: index.php?error=Password Must be Greater Then 5 and less than 20 ");  
    exit();
    }
    elseif (!preg_match("/\d/", $pass)) {
        header("Location: index.php?error=Password should contain at least one digit ");  
        exit();
    }
    elseif (!preg_match("/[A-Z]/", $pass)) {
        header("Location: index.php?error=Password should contain at least one Capital ");  
        exit();
    }
    elseif (!preg_match("/[a-z]/", $pass)) {
        header("Location: index.php?error=Password should contain at least one Small ");  
        exit();
    }
    elseif (!preg_match("/\W/", $pass)) {
        header("Location: index.php?error=Username should contain at least one Special Character ");  
        exit();
    }
   
   




    
   //<------------FOR DATA CANNOT BE DUBLICATE-------------->              
    
   else {
       include 'check_data.php';
   }









//<----- If there were no errors, go ahead and insert into the database------>

if(empty($username_err) && empty($password_err) )
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $uname;
        $param_password = $pass;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            //$reg = true;
            $message = "Registration Completed Successfully";
            
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}