function validateForm() {
var form = document.forms["p-data"];
var name = form["name"].value;
if (!name) {
alert("No valid name!");
return false;
}


var surname = form["surname"].value;
if (!surname) {
alert("No valid surname!");
return false;
}

var username = form["username"].value;
if (!username) {
alert("No valid username!");
return false;
}

var password = form["password"].value;
if (!password) {
alert("No valid password!");
return false;
}


var email = form["email"].value;
var regex = /\S+@\S+\.\S+/;
if (!regex.test(email)) {
alert("No valid e-mail address!");
return false;
}
return true;
}
