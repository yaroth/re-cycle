$(document).ready(function () {
    $("#close").hide();
    $("#open").click(function () {
        $("#open").hide();
        $("#close").show();
        $("#mobile").show();

    });
    $("#close").click(function () {
        $("#close").hide();
        $("#mobile").hide();
        $("#open").show();
    });
});


function validateCreateAccount() {
    //TODO: remove commenting out
    /*var form = document.forms["create-account"];
    var name = form.lname.value;
    if (!name) {
        alert("No valid name!");
        return false;
    }

    var surname = form.fname.value;
    if (!surname) {
        alert("No valid first name!");
        return false;
    }

    var username = form.login.value;
    if (!username) {
        alert("No valid login!");
        return false;
    }

    var password = form.pw.value;
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

function validateEditBike() {
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
    $(element).addClass("active").siblings().removeClass('active');
    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');
    if (buttonValue == "users") {
        $.get("usersList.php", {language: language}, function (data) {
            $("#admin-content").html(data);
        })
    } else if (buttonValue == "bicycles") {
        $.get("bikesList.php", {language: language}, function (data) {
            $("#admin-content").html(data);
        })
    } else if (buttonValue == "queries") {
        $.get("queriesList.php", {language: language}, function (data) {
            $("#admin-content").html(data);
        })
    } else if (buttonValue == "accounts") {
        $.get("accountsList.php", {language: language}, function (data) {
            $("#admin-content").html(data);
        })
    } else $("#admin-content").html("<error>Something went wrong. Sorry. Please try again!</error>");
}

function deleteUser(el) {
    let userID = $(el).val();

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    var reallyDelete = confirm("Do you really want to delete this user ?");
    if (reallyDelete) {
        $.post("deleteUser.php", {deleteUserID: userID}, function (data, status) {
            if (status) {
                alert(data);
                $.get("usersList.php", {language: language}, function (data) {
                    $("#admin-content").html(data);
                });
            } else {
                alert("Could not delete user with id: " + userID + "\nError message: " + data);
            }
        });
    }
}

function deleteBike(el) {
    let bikeID = $(el).val();

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    // TODO: add details to delete message
    var reallyDelete = confirm("Do you really want to delete this bicycle (ID: " + bikeID + " ) ?");
    if (reallyDelete) {
        $.post("deleteBike.php", {deleteBikeID: bikeID}, function (data, status) {
            if (status) {
                $.get("bikesList.php", {language: language}, function (data) {
                    $("#admin-content").html(data);
                });
                // TODO: update message with bike data like title
                alert(data)
            } else alert("Could not delete bike with id: " + bikeID);
        });
    }
}

function deleteQuery(el) {
    let queryID = $(el).val();

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    // TODO: add details to delete message
    var reallyDelete = confirm("Do you really want to delete this query (ID: " + queryID + ") ?");
    if (reallyDelete) {
        $.post("deleteQuery.php", {deleteQueryID: queryID}, function (data, status) {
            if (status) {
                $.get("queriesList.php", {language: language}, function (data) {
                    $("#admin-content").html(data);
                });
                // TODO: update message with bike data like title
                alert(data)
            } else alert("Could not delete query with id: " + queryID);
        });
    }
}

function editUser(el) {
    let userID = $(el).val();

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    $.get("editUser.php", {userToEditID: userID, language: language}, function (data) {
        $("#admin-content").html(data);
    })

}

function editQuery(el) {
    let queryID = $(el).val();

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    $.get("editQuery.php", {queryID: queryID, language: language}, function (data) {
        $("#admin-content").html(data);
    })

}

function editBike(el) {
    let bikeID = $(el).val();

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    $.get("editBike.php", {bikeToEditID: bikeID, language: language}, function (data) {
        $("#admin-content").html(data);
    })

}

function saveAccount(value) {
    let accountID = value;

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

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
                    $.get("accountsList.php", {language: language}, function (data) {
                        $("#admin-content").html(data);
                    });
                    alert(data);
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

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    $.post("updateUser.php", {userID: userID, fname: fname, lname: lname, genderID: genderID, email: email, dob: dob},
        function (data, status) {
            if (status) {
                $.get("usersList.php", {language: language}, function (data) {
                    $("#admin-content").html(data);
                });
                alert(data)
            } else alert("Could not save user " + fname + " " + lname + " with id: " + userID);
        });
}

function saveBike(id) {
    let bikeID = id;
    let form = document.forms["editBike"];
    let title = form.title.value;
    let description = form.description.value;
    let weight = form.weight.value;
    let price = form.price.value;
    let hasLights = form.hasLights.value;
    let hasGears = form.hasGears.value;
    let gearTypeID = form.gearTypeID.value;
    let nbOfGears = form.nbOfGears.value;
    let wheelSize = form.wheelSize.value;
    let brakeTypeID = form.brakeTypeID.value;
    let ownerID = form.ownerID.value;
    let file = form.upload.files[0];
    let formData = new FormData();
    formData.append('files', file);
    formData.append('bikeID', bikeID);
    formData.append('title', title);
    formData.append('description', description);
    formData.append('weight', weight);
    formData.append('price', price);
    formData.append('hasLights', hasLights);
    formData.append('hasGears', hasGears);
    formData.append('gearTypeID', gearTypeID);
    formData.append('nbOfGears', nbOfGears);
    formData.append('wheelSize', wheelSize);
    formData.append('brakeTypeID', brakeTypeID);
    formData.append('ownerID', ownerID);

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    $.ajax({
        url: 'updateBike.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success: function (data) {
            alert(data);
            $.get("bikesList.php", {language: language}, function (data) {
                $("#admin-content").html(data);
            })
        },
        error: function () {
            alert("Could not save bike with id: " + bikeID);
        }
    });
}

function saveQuery(event) {
    event.preventDefault();

    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    // event.stopPropagation();
    let form = document.forms["editQuery"];
    let queryID = form.queryID.value;
    let title = form.title.value;
    let weight = form.weight.value;
    let price = form.price.value;
    let hasLights = form.hasLights.value;
    if (hasLights === 'no') hasLights = 0;
    let hasGears = form.hasGears.value;
    if (hasGears === 'no') hasGears = 0;
    let gearTypeID = form.gearTypeID.value;
    let nbOfGears = form.nbOfGears.value;
    let wheelSize = form.wheelSize.value;
    let brakeTypeID = form.brakeTypeID.value;
    let userID = form.userID.value;
    // console.log("queryID: " +  queryID + "\ntitle: " +  title + "\nweight: " +  weight + "\nprice: " +  price + "\nhasLights: " +  hasLights + "\nhasGears: " +  hasGears + "\ngearTypeID: " +  gearTypeID + "\nnbOfGears: " +  nbOfGears + "\nwheelSize: " +  wheelSize + "\nbrakeTypeID: " +  brakeTypeID + "\nuserID: " +  userID);

    $.post("updateQuery.php", {
            queryID: queryID, title: title, weight: weight,
            price: price, hasLights: hasLights, hasGears: hasGears, gearTypeID: gearTypeID,
            nbOfGears: nbOfGears, wheelSize: wheelSize, brakeTypeID: brakeTypeID, userID: userID
        },
        function (data, status) {
            if (status) {
                $.get("queriesList.php", {language: language}, function (data) {
                    $("#admin-content").html(data);
                })
                alert(data);
            } else {
                alert("Could not save query with id: " + queryID);
            }
        });


}

function addQuery(event) {
    event.preventDefault();
    // event.stopPropagation();
    let form = document.forms["add-Query"];
    let title = form.title.value;
    let weight = form.weight.value;
    let price = form.price.value;
    let hasLights = form.hasLights.value;
    if (hasLights === 'no') hasLights = 0;
    let hasGears = form.hasGears.value;
    if (hasGears === 'no') hasGears = 0;
    let gearTypeID = form.gearTypeID.value;
    let nbOfGears = form.nbOfGears.value;
    let wheelSize = form.wheelSize.value;
    let brakeTypeID = form.brakeTypeID.value;
    // console.log("queryID: " +  queryID + "\ntitle: " +  title + "\nweight: " +  weight + "\nprice: " +  price + "\nhasLights: " +  hasLights + "\nhasGears: " +  hasGears + "\ngearTypeID: " +  gearTypeID + "\nnbOfGears: " +  nbOfGears + "\nwheelSize: " +  wheelSize + "\nbrakeTypeID: " +  brakeTypeID + "\nuserID: " +  userID);

    $.post("addQueryToDB.php", {
            title: title, weight: weight,
            price: price, hasLights: hasLights, hasGears: hasGears, gearTypeID: gearTypeID,
            nbOfGears: nbOfGears, wheelSize: wheelSize, brakeTypeID: brakeTypeID
        },
        function (data, status) {
            if (status) {
                alert(data);
                let urlParams = new URLSearchParams(window.location.search);
                let lang = urlParams.get('lang');
                location.href = "index.php?lang=" + lang + "&id=3";
            } else {
                alert("ERROR. Could not add query. Sorry. ");
            }
        });


}

function listBikes(element) {
    let btnValue = $(element).val();
    $(element).addClass("active").siblings().removeClass('active');
    ;
    let url = new URL(location.href);
    let searchParams = new URLSearchParams(url.search);
    let language = searchParams.get('lang');

    $.post("getListOfBikes.php", {allOrMatching: btnValue, language: language},
        function (bikesHTML) {
            $("#bikes-wrapper").html(bikesHTML)
        });
}

function buyBike(el) {
    let bikeID = $(el).val();
    var reallyBuy = confirm("Do you really want to buy this bicycle?");
    if (reallyBuy) {
        $.post("purchaseConfirmation.php", {bikeID: bikeID},
            function (data) {
                $("#bikes-wrapper").html(data)
            });
    }

}