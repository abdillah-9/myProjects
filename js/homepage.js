//Below codes are for dropdown menu
var icon = document.getElementById('icon');
var droplinks = document.getElementById('droplinks');
droplinks.style.display = "none";
function dropFunc(){
    if(droplinks.style.display == "none"){
        droplinks.style.display = "block";
        icon.className = ("fa-solid fa-minus");

    }
    else{
        droplinks.style.display = "none";
        icon.className = ("fas fa-bars");
    } 
}
//Below codes are for iframe
var user = document.getElementById('user');
var service = document.getElementById('service');
var submit = document.getElementById('submit');
var iframing = document.getElementById("iframing");
var iframesection = document.getElementsByClassName("iframesection")[0];
function funcUser(){
        user.style = "border-bottom: 2px solid white;";
        service.style = "border-bottom: none;";
        submit.style = "border-bottom: none;";
        iframing.src = "UserInfo.php";
        iframesection.style ="height: 950px";
}
function funcService(){
    service.style = "border-bottom: 2px solid white;";
    user.style = "border-bottom: none;";
    submit.style = "border-bottom: none;";
    iframing.src = "ServiceInfo.php";
    iframesection.style ="height: 1150px";
}
function funcSubmit(){
    submit.style = "border-bottom: 2px solid white;";
    service.style = "border-bottom: none;";
    user.style = "border-bottom: none;";
    iframing.src = "ConfirmSubmit.php";
    iframesection.style ="height: 1800px";
}