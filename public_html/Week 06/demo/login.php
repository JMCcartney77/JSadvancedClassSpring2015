<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
       
        
         <h2>Log in</h2>
        <form action="#" method="post">
            
            Username : <input name="username" type="text" value="" /> <br />
            Password : <input name="password" type="password" /> <br />
            <br />
            
            <input type="submit" value="submit" />
            
        </form>
        
         <div id="confirmation"></div>
         
         <script type="text/javascript">
        
        var form = document.querySelector('form');

        form.addEventListener('submit', checkForm);

        function checkForm(e) {
            e.preventDefault();
            
             var username = document.querySelector('input[name="username"]');
             var password = document.querySelector('input[name="password"]');
             
             var data = 'username='+username.value+'&password='+password.value;
           
             makeCall(data);
        }
        
        
        
        function makeCall(data) {                
                var verb = 'POST';
                var xmlhttp = new XMLHttpRequest();
                var url = 'find.php';

                xmlhttp.open(verb, url, true);

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === 4 ) {

                        console.log(xmlhttp.responseText);
                        var data = JSON.parse(xmlhttp.responseText);
                         
                        document.querySelector('form').style.display = 'none';
                        
                        document.querySelector('#confirmation').innerHTML = data.data.username;
                        
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

        