<?php

session_start();

unset($_SESSION['loginStatus']);

header("Location:default.php");