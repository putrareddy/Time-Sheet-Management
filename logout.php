<!DOCTYPE html>
<html>
<head>
<?php
session_start();
session_destroy();
header("Location:login.php");
?>
</head>
</html>