<?php 
include "transportationDB.php";
session_start();
  $from = $_SESSION["from"];
  $to = $_SESSION["to"];
  $date_time = $_SESSION["date_time"];

  //Payment
  if(isset($_POST["submit"])){
    $payment = $_POST["pay"];
    $bus_fee = $_POST["bus_fee"];
    $sit = $_POST["sit"];
    $occupied_sits = $_POST["occupied_sits"];
    $id = $_POST["id"];

    if(empty($payment) || empty($sit)){
                //send alert to user
                echo " <script type='text/javascript'>
                window.onload = function(){
                 alert('Please fill all fields');
                }
                </script>";        
    }
    else{
        if(!preg_match("/^[0-9]*$/",$payment) || !preg_match("/^[0-9]*$/",$sit)){
                          //send succ alert to user
                          echo " <script type='text/javascript'>
                          window.onload = function(){
                           alert('Only numbers are allowed');
                          }
                          </script>";    
        }
        else{
            if($payment !== $bus_fee){
                          //send invalid payment amount alert to user
                          echo " <script type='text/javascript'>
                          window.onload = function(){
                           alert('Your payment should be equal to $bus_fee Tsh');
                          }
                          </script>";                   
            }
            if(preg_match("/(,$sit,)/",$occupied_sits)){
                //send invalid payment amount alert to user
                echo " <script type='text/javascript'>
                window.onload = function(){
                 alert('This sit is already occupied');
                }
                </script>";                   
            }

            else{
                //update list of occupied sits in database
                $occupied_sits = $occupied_sits."".$sit;

                $update = "UPDATE admin_data SET ocupied_sits = '$occupied_sits,' WHERE id='$id'";
                mysqli_query($conn, $update);
                //send succ alert to user
                echo " <script type='text/javascript'>
                window.onload = function(){
                 alert('Payment is successful, enjoy your journey');
                }
                </script>";
            }
        }
    }
    /*
    elseif(intval($payment) !== intval($bus_fee)){
        //send succ alert to user
        echo " <script type='text/javascript'>
        window.onload = function(){
         alert('Your payment should exactly match with
         desired bus fee');
        }
        </script>";
}
    elseif(intval($payment) == intval($bus_fee)){
        //send succ alert to user
        echo " <script type='text/javascript'>
        window.onload = function(){
         alert('Payment is successful');
        }
        </script>"; 
    }*/
  }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Buy ticket</title>
        <link rel="stylesheet" href="fontawsome/css/all.css"/>
        <meta charset="utf-8"/>
        <meta http-equiv="refresh" content="1000000"/>
        <meta name="viewport" content="width = device-width,initial-scale=1.0"/>
        <style>
            body,html{
    margin:0px;padding:0px;
}  
body{
    background-image: linear-gradient(-90deg,rgba(255, 0, 0, 0.5), rgba(0, 0, 255, 0.5));
    background-repeat:no-repeat;
    background-size: 100% 100%;
    min-height: 100vh;align-items: center;
    display: flex;flex-direction: column;
}
*{
  text-decoration: none;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color:white;outline:none;
}
nav{
  background-color: aliceblue;padding: 1.4vw;
  display: flex; justify-content: flex-start;
  height: 10vh;width: 100%;
}
nav a{
    color: rgb(43, 39, 39);margin: 0px 2vw;
    padding-bottom: 1.5vw;
    font-weight: bold;
    font-size: 1.5vw;
}
nav a:hover{
    border-bottom: 2px solid rgb(43, 39, 39);
}
section{
    width: fit-content;
    max-width: 70vw;
    background-color: rgba(16,50,120,0.5);
    font-size: 2vw;
    padding:3vw 2vw 2vw 2vw;
    margin: 5vw 0px;
    border-radius: 15px;
    border:1px solid rgb(16,50,120);
}
section p{
    color:rgba(230,230,250,0.9);
}
input{
    color:black;
    padding: 0.8vw;
    border-radius: 10px;
    font-size: 1.5vw;
    margin-right:1vw;
    border:1px solid rgb(16,50,120);
}
#submit{
    color: white;
    background-color:rgba(19,16,80);
    cursor:pointer;
}
form{
    margin-top:5vw;
}
.car{
    border: 1px solid rgb(19,16,80);
    padding:1vw;
    border-radius: 5px;
    width:75%;
    height: auto;
    display: inline-block;
}
.car_side{
    display: inline;
    width:10%;
    padding: 8.5vw 1vw;
    height: 20vw;
    border: 2px solid rgba(60,60,170,1);
    border-radius: 5px;
    position:relative;
    top: -7vw;
}
.occupied_sit{
    background-color: rgba(60,60,170,1);
}
.sit{
    color:white;
    height: 3.5vw;
    margin: 0.5vw;
    border: 2px solid rgba(60,120,170,1);
    border-radius: 10px;
    width:3.5vw;
    padding:0.5vw;
    text-align:center;
    display:inline-block;
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
        <?php
        //data from admin
$dataset = "SELECT * FROM admin_data WHERE route_from='$from' && 
route_to='$to' && journey_time= '$date_time'";
$querying = mysqli_query($conn,$dataset);
if(mysqli_num_rows($querying) > 0){
  while($value = mysqli_fetch_assoc($querying)){
    $route_id = $value["id"];
    $company_name = $value['company_name'];
    $route_from = $value['route_from'];
    $route_to = $value['route_to'];
    $journey_time = $value['journey_time'];
    $bus_fee = $value['bus_fee'];
    $bus_sits = $value['available_sits'];
    $occupied_sits = $value['ocupied_sits'];

    //Print those data
    echo "<section>";
    echo "<p>Company Name: $company_name</p>";
    echo "<p>From: $route_from</p>";
    echo "<p>To: $route_to</p>";
    echo "<p>Journey Time: $journey_time</p>";
    echo "<p>Bus Fee: $bus_fee Tsh</p>";
    echo "<div class='car_side'>Back</div>";
    echo "<div class='car'>";
    //put while loop
    while($bus_sits > 0){
        $classes = 'sit';
        if(preg_match("/(,$bus_sits,)/",$occupied_sits)){
            $classes = 'sit occupied_sit';
        }
        echo "<span class='$classes'>$bus_sits</span>";
        $bus_sits--;
    }
    echo "</div>";
    echo "<div class='car_side'>Front</div>";
    echo "<form action='buyTicket.php' method='post'>";
    echo "<input type='hidden' name='bus_fee' value={$bus_fee} />";
    echo "<input type='hidden' name='occupied_sits' value={$occupied_sits} />";
    echo "<input type='hidden' name='id' value={$route_id} />";
    echo "<input type='number' name='pay' placeholder='Enter payment in Tsh'/>";
    echo "<input type='number' name='sit' placeholder='Enter bus sit'/>";
    echo "<input id='submit' type='submit' name='submit' value='Submit'/>";
    echo "</form>";
    echo "</section>";
  }
}
?>

    </body>
</html>