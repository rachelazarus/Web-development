function filterTable() {
    const searchInput = document.getElementById("search-box").value.toLowerCase();
    const table = document.getElementById("patients-table");
    const rows = table.getElementsByTagName("tr");

    // Loop through table rows and display/hide based on search input
    for (let i = 1; i < rows.length; i++) {
        const nameCell = rows[i].querySelector(".patient-info .patient-name");
        if (nameCell) {
            const nameText = nameCell.textContent.toLowerCase();
            if (nameText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}
function viewRecordDetails(recordId) {
    fetch(`getRecordDetails.php?record_id=${recordId}`)
        .then(response => response.json())
        .then(data => {
            const modalContent = `
                <h3>Record Details</h3>
                <p><strong>Date:</strong> ${data.date}</p>
                <p><strong>Diagnosis:</strong> ${data.diagnosis}</p>
                <p><strong>Doctor:</strong> ${data.doctorName}</p>
                <p><strong>Patient:</strong> ${data.patientName}</p>
                <p><strong>Prescriptions:</strong> ${data.prescriptions}</p>
            `;
            document.getElementById("recordDetails").innerHTML = modalContent;
            document.getElementById("recordModal").style.display = "block";
        })
        .catch(error => console.error('Error:', error));
}

function closeModal() {
    document.getElementById("recordModal").style.display = "none";
}
function filterTable() {
    const searchInput = document.getElementById("search-box").value.toLowerCase();
    const table = document.getElementById("records-table");
    const rows = table.getElementsByTagName("tr");

    // Loop through table rows and display/hide based on search input
    for (let i = 1; i < rows.length; i++) {
        const nameCell = rows[i].querySelector(".record-info .diagnoses");
        if (nameCell) {
            const nameText = nameCell.textContent.toLowerCase();
            if (nameText.includes(searchInput)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}