<?php
    session_start();
    $_SESSION['LAST_ACTIVITY'] =time();
    echo "Session refreshed";
?>