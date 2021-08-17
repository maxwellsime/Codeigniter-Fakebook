<html>
<head>
   <link rel='stylesheet' type= "text/css" href=<?php echo base_url('css/styles.css');?>>
   <title>Login</title>
</head>
<body>
   <div class='login_container'>
      <form action=<?php echo site_url("user/doLogin/") ?> method='POST'>
         <h1>LOGIN</h1>
         <label>Username: </label>
         <input type='text' placeholder='Enter Username' name='username' required><br>
         <label>Password: </label>
         <input type='password' placeholder='Enter Password' name='password' required>
         <!--Error message for incorrect login-->
         <br><?php if(isset($_SESSION['error'])){ echo $_SESSION['error'];} ?><br> 
         <button type='submit'>Login</button>
      </form>
   </div>
</body>
</html>