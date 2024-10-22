

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../Patient/favicon/medical-check.png" type="image/x-icon">
    <title>Admin Login</title>
   
    <link rel="stylesheet" href="Admin.css" />
 
  </head>
  <body class="Loginbackground">
    
   <div class="container">
      <div class="form-wrapper">
       
        </div>
        <div class="form-container">
          <div class="form-title">ADMIN</div>
          <form method="post" action= "Login.php">
            <div class="input-group">
              <input type="text" name="username" id="username" placeholder=" " required />
              <label for="username">Username</label>
            </div>
            <div class="input-group">
              <input type="password" name="password" id="password" placeholder=" " required />
              <label for="password">Password</label>
            </div>
            <a href="../Main menu.html"><button type="button" class="cancel-btn" >Cancel</button></a>
            <button type="submit" class="btn" value="login" name="login">Login</button>
          </form>
        </div>
      </div>
    </div>
    <script src="Admin.js"></script>
  </body>
</html>

