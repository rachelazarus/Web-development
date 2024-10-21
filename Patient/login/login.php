
<section class="login">
      <div class="login-container">

      <!-- <?php
      if(isset($_POST)){
        $email = $_POST("email");
        $password = $_POST["password"];

        require_once "database.php";
        $sql = "SELECT * FROM patients WHERE email = '$email'";
        $result = mysqli_query($conn,$sql);
        $patient = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if($patient){
         if(password_verify($password, $patient["password"])){
          #header("Location: index.");
         }
        }
        else{
          echo "div class= 'alert alert-danger'>Email does not match";
        }
      }
?> -->
        <h1>Login</h1>
        <br>
        <div class="input-group">
          <form action="./Patient.php" method="post">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" required placeholder="example@gmail.com">

            <label for="password"> password</label>
            <input type="password" name="password" id="password" required placeholder="********">
        </div>
        <a href="#forgotPassword">Forgot password</a>
        <button class="login-btn" value="Login" type="submit">Login</button>
        </form>
      </div>
    </section>
  </main>