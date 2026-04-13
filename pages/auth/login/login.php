<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Manajemen Tugas</title>
    <link rel="stylesheet" href="/taskhub/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="login-box">
    <div class="login-form">
        <div class="login-logo">
            <h1>🔐 LOGIN</h1>
            <p>Sistem Manajemen Tugas Karyawan</p>
        </div>
        <form method="POST" action="proses_login.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required autofocus>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" name="login" class="btn-login">
                LOGIN
            </button>
        </form>

        <p>Belum punya akun? <a href="../signup/signup.php">Buat disini</a></p>
    </div>
</div>

<!-- SWEETALERT -->
<?php if (isset($_GET['error'])) { ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    Swal.fire({
        title: 'Gagal Login 😢',
        text: '<?= $_GET['error']; ?>',
        icon: 'error',
        confirmButtonColor: '#ef4444'
    });
});
</script>
<?php } ?>

<?php if (isset($_GET['logout']) && $_GET['logout'] == 'success'): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Logout berhasil',
    timer: 2000,
    showConfirmButton: false
});
</script>
<?php endif; ?>

</body>
</html>