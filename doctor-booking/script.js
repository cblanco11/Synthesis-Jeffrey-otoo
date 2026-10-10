// check the login form is not empty
function checkLogin() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username == "" || password == "") {
        alert("Please enter your username and password");
        return false;
    }
    return true;
}

// fill the time dropdown when a doctor is picked
function showTimes() {
    var doctor = document.getElementById("doctor").value;
    var timeBox = document.getElementById("time");

    timeBox.innerHTML = "";

    if (doctor == "") {
        timeBox.innerHTML = "<option value=''>-- select a doctor first --</option>";
        return;
    }

    var times = doctors[doctor];

    if (times.length == 0) {
        timeBox.innerHTML = "<option value=''>No times available</option>";
        return;
    }

    timeBox.innerHTML = "<option value=''>-- select time --</option>";
    for (var i = 0; i < times.length; i++) {
        timeBox.innerHTML += "<option value='" + times[i] + "'>" + times[i] + "</option>";
    }
}

// make sure a doctor and time are picked before booking
function checkBooking() {
    var doctor = document.getElementById("doctor").value;
    var time = document.getElementById("time").value;

    if (doctor == "" || time == "") {
        alert("Please choose a doctor and a time");
        return false;
    }
    return true;
}
