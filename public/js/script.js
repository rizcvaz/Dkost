document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMenu = document.getElementById('closeMenu');
  
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.add('show');
    });
  
    closeMenu.addEventListener('click', () => {
      mobileMenu.classList.remove('show');
    });
  });

  // Autentikasi popup login & register
  function openPopup(type) {
    document.getElementById('auth-popup').style.display = 'flex';
    document.getElementById('login-form').classList.remove('active');
    document.getElementById('register-form').classList.remove('active');
    document.getElementById(type + '-form').classList.add('active');
  }
  
  function closePopup(event) {
    if (event.target.id === 'auth-popup' || event.target.classList.contains('close-btn')) {
      document.getElementById('auth-popup').style.display = 'none';
    }
  }
  
  function switchForm(type) {
    document.getElementById('login-form').classList.remove('active');
    document.getElementById('register-form').classList.remove('active');
    document.getElementById(type + '-form').classList.add('active');
  }
  


  
  