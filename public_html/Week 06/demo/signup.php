<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        /*
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            
                        
            if( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' ) {
                $dbConfig = array(
                    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=JSadvClassSpring2015',
                    "DB_USER"=>'root',
                    "DB_PASSWORD"=>''
                    );

                $db = new PDO($dbConfig['DB_DNS'], $dbConfig['DB_USER'], $dbConfig['DB_PASSWORD']);            

                $stmt = $db->prepare("INSERT INTO login SET email = :email and password = :password"); 
                
                $password = sha1($password);
                
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                
                
               if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
                   echo '<p>Signup complete</p>';
               } else {
                   echo '<p>Please try again</p>';
               }
            }
        */
        
        ?>
        
        
        <h2>Sign up</h2>
         <form action="#" method="post">            
            <p class="usernameError">
                <label>User Name</label>
                <input name="username" type="text" value="" />
                <span class="hide">*</span>
            </p>
            <p class="passwordError">
                <label>Password</label>
                <input name="password" type="text" value="" />
                <span class="hide">*</span>
            </p>  
            <p class="confirmPasswordError">
                <label>Confirm Password</label>
                <input name="confirmPassword" type="text" value="" />
                <span class="hide">*</span>
            </p>
           
            <input type="submit" value="Submit" />
                    
        </form>
        
        <div id="confirmation"></div>
        
        
        <script type="text/javascript">
        
        var form = document.querySelector('form');

        form.addEventListener('submit', checkForm);

        function checkForm(e) {
            e.preventDefault();
            
             var inputs = document.querySelectorAll('input');
             
             var i = inputs.length;
             
             data = '';
             while ( i-- ) {
                 if ( inputs[i].name && inputs[i].name !== 'confirmPassword' ) {
                    data += ':' +inputs[i].name + '=' + inputs[i].value + '&';
                 }
                 
             }
             data = data.slice(0, -1);
             console.log(data);
             makeCall(data);
        }
        
        
        
        function makeCall(data) {                
                var verb = 'POST';
                var xmlhttp = new XMLHttpRequest();
                var url = 'save.php';

                xmlhttp.open(verb, url, true);

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === 4 ) {

                        console.log(xmlhttp.responseText);
                        var data = JSON.parse(xmlhttp.responseText);
                        
                        document.querySelector('#confirmation').innerHTML = data.message;
                                
                        
                    } else {
                        // waiting for the call to complete
                    }
                };
                
                 if ( verb === 'GET' ) {
                      xmlhttp.send(null);
                 } else {
                    xmlhttp.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                    xmlhttp.send(data);
                }
            }
        
        
        </script>
    </body>
</html>
