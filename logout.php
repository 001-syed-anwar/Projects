<?php
session_destroy();
session_abort();
unset($_SESSION);
header("location: login.php");
?>