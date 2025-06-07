<?php
session_start();

// Hapus session id_admin
unset($_SESSION['id_admin']);

// (Opsional) Hapus semua session
session_unset();
session_destroy();

// Redirect ke halaman login
header("Location: ../login.php");
exit;