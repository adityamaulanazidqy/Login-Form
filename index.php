<!DOCTYPE html>
<!-- Source Codes By CodingNepal - www.codingnepalweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form in HTML and CSS | zy.dsgn_</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <div class="login_form">
    <!-- Login form container -->
    <form action="assets/php/login.php">
      <h3>Log in with</h3>

      <div class="login_option">
        <!-- Google button -->
        <div class="option">
          <a href="#">
            <img src="assets/logos/google.png" alt="Google" />
            <span>Google</span>
          </a>
        </div>

        <!-- Apple button -->
        <div class="option">
          <a href="#">
            <img src="assets/logos/apple.png" alt="Apple" />
            <span>Apple</span>
          </a>
        </div>
      </div>

      <!-- Login option separator -->
      <p class="separator">
        <span>or</span>
      </p>

      <!-- Email input box -->
      <div class="input_box">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="Enter email address" required />
      </div>

      <!-- Paswwrod input box -->
      <div class="input_box">
        <div class="password_title">
          <label for="password">Password</label>
          <a href="#">Forgot Password?</a>
        </div>

        <input type="password" id="password" placeholder="Enter your password" required />
      </div>

      <!-- Login button -->
      <button type="submit">Log In</button>

      <p class="sign_up">Don't have an account? <a href="signup.php">Sign up</a></p>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.querySelector("form").addEventListener("submit", function(e) {
      e.preventDefault(); // Mencegah form submit tradisional

      let email = document.getElementById("email").value;
      let password = document.getElementById("password").value;

      // Buat permintaan AJAX
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "assets/php/login.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = function() {
        if (this.status === 200) {
          let response = JSON.parse(this.responseText);
          if (response.status === "success") {
            // SweetAlert2 saat login berhasil
            Swal.fire({
              icon: 'success',
              title: 'Login Berhasil!',
              text: 'Anda akan diarahkan ke dashboard.',
              timer: 2000,
              showConfirmButton: false
            }).then(() => {
              window.location.href = "assets/html/test.html"; // Sesuaikan dengan halaman tujuan setelah login
            });
          } else {
            // SweetAlert2 untuk kesalahan
            Swal.fire({
              icon: 'error',
              title: 'Login Gagal',
              text: response.message
            });
          }
        }
      };

      // Kirim data form
      xhr.send("email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
    });
  </script>
</body>

</html>