<?php
include "transportationDB.php";
session_start();
$bus_correct=$from= $error= $to= $date_time=$bus_fee="";

if(isset($_POST["submit"])){
    if(!empty($_POST["from"])){
    $from = $_SESSION['from'] = $_POST["from"];
}
if(!empty($_POST["company_name"])){
    $company_name = $_SESSION['company_name'] = $_POST["company_name"];
}
if(!empty($_POST["available_sits"])){
    $available_sits = $_SESSION['available_sits'] = $_POST["available_sits"];
}
    if(!empty($_POST["to"])){
    $to = $_SESSION['to'] = $_POST["to"];
}
    if(!empty($_POST["date_time"])){
    $journey_time = $_SESSION['date_time'] = $_POST["date_time"];
}
if(!empty($_POST["bus_fee"]) && preg_match("/^[0-9]*$/",$bus_fee)){
    $bus_fee = $_SESSION['bus_fee'] = $_POST["bus_fee"];
    $bus_correct = "true";
}
else{
    $error ="Please fill all fields correctly";
}
    if(!empty($from) && !empty($to) && !empty($journey_time) &&
     !empty($company_name) && $bus_correct == "true"){
         //inform admin that data is succesful uploaded
         $inserting = "INSERT INTO admin_data(company_name,route_from,route_to,
          journey_time,bus_fee,available_sits,ocupied_sits)
         VALUES('$company_name','$from','$to',
         '$journey_time','$bus_fee','$available_sits','0,')";
         $checkInsertion = mysqli_query($conn,$inserting);
         //send an alert to admin for success
         echo " <script type='text/javascript'>
         window.onload = function(){
          alert('Data entry is successful');
         }
         </script>"; 
        }
}

// Update admin password
if(isset($_POST["update_password"])){
    $new_password = $_POST["new_password"];
    if(!empty($new_password) && preg_match("/^[a-zA-Z0-9]*$/",$new_password)){
$updating = "UPDATE users SET passwords='$new_password' WHERE username='Admin'";
$update_complete = mysqli_query($conn,$updating); 
//Show some success notification
echo " <script type='text/javascript'>
window.onload = function(){
 alert('Password updated successfully');
}
</script>"; 

}
else{
        echo " <script type='text/javascript'>
        window.onload = function(){
         alert('Only letters and numbers are allowed..');
        }
        </script>"; 
}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="fontawsome/css/all.css"/>
        <meta charset="utf-8"/>
        <meta http-equiv="refresh" content="1000000"/>
        <meta name="viewport" content="width = device-width,initial-scale=1.0"/>
        <style>
            body,html{
    margin:0px;padding:0px;
}  
body{
    background-image: url('img/campus3.jpg');
    background-repeat:no-repeat;
    background-size: 100% 100%;
    min-height: 100vh;
}
*{
  text-decoration: none;font-family: Verdana, Geneva, Tahoma, sans-serif;box-sizing: border-box;
  color:white;outline:none;
}
nav{
  background-color: aliceblue;padding: 1.4vw;
  display: flex; justify-content: flex-end;
  height: 10vh;  
}
nav a{
    color: rgb(43, 39, 39);margin: 0px 2vw;
    padding-bottom: 1.5vw;
    font-weight: bold;
}
nav a:hover{
    border-bottom: 2px solid rgb(43, 39, 39);
}
.mainSec{
    background-image: linear-gradient(-90deg,rgba(255, 0, 0, 0.5), rgba(0, 0, 255, 0.5));
    z-index: 10;
    min-height: 90vh;
    display: flex;
    justify-content: space-around;
}
form{
    border: 1px solid white;
    border-radius: 10px;
    background-color: aliceblue;
    display: flex;flex-direction: column;
    justify-content: center;
    align-self: center;
    padding: 0px 2vw;
    width: 40%;
    min-height: 90%;
    margin: 2vw 0px;
}
form select{
    border: 1px solid rgba(29, 29, 32, 0.979);
    border-radius: 10px;
    padding: 0.8vw;
    width: 60%;
    color: black;
    cursor: pointer;
}
option{
    color: rgba(29, 29, 32, 0.979);
}
form label{
    margin: 1.3vw 0px 0.4vw 0px;
    font-weight: bold;
    width: 60%;
    color: black;
}
form input{
    width: 90%;
    padding: 0.8vw;
    border: 1px solid rgba(29, 29, 32, 0.979);
    border-radius: 10px;
    margin: 0vw 0px 0.8vw 0px;
    color: black;
    cursor: pointer;
}
.submit{
    background-color: rgb(13, 13, 56);
    color: white;
    cursor: pointer;
}
#bus_fee{
    width:40%;
}
div{
    display: flex;flex-direction: column;
    align-self: center;
    width: 40%;
    height: 90%;
}
div form{
    width:100%;
}
div b{
    font-size: 3vw;
    font-weight: normal;
    color: rgb(218, 226, 233);
    padding: 0.8vw;
}
div span{
    font-size: 1.3vw;
    color: rgb(167, 197, 223);
    background-image: linear-gradient(-90deg,rgba(255, 0, 0, 0.5), rgba(0, 0, 255, 0.5));
    border-radius: 10px;
    padding: 0.8vw;margin: 2vw 0px;
    width: fit-content;
    position: relative;
    right: -0.8vw;
}
.error{
    color:rgba(150,20,20,0.9);
}
form h3{
    color:black;
}
        </style>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initialscale = 1.0"/>
        <meta http-equiv="refresh" content="100"/>
    </head>
    <body>
        <nav>
            <a href="index.php">Home</a>
        </nav>
        <section class="mainSec">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Company Name:</label>
                <select name="company_name">
                    <option value="Abood Bus">Abood Bus</option>
                    <option value="Marangu Coach">Marangu Coach</option>
                    <option value="Shabiby Bus Line">Shabiby Bus Line</option>
                    <option value="Mghamba Express">Mghamba Express</option>
                    <option value="Dar Express Bus">Dar Express Bus</option>
                    <option value="Kilimanjaro Bus Service">
                        Kilimanjaro Bus Service</option>
                    <option value="Dar Lux VIP">Dar Lux VIP</option>
                    <option value="BM Luxury">BM Luxury</option>                                      
                </select>
            <label>From:</label>
                <select name="from">
                    <option value="dar">Dar-es-salaam</option>
                    <option value="moro">Morogoro</option>
                    <option value="dodoma">Dodoma</option>
                    <option value="tabora">Tabora</option>
                    <option value="kigoma">Kigoma</option>
                    <option value="arusha">Arusha</option>
                    <option value="lindi">Lindi</option>
                    <option value="mbeya">Mbeya</option>
                    <option value="iringa">Iringa</option>
                    <option value="moshi">Moshi</option>
                    <option value="tanga">Tanga</option> 
                    <option value="mwanza">Mwanza</option>
                    <option value="shinyanga">Shinyanga</option>
                    <option value="mtwara">Mtwara</option>
                    <option value="singida">Singida</option> 
                    <option value="songea">Songea</option>
                    <option value="geita">Geita</option>                                      
                </select>                
                <label>To:</label>
                <select name="to">
                    <option value="dar">Dar-es-salaam</option>
                    <option value="moro">Morogoro</option>
                    <option value="dodoma">Dodoma</option>
                    <option value="tabora">Tabora</option>
                    <option value="kigoma">Kigoma</option>
                    <option value="arusha">Arusha</option>
                    <option value="lindi">Lindi</option>
                    <option value="mbeya">Mbeya</option>
                    <option value="iringa">Iringa</option>
                    <option value="moshi">Moshi</option>
                    <option value="tanga">Tanga</option> 
                    <option value="mwanza">Mwanza</option>
                    <option value="shinyanga">Shinyanga</option>
                    <option value="mtwara">Mtwara</option>
                    <option value="singida">Singida</option> 
                    <option value="songea">Songea</option>
                    <option value="geita">Geita</option>                                      
                </select>
                <label>Date:</label>
                <input type="datetime-local" name="date_time"/>
                <label>Bus fee:</label>
                <input id="bus_fee" type="text" name="bus_fee"/>
                <label>Bus sits:</label>
                <input id="bus_fee" type="text" name="available_sits"/>
                <input class="submit" type="submit" value="Add Bus Route" name="submit"/>  
                <p class="error"><?php if(isset($error)){echo $error;} ?></p>              
            </form> 
            <div>
                <b>
                    Welcome System Admininistrator
                </b>
                <span>
                    Enjoy your journey
                </span>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                method="post">
                  <h3>Update Admin password</h3>
                  <label>Password:</label>
                  <input type="password" name="new_password"/>
                  <input class="submit" type="submit" name="update_password" 
                  value="Update Password"/>
                </form>
            </div>            
        </section>      
    </body>
</html>