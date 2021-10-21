<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN PAGE</title>
    </head>
    <link rel="stylesheet" href="style.css">
 

    <body>
        <div class="container"> 

        <form id="form" action="login2.php"method="post">
           <h2>LOGIN PAGE</h2>


          <!-- <-----------(error code)---------> 
            <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	     <?php } ?>
          <!-- <----------------(End)---------------->
                
                <label>User Name</label>
                <input type="text" name="username" id="uname"placeholder="User Name"class="login" ><br>
                
                <label>Password</label>
                <input type="password" name="password" placeholder="Password"class="login" ><br>
                
                <button id="btn" name="button" value="Submit">Login</button>

            
            </form>
        </div>
        
</body>
</html>
        