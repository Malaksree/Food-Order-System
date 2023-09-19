<?php
include('../database/database.php');
//destory session
session_destroy();
//location allocated
header('location:'.SITEURL.'admin/login.php');
