<?php
session_start();
if (session_destroy()) {
    echo "<script>alert('Anda Berhasil logout');</script>";
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
