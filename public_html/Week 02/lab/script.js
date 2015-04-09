/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var form = document.querySelector('form');

form.addEventListener('submit', checkForm);

function checkForm(e) {
    e.preventDefault();
    var isValid = true;
    var fields = document.querySelectorAll('form p');
 
    var jsondata = {};
    

    var len = fields.length;
    
    // create the for loop
    for (var i = 0; i < len; i++) {
        var input = fields[i].querySelector('input');
        jsondata[input.name] = input.value;
        if (input.value === '') {
            fields[i].classList.add('error');
            isValid = false;
        } else {
            fields[i].classList.remove('error');
        }
    }
        console.log(jsondata);

    if (isValid === true) {
        form.classList.add('hide');
        var conf = document.querySelector('#confirmation');

    var html = '<p>First Name: ' + jsondata.fname + '</p>';
        html += '<p>Last Name: ' + jsondata.lname+ '</p>';
        html += '<p>Email: ' + jsondata.email + '</p>';
        html += '<p>Phone: ' + jsondata.phone + '</p>';
        html += '<p>Address1: ' + jsondata.address1 + '</p>';
        html += '<p>Address2: ' + jsondata.address2 + '</p>';
        html += '<p>City: ' + jsondata.city + '</p>';
        html += '<p>State: ' + jsondata.state + '</p>';
        html += '<p>Zip Code: ' + jsondata.zipcode + '</p>';
        html += '<p>User Name: ' + jsondata.username + '</p>';
        html += '<p>Password: ' + jsondata.password+ '</p>';
        html += '<p>Confirm Password: ' + jsondata.confirmpassword + '</p>';

        conf.innerHTML = html;

    }

}