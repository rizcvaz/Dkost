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
  
  function closePopup(event) {
    if (event.target.id === 'auth-popup' || event.target.classList.contains('close-btn')) {
      const popup = document.getElementById('auth-popup');
      const container = popup.querySelector('.popup-container');
  
      // Animasi mengecil
      container.style.transform = 'scale(0.5)';
      container.style.opacity = '0';
  
      setTimeout(() => {
        popup.style.display = 'none';
        popup.classList.remove('show');
        container.style.transform = 'scale(1)';
        container.style.opacity = '1';
      }, 300);
    }
  }
  
  function switchForm(type) {
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
  
    if (type === 'register') {
      // Tambahkan animasi keluar ke kiri pada login
      loginForm.classList.add('exit-left');
  
      setTimeout(() => {
        loginForm.classList.remove('active', 'exit-left');
        registerForm.classList.add('active');
      }, 300);
    } else {
      // Tambahkan animasi keluar ke kiri pada register
      registerForm.classList.add('exit-left');
  
      setTimeout(() => {
        registerForm.classList.remove('active', 'exit-left');
        loginForm.classList.add('active');
      }, 300);
    }
  }
  


  
  