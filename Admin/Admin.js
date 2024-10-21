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


document.getElementById('date-filter-input').addEventListener('change', function() {
    let selectedDate = this.value;
    let tableRows = document.querySelectorAll('#appointments-table tbody tr');

    tableRows.forEach(row => {
        let dateCell = row.children[2].innerText; // Get the date cell (3rd column)
        row.style.display = dateCell === selectedDate ? '' : 'none';
    });
});
