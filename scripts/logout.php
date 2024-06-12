<?php
session_start();
unset($_SESSION['user']);
header('Location: ../layouts/login.php');