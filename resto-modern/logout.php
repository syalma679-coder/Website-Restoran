<?php
include 'koneksi.php';
session_destroy();
header("Location: login.php");