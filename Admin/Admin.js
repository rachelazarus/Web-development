document.addEventListener("DOMContentLoaded", function () {
    const menuLinks = document.querySelectorAll('.menu-link');
    const sections = document.querySelectorAll('.main--content');

    menuLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

        
            menuLinks.forEach(link => link.classList.remove('active'));

            this.classList.add('active');

             const view = this.getAttribute('data-view');

        
            sections.forEach(section => section.style.display = 'none');

        
            const selectedSection = document.getElementById(`${view}-view`);
            if (selectedSection) {
                selectedSection.style.display = 'block';
            }
        });
    });
});
document.getElementById('appointment-search').addEventListener('input', function() {
    let searchQuery = this.value.toLowerCase();
    let tableRows = document.querySelectorAll('#appointments-table tbody tr');

    tableRows.forEach(row => {
        let rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(searchQuery) ? '' : 'none';
    });
});

// For searching in the Doctors table
document.getElementById('doctor-search').addEventListener('input', function() {
    let searchQuery = this.value.toLowerCase();
    let tableRows = document.querySelectorAll('#doctors-table tbody tr');

    tableRows.forEach(row => {
        let rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(searchQuery) ? '' : 'none';
    });
});



document.getElementById('date-filter-input').addEventListener('change', function() {
    let selectedDate = this.value;
    let tableRows = document.querySelectorAll('#appointments-table tbody tr');

    tableRows.forEach(row => {
        let dateCell = row.children[2].innerText; // Get the date cell (3rd column)
        row.style.display = dateCell === selectedDate ? '' : 'none';
    });
});


document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        let itemId = this.dataset.id;
        let itemType = this.dataset.type; // Capture whether it's an appointment or a doctor

        // Confirm deletion
        if (confirm(`Are you sure you want to delete this ${itemType}?`)) {
            fetch('delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ 'id': itemId, 'type': itemType }) // Send both id and type
            })
            .then(response => response.text())
            .then(result => {
                if (result.trim() === 'success') {
                    // Remove the row from the table if deletion was successful
                    this.closest('tr').remove();
                    alert(`${itemType.charAt(0).toUpperCase() + itemType.slice(1)} deleted successfully.`);
                } else {
                    alert(`Failed to delete ${itemType}. Error: ${result}`);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(`An error occurred while trying to delete the ${itemType}.`);
            });
        }
    });
});
function submitForm() {
    let formData = new FormData(document.getElementById('addDoctorForm'));
    formData.append('register', '1');  // Manually add 'register' field

    fetch('AddDoctor.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("Doctor registered successfully!")) {
            alert("Doctor registered successfully!");
            document.getElementById('addDoctorForm').reset();
        } else {
            alert("Failed to register doctor: " + data);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to open modal with doctor's details
// Function to open modal with doctor's details
function openDoctorModal(doctor) {
    document.getElementById('profilePicture').src = 'images/' + doctor.Profile_picture_path;
    document.getElementById('fullname').value = doctor.Fullname;
    document.getElementById('age').value = doctor.Age;
    document.getElementById('specialization').value = doctor.Specialization;
    document.getElementById('contact_number').value = doctor.Contact_number;
    document.getElementById('email').value = doctor.email;
    document.getElementById('hire_date').value = doctor.hire_date;
    document.getElementById('availability').value = doctor.Availability ? '1' : '0';
    document.getElementById('description').value = doctor.Description;
    document.getElementById('doctor_id').value = doctor.Doctors_id;

    document.getElementById('doctorModal').style.display = "block";
}


document.getElementById('upload-pic').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePicture').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

// Close the modal
document.querySelector('.closeDoctorModal').onclick = function() {
    document.getElementById('doctorModal').style.display = "none";
}

// Handle "Save Changes" button
document.getElementById('saveChanges').onclick = function() {
    const doctorData = new FormData(document.getElementById('doctorForm'));
    doctorData.append('action', 'updateDoctor');

    fetch('update_doctor.php', { method: 'POST', body: doctorData })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            document.getElementById('doctorModal').style.display = "none";
            location.reload();
        })
        .catch(error => console.error('Error:', error));
}
// Select elements
const profilePicture = document.getElementById("profilePicture");
const uploadPicInput = document.getElementById("upload-pic");

// Event listener for file input change
uploadPicInput.addEventListener("change", function() {
    const file = this.files[0];
    
    // Ensure a file is selected
    if (file) {
        const reader = new FileReader();
        
        // Load image and display it in the img tag
        reader.onload = function(e) {
            profilePicture.src = e.target.result;
        };
        
        reader.readAsDataURL(file);
    }
});


function openPatientModal(patient) {
    console.log(patient); // Log the patient object to verify data
    document.getElementById('PatientprofilePicture').src = 'images/' + patient.Profile_picture_path;
    document.getElementById('fullname1').value = patient.Fullname || ''; // Ensure fields have fallback if data is missing
    document.getElementById('Age1').value = patient.Age || '';
    document.getElementById('Gender1').value = patient.Gender || '';
    document.getElementById('contact_number1').value = patient.Contact_number || '';
    document.getElementById('email1').value = patient.Email || '';

    document.getElementById('PatientModal').style.display = "block";
}


    document.querySelector('.closePatientModal').onclick = function() {
        document.getElementById('PatientModal').style.display = "none";
    };


