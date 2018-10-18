function validateForm() {
var form = document.forms["p-data"];
var name = form["name"].value;
if (!name) {
alert("No valid name!");
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
