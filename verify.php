<?php
session_start();
  require_once('recaptchalib.php');
  $privatekey = "6LfaJcYUAAAAAI8UIeRZKN1b8O7CQZHulN-DkHFn";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
  } else {
      require_once "configuration.php";


// Variables used for the password and usernames
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$uppercase = preg_match('@[A-Z]@', $password);

// This code processes the data when the sign up button is clicked

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // this code validates the username entered
    if(empty(trim($_POST["username"]))){
        $username_err = "You have not entered your username correctly";
    }
        
        else{ 
            //selects information from the prexisiting database ( ON gearhost )
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if ($stmt = mysqli_prepare($link, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                
                // setting the params
                $param_username = trim($_POST["username"]);
                // executing hte statement
                
                if (mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt)== 1){
                        $username_err = "This name is already taken";     
                    }
                    else {
                        $username = trim($_POST["username"]);
                    }  
                }
                else{
                    echo "Error, please try again";
                }
                
            }
            mysqli_stmt_close($stmt);
        }
    if (empty(trim($_POST["password"]))){
        $password_err = "Enter a password";
    }
    elseif(strlen(trim($_POST["password"]))<8){
        $password_err = "Password needs to be 8 characters or longer";
        
    }
    else{
        $password = trim($_POST["password"]);
    }
    // this piece of the code is for validating the password it checks if the password field is empty and also checks if the confirm password field matches the password field
    if (empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirm your password";
    }
    else {
        $confirm_password = trim($_POST ["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "password did not match";
        }
    }
    
    // this checks the code before inserting it into the database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        //insert statement inserting the info into the database
        $sql = "INSERT INTO users (username, password) VALUES (?,?)";
        if ($stmt = mysqli_prepare($link, $sql)){
            // bind variables are params
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // setting the params
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            // hashes the password
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
                
            }
            else {
                echo "something went wrong, try again";
            }
        }
        mysqli_close($link);
        
    }
    
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    // Your code here to handle a successful verification
  }
  
// if the user is already logged in this will redirect them to the Services page
if(isset($_SESSION["online"]) && $_SESSION["online"] == true){
    header("location: index.php");
    exit;
}

?>

