<?php
session_start();

session_unset();
session_destroy();

// kirim status logout
header("Location: ../login/login.php?logout=success");
exit;
?>