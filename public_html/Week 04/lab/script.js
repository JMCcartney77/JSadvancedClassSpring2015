/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var form = document.querySelector('form');
var geocoder;

form.addEventListener('submit', checkForm);

function checkForm(e)
{
    e.preventDefault();
    var isValid = true;
    var paragraphs = document.querySelectorAll('form p');
    var fieldlen = paragraphs.length;


    var jsondata = {};
    var regexValidations = {
        "fname": {"regex": /^\(?([2-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/},
        "lname": {"regex": /^$/},
        "email": {"regex": /^[a-zA-Z0-9$]+[@]{1}[a-zA-Z]+[\.]{1}[a-zA-Z]{2,3}$/},
        "phone": {"regex": /^\(?([2-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/},
        "address1": {"regex": /^$/},
        "address2": {"regex": /^$/},
        "city": {"regex": /^$/},
        "zipcode": {"regex": /^$/},
        "username": {"regex": /^$/},
        "password": {"regex": /^$/},
        "confirmpassword": {"regex": /^$/}

    };


    // create the for loop
    for (var i = 0; i < fieldlen; i++) {
        var input = paragraphs[i].querySelector('input');
        jsondata[input.name] = input.value;

        if (input.value === '') {
            paragraphs[i].classList.add('error');
            isValid = false;
        } else {
            paragraphs[i].classList.remove('error');
        }
    }
    console.log(jsondata);

    if (jsondata["password"] !== jsondata.confirmpassword)
    {
        document.querySelector('.passwordError').classList.add('error');
        document.querySelector('.confirmpasswordError').classList.add('error');

        isValid = false;
    }


    if (!regexValidations.email.regex.test(jsondata.email)) {
         document.querySelector('.emailError').classList.add('error');
         
          isValid = false;
    }
     if (!regexValidations.phone.regex.test(jsondata.phone)) {
         document.querySelector('.phoneError').classList.add('error');
         
          isValid = false;
    }

    if (isValid) {
        form.classList.add('hide');
        var confirmation = document.querySelector('#confirmation');

        var html = '<p>First Name: ' + jsondata.fname + '</p>';
        html += '<p>Last Name: ' + jsondata.lname + '</p>';
        html += '<p>Email: ' + jsondata.email + '</p>';
        html += '<p>Phone: ' + jsondata.phone + '</p>';
        html += '<p>Address1: ' + jsondata.address1 + '</p>';
        html += '<p>Address2: ' + jsondata.address2 + '</p>';
        html += '<p>City: ' + jsondata.city + '</p>';
        html += '<p>State: ' + jsondata.state + '</p>';
        html += '<p>Zip Code: ' + jsondata.zipcode + '</p>';
        html += '<p>User Name: ' + jsondata.username + '</p>';
        html += '<p>Password: ' + jsondata.password + '</p>';
        html += '<p>Confirm Password: ' + jsondata.confirmpassword + '</p>';

        confirmation.innerHTML = html;

    }

}//End Check Form
function initialize()
{
    geocoder = new google.maps.Geocoder();
    var zipcode = document.querySelector('input[name="zipcode"]');
    zipcode.addEventListener("blur", codeAddress); ///////////////////////////// 
}           //// HERE???
google.maps.event.addDomListener(window, 'load', initialize);

function codeAddress()
{
    var address = document.querySelector('input[name="zipcode"]').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            console.log(results);
            handleResults(results);
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function handleResults(results) {
    var geocodeObject = results[0];

    // declare variable for length of JSON object
    var fieldlen = geocodeObject.address_components.length;
    console.log(fieldlen);

    for (var i = 0; i < fieldlen; i++) {
        if (geocodeObject.address_components[i].types.indexOf('locality') > -1) {
            console.log(geocodeObject.address_components[i].long_name);
            console.log("This is the city.");
            var city = document.querySelector('body > form > p.cityError > input[type="text"]');
            city.value = geocodeObject.address_components[i].long_name;
        }

        if (geocodeObject.address_components[i].types.indexOf('administrative_area_level_1') > -1) {
            console.log(geocodeObject.address_components[i].short_name);
            console.log("This is the state.");
            var state = document.querySelector('body > form > p:nth-child(8) > input[type="text"]');
            state.value = geocodeObject.address_components[i].short_name;
        }


    }

}