<?php
// destroy the session and redirect to index(loginscreen)
session_start();
session_destroy();
header("location:index.php");

