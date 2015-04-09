/*
 * 
 * @type @exp;document@call;querySelector
 * We use the form tag to select it on the page
 */
var form = document.querySelector('form');

/*
 * 
 * @param {type} param1
 * @param {type} param2
 * 
 * To the form we add a function so when the form is
 * submmited we run checkForm
 */
form.addEventListener('submit', checkForm);


/*
 * 
 * @param {type} e
 * @returns {undefined}
 * just like variables form names are case sensitive.
 */
function checkForm(e) {
    /*
     * We will learn about this in the comming weeks
     * but this will stop the form from submmiting,
     * it's default function
     */ 
    e.preventDefault();
    var email = document.querySelector('input[name="email"]');
    
    console.log('form submited');
    // console.log is great for debuging your code
    console.log(email.value);
    
    // email has the attribute value, we use it to see if
    // a user has filled it out.
    if ( email.value === '' ) {
        
    }
    console.log(email);
    
    
}



