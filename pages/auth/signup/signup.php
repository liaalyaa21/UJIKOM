<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - Sistem Manajemen Tugas</title>
    <link rel="stylesheet" href="/taskhub/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="login-box">
        <div class="login-form">
            <div class="login-logo">
                <img src="/taskhub/assets/img/tasks.png" alt="Logo" style="width:100px; margin-bottom:10px;">
                <h1>🔐 BUAT AKUN</h1>
                <p>Sistem Manajemen Tugas</p>
            </div>
            <form method="POST" action="proses_signup.php">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username" required autofocus>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
                
                <button type="submit" name="login" class="btn-login">
                    BUAT
                </button>
            </form>
            <p>Sudah punya akun? <a href="../login/login.php">Login disini</a> </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ERROR -->
    <?php if (isset($_GET['error'])) { ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: 'Gagal 😢',
            text: '<?= $_GET['error']; ?>',
            icon: 'error',
            confirmButtonColor: '#ef4444'
        });
    });
    </script>
    <?php } ?>

    <!-- SUCCESS -->
    <?php if (isset($_GET['success'])) { ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            title: 'Berhasil ✨',
            text: 'Akun berhasil dibuat!',
            icon: 'success',
            confirmButtonColor: '#7c3aed'
        }).then(() => {
            window.location.href = "../login/login.php";
        });
    });
    </script>
    <?php } ?>

</body>
</html>