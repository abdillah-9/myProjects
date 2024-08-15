<?php
include "transportationDB.php";
session_start();
//inputs validation
   //vars declaration
$useremail = $usernames = $passwords = $Cpasswords = $errEmail = $errUsernames="";
$errPasswords = $errCpasswords = $fname =$errFname= $mname=$errMname="";
$sname = $errSname= $contact= $errContact= $sex= $signUpErr="";
$valid = true;
   //codes when submit button is clicked
if(isset($_POST["sign_up"])){
  //sessions declaration
  $_SESSION['new_user_name'] = $_POST['usernames'];
$_SESSION['new_user_password'] = $_POST['passwords'];

  //validate username
  $usernames = test_input($_POST["usernames"]);
  if(empty($usernames)){
    $errUsernames = "Please fill this field";
    $valid = false;
  }
  else{
    if(!preg_match("/^[a-zA-Z]*$/",$usernames)){
      $errUsernames = "Only letters are allowed";
      $valid = false;
    }
  }
    //validate fname
    $fname = test_input($_POST["fname"]);
    if(empty($fname)){
      $errFname = "Please fill this field";
      $valid = false;
    }
    else{
      if(!preg_match("/^[a-zA-Z]*$/",$fname)){
        $errFname = "Only letters are allowed";
        $valid = false;
      }
    }
      //validate Sir Name
  $sname = test_input($_POST["sname"]);
  if(empty($sname)){
    $errSname = "Please fill this field";
    $valid = false;
  }
  else{
    if(!preg_match("/^[a-zA-Z]*$/",$sname)){
      $errSname = "Only letters are allowed";
      $valid = false;
    }
  }
    //validate mname
    $mname = test_input($_POST["mname"]);
    if(empty($mname)){
      $errMname = "Please fill this field";
      $valid = false;
    }
    else{
      if(!preg_match("/^[a-zA-Z]*$/",$mname)){
        $errMname = "Only letters are allowed";
        $valid = false;
      }
    }

        //validate contact number
    $contact = test_input($_POST["contact"]);
    if(empty($contact)){
      $errContact = "Please fill this field";
      $valid = false;
    }
    else{
      if(!preg_match("/^[0-9]*$/",$contact)){
        $errContact = "Only letters are allowed";
        $valid = false;
      }
    }
  
  //validate user's Email
  $useremail = test_input($_POST["useremail"]);
  if(empty($useremail)){
    $errEmail = "Please fill this field";
    $valid = false;
  }
  else{
    if(!preg_match("/[@]/",$useremail)){
      $errEmail = "Please use proper e-mail format";
      $valid = false;
    }
  }
  //validate passwords
  $passwords = test_input($_POST["passwords"]);
  if(empty($passwords)){
    $errPasswords = "Please fill this field";
    $valid = false;
  }
  else{
    if(!preg_match("/^[a-zA-Z0-9]*$/",$passwords)){
      $errPasswords = "Only letters and numbers are allowed";
      $valid = false;
    }
  }
  //validate Cpassword
  $Cpasswords = test_input($_POST["Cpasswords"]);
  if(empty($Cpasswords)){
    $errCpasswords = "Please fill this field";
    $valid = false;
  }
  else{
    if($Cpasswords != $passwords){
      $errCpasswords = "Cpassword doesn't match password";
      $valid = false;
    }
  }

  //get sex input
  $sex = $_POST["sex"];

  //INSERT DATA INTO DB TABLE FORM IF EVERY USER INPUT IS VALID
  if($valid === true){
     $selected = "SELECT * FROM users WHERE username ='$usernames' AND passwords ='$passwords'";
     $checkSelection = mysqli_query($conn,$selected);
     //Checking if account exists
     if(mysqli_num_rows($checkSelection) > 0){
       $signUpErr = "This Account Exists";
     }
     else{
         $inserting = "INSERT INTO users(username,emails,passwords,first_name,
          middle_name,sir_name,sex,contact_no)
         VALUES('$usernames','$useremail','$passwords',
         '$fname','$mname','$sname','$sex','$contact')";
         $checkInsertion = mysqli_query($conn,$inserting);
         $succ = $_SESSION["succ"] = "true";
         header("Location:signIn.php");
         exit();
    }
  }
}
//test_input function()
function test_input($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="refresh" content="1000000"/>
        <meta name="viewport" content="width = device-width,initial-scale=1.0"/>
        <title>Create New Account</title>
        <style>
*{
    text-decoration: none;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-sizing: border-box;
}
body, html{
  margin:0px;padding:0px;background-color:rgba(220,220,220,0.8);
}          
nav{
  background-color: aliceblue;padding: 1.4vw;
  display: flex; justify-content: flex-start;
  height: 10vh;  
}
nav a{
    color: rgb(43, 39, 39);margin: 0px;
    padding-bottom: 1.5vw;font-size: 2.8vw;
    font-weight: bold;
}
nav a:hover{
    border-bottom: 2px solid rgb(43, 39, 39);
}
.mainSection{
    padding: 0.7rem 1rem;border: 1px solid rgba(0,120,250,0);
    background-image: linear-gradient(-90deg,rgba(255, 0, 0, 0.5), rgba(0, 0, 255, 0.5));
    width:100%;
}
form{
    padding:2vw 5vw;border-radius: 10px;
    width:80%;display: flex;flex-wrap: wrap;
    background-color: aliceblue;
    margin: 5vw auto;
    
}
section{
    width:fit-content;padding:1rem 4rem 1rem 0px;
  }
#pre{
    border-bottom: 1px solid rgb(0,120,250);width: 90%;
    font-size:2.8vw;padding: 10px 0px;
}
b{
    display: block;
}
div{
    border: 1px solid royalblue;background-color:rgba(0,120,200,1);padding: 10px;border-radius: 5px;
    font-size: 14px;color: white;text-align: center;
}
div a{
    display: inline-block;border-radius: 15px;font-weight: bold;border:1px solid white;
    color: white;padding:0.5rem;
}
form span{
    color:red;padding-top: 0.5rem;display: inline-block;
}
form input, form textarea, form select{
    border: 1px solid rgb(140,140,140);height: 40px;padding: 5px 10px;border-radius: 15px;width: 100%;
    margin-top: 1rem;max-width: 16rem;font-size: 1rem;
}
#signIn{
    background-color: rgb(13, 13, 56);
    color: white;padding: 1.2vw;
    cursor: pointer;text-align: center;
    font-size:2.7vw;cursor: pointer;
    height: auto;
}
form input:hover,form input:focus, .sign_in:hover, form textarea:hover,form select:hover{
   border: hidden;box-shadow: 3px 4px 6px rgba(0,150,250,1);
}
/*Media query for large devices*/
@media screen and (max-width:3000px) and (min-width:801px){
nav, .mainSection{
    padding-left:2rem;padding-right: 5rem;
}
#pre{
  font-size:1.7vw;
}
form{
    border-radius: 10px 0px 0px 10px;
}
nav a{
  font-size: 1.4vw;
}
form input{
    font-size: 1.2rem;
}
#signIn{
    font-size:1.3vw;
}
section{
    padding:3rem 4rem 2rem 0px;border: 1px solid rd;width: fit-content;
}
} 
div p{
text-align: left;margin-left: 10%;
}
        </style>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initialscale = 1.0"/>
        <meta http-equiv="refresh" content="100"/>
    </head>
    <body>
        <nav>
          <a title="Go to home page" href="#"></i>Home</a>
        </nav>
      <section class="mainSection">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <p id="pre">Create New Account Here</p>
            <section>
              <b>Username:</b><input type="text" name="usernames" value="<?php echo $usernames ;?>"/>
            <br/><span><?php echo $errUsernames; ?></span>
           </section>
           <section> <b>Email:</b><input type="email" name="useremail" value="<?php echo $useremail ;?>"/>
            <br/><span><?php echo $errEmail; ?></span>
           </section>
            <section>
            <b>Password:</b><input type="password" name="passwords" value="<?php echo $passwords ;?>"/>
            <br/><span><?php echo $errPasswords; ?></span>
            </section>
            <section>
            <b>Confirm Password:</b><input type="password" name="Cpasswords" value="<?php echo $Cpasswords ;?>"/>
            <br/><span><?php echo $errCpasswords; ?></span>
            </section>
            <section>
            <b>First Name:</b><input type="text" name="fname" value="<?php echo $fname ;?>"/>
            <br/><span><?php echo $errFname; ?></span>
           </section>
           <section> 
            <b>Middle Name:</b><input type="text" name="mname" value="<?php echo $mname ;?>"/>
            <br/><span><?php echo $errMname; ?></span>
           </section>
            <section>
            <b>Sir Name:</b><input type="text" name="sname" value="<?php echo $sname ;?>"/>
            <br/><span><?php echo $errSname; ?></span>
            </section>
            <section>
            <b>Contact:</b><input type="text" name="contact" value="<?php echo $contact ;?>"/>
            <br/><span><?php echo $errContact; ?></span>
            </section>
            <section>
              <b>Sex:</b>
              <select name="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>  
            </section>
            <section style="padding-top:0px;width:100%;">
            <input id="signIn" type="submit" name="sign_up" value="Sign Up"/></section>
            <section>
              <h2><?php if(isset($signUpErr)){echo $signUpErr;}?></h2>
            </section>  
        </form>
      </section>      
    </body>
</html>