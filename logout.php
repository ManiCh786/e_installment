<?php
session_start();
if ($_SESSION['Logged_in'] = true) {
    session_unset();
}

echo "<script>
window.location='login.php';
</script>";
