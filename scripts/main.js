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

function validateEditUser() {
    //TODO: remove commenting out, update to validate user edited data
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
    var reallyDelete = confirm("Do you really want to delete this user ?");
    if (reallyDelete) {
        $.post("deleteUser.php", {deleteUser: userID}, function (data, status) {
            if (status) {
                $.get("usersList.php", function (data) {
                    $("#admin-content").html(data);
                });
                // TODO: update message with first and last name of user
                alert("Successfully deleted user with id: " + userID)
            } else alert("Could not delete user with id: " + userID);
        });
    }
}

function deleteBike(el) {
    let bikeID = $(el).val();
    var reallyDelete = confirm("Do you really want to delete this bicycle ?");
    if (reallyDelete) {
        alert("Successfully deleted bike with id: " + bikeID)
        /*$.post("deleteBike.php", {deleteUser: bikeID}, function (data, status) {
            if (status) {
                $.get("usersList.php", function (data) {
                    $("#admin-content").html(data);
                });
                // TODO: update message with bike data like title
                alert("Successfully deleted bike with id: " + bikeID)
            } else alert("Could not delete bike with id: " + bikeID);
        });*/
    }
}

// TODO: finalize editing user
function editUser(el) {
    let userID = $(el).val();
    $.get("editUser.php", {userToEditID: userID}, function (data) {
        $("#admin-content").html(data);
    })

}

function editBike(el) {
    let bikeID = $(el).val();
    $.get("editBike.php", {userToEditID: bikeID}, function (data) {
        $("#admin-content").html(data);
    })

}

function saveAccount(value) {
    let accountID = value;
    let form = document.forms["account" + accountID];
    let loginName = form["login"].value;
    let pw1 = form["pw1"].value;
    let pw2 = form["pw2"].value;
    let passwordsMatch = (pw1 === pw2);
    let isAdmin = form["isAdmin"].checked ? "1" : "";
    if (passwordsMatch) {
        $.post("updateAccount.php", {
                accountID: accountID,
                login: loginName, pw: pw1, admin: isAdmin
            },
            function (data, status) {
                if (status) {
                    $.get("accountsList.php", function (data) {
                        $("#admin-content").html(data);
                    });
                    alert("Successfully saved account with id: " + accountID)
                } else alert("Could not save account with id: " + accountID);
            });
    } else alert("New passwords don't match. Try again!")
}

function saveUser(id) {
    let userID = id;
    let form = document.forms["editUser"];
    let fname = form["fname"].value;
    let lname = form["lname"].value;
    let genderID = form["genderID"].value;
    let email = form["email"].value;
    let dob = form["dob"].value;
    $.post("updateUser.php", {userID: userID, fname: fname, lname: lname, genderID: genderID, email: email, dob: dob},
        function (data, status) {
            if (status) {
                $.get("usersList.php", function (data) {
                    $("#admin-content").html(data);
                })
                alert("Successfully saved user " + fname + " " + lname + " with id: " + userID)
            } else alert("Could not save user " + fname + " " + lname + " with id: " + userID);
        });
}

function listBikes(element) {
    let btnValue = $(element).val();
    $.post("getListOfBikes.php", {allOrMatching: btnValue},
        function (bikesHTML) {
            $("#items-wrapper").html(bikesHTML)
        });
}