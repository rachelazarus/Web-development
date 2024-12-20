<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <link rel="stylesheet" href="Admin.css">
</head>
<body class="registration-background">
<a href="Adminview.php"><button type="button" class="back-btn" title="Go back">← Back</button></a>

  <div class="registration-container">
        <div class="registration-form-title">Register New Doctor</div>
        <form id="addDoctorForm" enctype="multipart/form-data">
            <div class="input-groupReg">
                <label for="profilePicture">Profile Picture</label>
                <input type="file" name="profilePicture" id="profilePicture" required />
            </div>
            <div class="input-groupReg">
                <label for="fullnameLogin">Full Name</label>
                <input type="text" name="fullname" id="fullname" required />
            </div>
            <div class="input-groupReg">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" required />
            </div>
            <div class="input-groupReg">
                <label for="specialization">Specialization</label>
                <input type="text" name="specialization" id="specialization" required />
            </div>
            <div class="input-groupReg">
                <label for="contactNumber">Contact Number</label>
                <input type="tel" name="contactNumber" id="contactNumber" required />
            </div>
            <div class="input-groupReg">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required />
            </div>
            <div class="input-groupReg">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required />
            </div>
            <div class="input-groupReg">
                <label for="availability">Availability</label>
                <select name="availability" id="availability" required>
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>
            <div class="input-groupReg">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4"></textarea>
            </div>
           
          <button type="button" class="btn" onclick="submitForm()">Register</button>
              
            
        </form>
    </div>

    <script src="Admin.js"></script>
</body>
</html>
