<?php
session_start();
session_destroy();
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
//header("Location: ../index.php");
