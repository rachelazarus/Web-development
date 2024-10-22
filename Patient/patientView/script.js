
    const menuBars = document.getElementById('menu-bars');
    const navbar = document.querySelector('.navbar');

    menuBars.addEventListener('click', () => {
        navbar.classList.toggle('active');  // Toggle the 'active' class to show/hide the navbar
    });

