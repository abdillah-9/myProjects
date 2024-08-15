<?php
$server_name = "localhost";
$user_name = "root";
$password = "";
$db_name ="transportation";
//Create conn
$conn = new mysqli($server_name,$user_name,$password,$db_name) or die("Conn failed");
/*
echo "Conn between database and client's form is successfully created"."<br>"."<br>";

//Create table users
$table1 = "CREATE TABLE users(
    id INT(6) UNSIGNED AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    emails VARCHAR(40) NOT NULL,
    passwords VARCHAR(15) NOT NULL,
    first_name VARCHAR(25) NOT NULL,
    middle_name VARCHAR(40) NOT NULL,
    sir_name VARCHAR(15) NOT NULL,
    sex VARCHAR(6) NOT NULL,
    contact_no VARCHAR(11) NOT NULL,
    PRIMARY KEY(id)
    )";
 if($conn->query($table1) === true){
    echo "Table is successful created"."<br>";
}
else{
    echo "Table is not created"."<br>";
}
//Create table account for admins
$table2 = "CREATE TABLE admin_data(
    id INT(6) UNSIGNED AUTO_INCREMENT,
    company_name VARCHAR(30) NOT NULL,
    route_from VARCHAR(30) NOT NULL,
    route_to VARCHAR(30) NOT NULL,
    journey_time DATETIME,
    bus_fee VARCHAR(50) NOT NULL,
    available_sits INT(3) NOT NULL,
    ocupied_sits VARCHAR(100) NOT NULL,
    PRIMARY KEY(id)
    )";
if($conn->query($table2) === true){
    echo "Table accounts is successful created"."<br>";
}
else{
    echo "Table accounts is not created"."<br>";
}
 
//insert first user as Admin
$addUser = "INSERT INTO users(username,passwords,emails) 
VALUES('Admin','Admin','admin855@gmail.com')";
 if($conn->query($addUser) === true){
    echo "Table is successful created"."<br>";
}
else{
    echo "Table is not created"."<br>";
}*/
?>
