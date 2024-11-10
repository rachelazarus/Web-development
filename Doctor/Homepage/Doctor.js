
function displayDoctorName(name) {
    const welcomeText = document.getElementById('welcome-Doc');
    welcomeText.textContent = `Welcome Dr. ${name}`;
}


document.querySelectorAll(".sidebar ul li a").forEach(link => {
    link.addEventListener("click", function(e) {
        e.preventDefault();
        const sectionId = e.target.getAttribute("href").substring(1);

        document.querySelectorAll(".main-content section").forEach(section => {
            section.classList.remove("active");
        });

        document.getElementById(sectionId).classList.add("active");
    });
});
