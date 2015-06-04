/* John McCartney JS2015 Final  6/3/15
 * 
 * I TRIED
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var form = document.querySelector('form');

form.addEventListener('submit', checkForm);

function checkForm(e) {
    e.preventDefault();
    //declare variables
    var fullname = document.querySelector('input[name="fullname"]');
    var phone = document.querySelector('input[name="phone"]');
    var email = document.querySelector('input[name="email"]');
    var description = document.querySelector('input[name="description"]');

    //declare error variables
    var fullnameError = document.querySelector('#fullname_err');
    var phoneError = document.querySelector('#phone_err');
    var emailError = document.querySelector('#email_err');
    var descriptionError = document.querySelector('#description_err');

    var isValid = true;

    //Create for loop
    if (fullname.value === '') {
        fullnameError.innerHTML = 'Name is Empty';//Empty field error message
        isValid = false;
    } else {
        fullnameError.innerHTML = 'Please enter Name';
    }
    //using .innerhtml to output errors
    if (phone.value === '') {
        phoneError.innerHTML = 'Phone Number is Empty';//Empty field error message
        isValid = false;
    } else {
        phoneError.innerHTML = 'Enter Phone Number';
    }

    if (email.value === '') {
        emailError.innerHTML = 'Email is empty';//Empty field error message
        isValid = false;
    } else {
        emailError.innerHTML = 'Enter Email';
    }

    if (description.value === '') {
        descriptionError.innerHTML = 'Description is empty';//Empty field error message
        isValid = false;
    } else {
        descriptionError.innerHTML = 'Enter Description';
    }
    if (isValid === true) {
        form.classList.add('hide');
        var conf = document.querySelector('#confirmation');

        var html = '<p>Name: ' + fullname.value + '</p>';
        html += '<p>description: ' + description.value + '</p>';
        html += '<p>Email: ' + email.value + '</p>';
        html += '<p>Phone: ' + phone.value + '</p>';

        conf.innerHTML = html;

    }

}