<?php
    session_start();
    if (isset($_COOKIE["userId"])) {
        unset($_SESSION[$_COOKIE["userId"]]);
        session_destroy();
        setcookie("userId", "", time()-7200);
        echo "<script>
        alert('You have successfully logged out!');
        window.location.href = 'index.php';
        </script>";
    }
?>