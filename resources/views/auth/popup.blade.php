<div id="auth-popup" class="popup-overlay" onclick="closePopup(event)">
  <div class="popup-container glass">
    <button class="close-btn" onclick="closePopup(event)">×</button>

    <!-- LOGIN -->
    <div id="login-form" class="form-box active">
      <h2>Login</h2>
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>
      
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required>
      
        <div class="form-options">
          <label><input type="checkbox" name="remember"> Remember me</label>
          <a href="#">Forgot Password?</a>
        </div>
      
        <button type="submit" class="action-btn">Login</button>
        <p>Don't have an account? <a href="#" onclick="switchForm('register')">Register</a></p>
      </form>      
    </div>

    <!-- REGISTER -->
    <div id="register-form" class="form-box">
      <h2>Register</h2>
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Username</label>
        <input type="text" name="name" placeholder="Username" required>
      
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required>
      
        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required>
      
        <label><input type="checkbox" required> Agree to terms & conditions</label>
      
        <button type="submit" class="action-btn">Register</button>
        <p>Already have an account? <a href="#" onclick="switchForm('login')">Login</a></p>
      </form>      
    </div>
  </div>
</div>
