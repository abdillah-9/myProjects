<?php
include "transportationDB.php";
session_start();
//inputs validation
   //vars declaration
$usernames = $passwords = $Cpasswords = $errUsernames = $errPasswords = $errCpasswords ="";
$valid = true;
$account_unavailable ="";
   //codes when submit button is clicked
if(isset($_POST["sign_in"])){
  //sessions declaration
  $_SESSION['user_name'] = $_POST['usernames'];
$_SESSION['user_password'] = $_POST['passwords'];

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
      $errCpasswords = "This field doesn't match with passowrd";
      $valid = false;
    }
  }

  //SELECT DATA FROM DB TABLE FORM IF EVERY USER INPUT IS VALID AND CREATE USER ID SESSION
  if($valid == true){
    if($usernames == "Admin" && $passwords == "Admin"){
      //redirect admin
      header("Location:admin.php");
      exit();
    }
    else{
      $account_unavailable = "This account doesn't exist";
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
        <title>Sign In</title>
        <link rel="stylesheet" href="fontawsome/css/all.css"/>
        <meta charset="utf-8"/>
        <meta http-equiv="refresh" content="1000000"/>
        <meta name="viewport" content="width = device-width,initial-scale=1.0"/>
        <style>
            body,html{
    margin:0px;padding:0px;
}          
body{
  background-color:rgba(20,20,20,0.7)
}
*{
  text-decoration: none;font-family: Verdana, Geneva, Tahoma, sans-serif;box-sizing: border-box;
  color:white;outline:none;
}
nav{
  padding :0.9rem 0rem 1rem 1rem;font-size:0.8rem;background-color:rgba(5,5,10,0.1);
}
nav a{
    color: white;padding :1rem 1.4rem;border:hidden;
    background-color: rgba(20,70,170,0.8);display:inline-block;
    border-radius:5px;
}
nav a:hover{
  padding: 1rem 1.45rem;box-shadow:3px 3px 5px rgba(20,20,70,1);
}
section{
  height: 100vh;
   background-image:url('img/campus3.jpg');
   background-size:100% 100%;background-repeat:no-repeat;
}
div{
  padding:2rem 0px 19.5rem 1rem;text-align:left;font-size:0.8rem;background-color:rgba(5,5,10,0.1);

}
h1{
    padding:0px;word-spacing: 0.1rem;letter-spacing:0.3rem;
    font-size:1.7rem;line-height:2rem;margin:1vw;
}
div p{
    display:inline-block;
    font-size: 2vw;
    margin:1vw;
    padding: 2vw;
    border-radius:10px;
    color: rgb(200,200,200);
    background-image: linear-gradient(-90deg,rgba(255, 0, 0, 0.5), rgba(0, 0, 255, 0.5));
}
div a{
  border-radius:5px;padding:0.5rem;color: rbg(200,200,200);
  background-color:royalblue;
}
form{
padding:0.3rem 0px 4rem 1rem;background-color:rgba(5,5,10,0.65);
height:fit-content;display:flex;left:35vw;border-radius:10px;
flex-wrap:wrap;font-size:0.8rem;width:60%;position:absolute;top:10vw;
}
pre{
   width:100%;font-size:1.3rem;margin:0.7rem 0px 1.3rem 0px;
}
form b{
    display:inline-block;padding:0rem 0.4rem 0.7rem 0px;color:rgba(200,200,220,1);
    letter-spacing:0.18rem;font-weight:normal;
}
form input, form textarea, form select{
    border: 1px solid rgb(140,140,140);padding: 0.5rem;border-radius: 25px;width: 100%;
    margin-right:1rem;display:inline-block;color:black;font-size:0.9rem;
}
form input:hover,form input:focus, form textarea:hover,form select:hover{
   border-color: rgba(10,20,100,1);box-shadow: 4px 4px 10px rgba(0,10,150,1);
}
span{
  display:block;padding:0px 0.5rem 0px 0px;margin-right:1.5rem;width:80%;max-width:16rem;
}
form p{
  color:rgba(250,100,10,0.7);display:block;
}
#signIn{
margin:0px;background-color: rgba(20,70,170,0.8);width:fit-content;padding:0.8rem;max-width:7rem;
color:rgb(230,230,230);font-size:0.8rem;font-weight:bold;top:1.6rem;position:relative;
height:fit-content;cursor:pointer;font-weight:normal;border:hidden;
}
h2{
  color:rgba(110,20,20,1);
}
@media screen and (min-width:650px){
    nav, div, form{
      padding-left:3rem;font-size:0.9rem;
    }
    h1{
      font-size:2.5rem;line-height:2.5rem;
    }
    div{
      text-align:cente;
    }
    span{
      width:18rem;
    }
    #signIn{
      font-size:0.9rem;
    }
    
  }
        </style>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initialscale = 1.0"/>
        <meta http-equiv="refresh" content="100"/>
    </head>
    <body>
      <section>
      <nav>
          <a title="Go to home page" href="index.php">Home</a>
          <!--<a title="Admin Sign In" href="../Admin/Sign-In.html"><i class="fas fa-user"></i>Admin</a>-->
        </nav>
      <div>
            <h1>Welcome</h1>
            <p>System Administrator</p>
            <h2 class=""><?php if(isset($account_unavailable)){
              echo $account_unavailable;} ?></h2>
            <?php if(isset($succ)) { echo " <script type='text/javascript'>
         window.onload = function(){
          alert('New account is successful created');
         }
         </script>"; 
        } ?>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <pre>Sign In Here</pre>
            <span>
            <b>Username: </b><input type="text" name="usernames" value="<?php echo $usernames;?>"/>
            <p><?php echo $errUsernames;?></p>
            </span>
            <span>
            <b>Password: </b><input type="password" name="passwords" value="<?php echo $passwords;?>"/>
            <p><?php echo $errPasswords;?></p>
            </span>
            <span>
            <b>Confirm Password: </b><input type="password" name="Cpasswords" value="<?php echo $Cpasswords;?>"/>
            <p><?php echo $errCpasswords;?></p>
            </span>
            <input id="signIn" type="submit" name="sign_in" value="Sign In"/>
            </span>
        </form>
      </section>      
    </body>
</html>