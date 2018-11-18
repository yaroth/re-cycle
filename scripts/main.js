function validateCreateAccount() {
    //TODO: remove commenting out
    /*var form = document.forms["create-account"];
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
    }*/
    return true;
}

function validateLogin() {
    // TODO: update code, once it is clear what needs to be verified
    /*var form = document.forms["login"];
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
    }*/
    return true;
}

function validateNewPassword() {
    // TODO: Some checks
    let form = document.forms["setNewPassword"];
    let pw1 = form["newpw1"].value;
    let pw2 = form["newpw2"].value;
    if (pw1 !== pw2) {
        alert("Passwords do not match!");
        return false;
    }
    return true;
}
