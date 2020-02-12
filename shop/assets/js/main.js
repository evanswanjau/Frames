// image edit functionality
function image_bg_size(){

    var slider = document.getElementById("bg_size");
    document.getElementById("our_image").style.padding = slider.value + "px";
    document.getElementById("bg_sizee").value = slider.value;

    return false;

}

function image_background(color){

    document.getElementById("our_image").style.backgroundColor = color;
    document.getElementById("bg_colorr").value = color;

    return false;

}

// get length
function calculate_amount(){

    let length = (getCookie('length') != "") ? getCookie('length') : 10;
    let width = (getCookie('width') != "") ? getCookie('width') : 10;

    let value = (length > width) ? length : width;

    let amount = value * 10;

    return amount;

}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
  
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}
  
function checkCookie() {
    var user = getCookie("username");
    if (user != "") {
        alert("Welcome again " + user);
    } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
        setCookie("username", user, 365);
    }
    }
}