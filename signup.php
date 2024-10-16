<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up Form in HTML and CSS | zy.dsgn_</title>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <div class="login_form">
        <!-- Sign Up form container -->
        <form action="assets/php/prosesSignup.php" method="POST">
            <h3>Sign Up with</h3>

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
                <input type="email" id="email" name="email" placeholder="Enter email address" required />
            </div>

            <!-- Password input box -->
            <div class="input_box">
                <div class="password_title">
                    <label for="password">Password</label>
                </div>
                <input type="password" id="password" name="password" placeholder="Enter your password" required />
            </div>

            <!-- Confirm Password input box -->
            <div class="input_box">
                <div class="password_title">
                    <label for="confirm_password">Confirm Password</label>
                </div>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password"
                    required />
            </div>

            <!-- Sign Up button -->
            <button type="submit">Sign Up</button>

            <p class="sign_up">Already have an account? <a href="index.php">Log In</a></p>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault(); // Mencegah submit form secara tradisional

            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let confirm_password = document.getElementById("confirm_password").value;

            // Buat permintaan AJAX
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "assets/php/prosesSignup.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (this.status === 200) {
                    let response = JSON.parse(this.responseText);

                    if (response.status === "success") {
                        // SweetAlert2 saat berhasil daftar
                        Swal.fire({
                            icon: 'success',
                            title: 'Sign Up Berhasil!',
                            text: 'Akun Anda berhasil dibuat. Silakan login.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = "index.php"; // Alihkan ke halaman login
                        });
                    } else {
                        // SweetAlert2 saat gagal daftar
                        Swal.fire({
                            icon: 'error',
                            title: 'Sign Up Gagal',
                            text: response.message
                        });
                    }
                }
            };

            // Kirim data form
            xhr.send("email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password) + "&confirm_password=" + encodeURIComponent(confirm_password));
        });
    </script>
</body>

</html>