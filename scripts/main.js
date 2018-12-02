$(document).ready(function () {

    $.get("test.php", function (data) {
        $("#time").html(data);
    });

});

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
    let form = document.forms["setNewPassword"];
    let pw1 = form["newpw1"].value;
    let pw2 = form["newpw2"].value;
    if (pw1 !== pw2) {
        alert("Passwords do not match!");
        return false;
    }
    return true;
}

function getPersonData() {
    // post(url [, data, success-cb, data-type])
    $.post("../pages/getperson.php", $('#nicknameform').serialize(), function (person) {
        $('#persondata').html(
            "<div class='pink'>" + person.fname + " " + person.lname + ", Age: " + person.age + "</div>"
        );
    }, "json");
}

function adminSelection(element) {
    let buttonValue = $(element).val();
    if (buttonValue == "users") {
        $.get("usersList.php", function (data) {
            $("#admin-content").html(data);
        })
    } else if (buttonValue == "bicycles") {
        $.get("bikesList.php", function (data) {
            $("#admin-content").html(data);
        })
    } else if (buttonValue == "queries") {
        $.get("queriesList.php", function (data) {
            $("#admin-content").html(data);
        })
    } else if (buttonValue == "matches") {
        $.get("matchesList.php", function (data) {
            $("#admin-content").html(data);
        })
    } else if (buttonValue == "accounts") {
        $.get("accountsList.php", function (data) {
            $("#admin-content").html(data);
        })
    } else $("#admin-content").html("Something went wrong. Sorry. Please try again!");
}

function deleteUser(el) {
    let userID = $(el).val();
    // TODO: add security message 'do you really want to delete user x'?
    $.post("deleteUser.php", {deleteUser: userID}, function (data, status) {
        if (status) {
            $.get("usersList.php", function (data) {
                $("#admin-content").html(data);
            });
            alert("Successfully deleted user with id: " + userID)
        } else alert("Could not delete user with id: " + userID);
    });

}

function editUser(el) {
    let userID = $(el).val();

}
