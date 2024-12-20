<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginAndsignUp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Login</title>
    
</head>
<body>
    

    <section class="login-section">


        <div class="welcome-text">
            <h2>Welcome Back!</h2>
            <p>Please log in to your account.</p>
        </div>

        <div class="login-form">
            
            <h2>LOGIN</h2>
           
            <form action="loginSubmit.php" method="post">
                
                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Enter First Name" required>
                </div>

                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="submit-btn">LOGIN</button>
            </form>
        </div>
        
    </section>
</body>
</html>