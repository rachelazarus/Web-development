const doctorName = "John Doe";
displayDoctorName(doctorName);

function displayDoctorName(name) {
    const welcomeText = document.getElementById('welcome-Doc');
    welcomeText.textContent = `Welcome Dr. ${name}`;
}


