"use strict";

function clear(elementID) {
    var parent = $(elementID);
	if (parent) {
        for (var c = parent.firstChild; c; c = parent.firstChild) {
            parent.removeChild(c);
        }
    }
}

function ajaxCompleted(ajax) {
    var response = JSON.parse(ajax.responseText);
    console.log(ajax.responseText);
    console.log(response);
    if (response) {
       printTable(response);
    }
}

function ajaxFailed(ajax) {
    $('errors').textContent = ajax.status + " " + ajax.statusText;
}

function ajaxLookup() {

    clear("report");
    clear("errors");

    var inputDate = $("reportDateText").value;

    if (inputDate) {
        new Ajax.Request(
            "admin_helper.php",
            {
                onSuccess: ajaxCompleted,
                onFailure: ajaxFailed,
                onException: ajaxFailed,
                parameters:
                {
                    date: inputDate
                }
            }
        );
    }
}
function printTable(response){
    //set up headers for table
        var jetskiHeading = $(document.createElement("td"));
        var usernameHeading = $(document.createElement("td"));
        var newRow = $(document.createElement("tr"));
        jetskiHeading.textContent = "Jetski ID";
        usernameHeading.textContent = "Username";
        $(report).appendChild(newRow);
        newRow.appendChild(jetskiHeading);
        newRow.appendChild(usernameHeading);
    //print out table data
    for(var i=1; i<13; ++i){
        var newJetski = $(document.createElement("td"));
        var newUsername = $(document.createElement("td"));
        var newRow = $(document.createElement("tr"));
        newJetski.textContent = i;
        if(response[i-1]){
            if(response[i-1].jetski_id == i)
            newUsername.textContent = response[i-1].username;
            }
        else{
            newUsername.textContent = 'vacant';
        }
        $(report).appendChild(newRow);
        newRow.appendChild(newJetski);
        newRow.appendChild(newUsername);
    }

}

window.onload = function() {
   $("reportDateText").onchange = ajaxLookup;
}
