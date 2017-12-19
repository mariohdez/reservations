"use strict";

function clear( elementID ) {
    var parent = $( elementID );
    if ( parent ) {
        for ( var c = parent.firstChild; c; c = parent.firstChild ) {
            parent.removeChild( c );
        }
    }
}

function ajaxCompleted( ajax ) {
    var response = JSON.parse( ajax.responseText );
    var status = "";

    if ( response.username ) {
        status = "Name " + response.username + " is taken.";
        $( "status" ).textContent = status;
        $( "status" ).setStyle({
            backgroundColor: 'red',
            fontSize: '20px'
        });
    } else {
        status = "Username is available.";
        $( "status" ).textContent = status;
        $( "status" ).setStyle({
            backgroundColor: 'green',
            fontSize: '20px'
        });
    }
}

function ajaxFailed( ajax ) {
    $( 'errors' ).textContent = ajax.status + " " + ajax.statusText;
}

function ajaxLookup() {
    clear( "status" );
    clear( "errors" );
    var inputName = $( "name" ).value;
    if ( inputName ) {
        console.log( "inputName: " + inputName )
        new Ajax.Request "login.php", {
            onSuccess: ajaxCompleted,
            onFailure: ajaxFailed,
            onException: ajaxFailed,
            parameters: {
                name: inputName
            }
        }
    );
}
}

function errorMatchingCredentials() {
    $( 'errors' ).textContent = "Failed matching credentials.";
}

window.onload = function() {
    $( "name" ).onkeyup = ajaxLookup;
}
