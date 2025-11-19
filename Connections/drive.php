<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_drive = "localhost";
$database_drive = "autohire";
$username_drive = "root";
$password_drive = "";
$drive = mysql_pconnect($hostname_drive, $username_drive, $password_drive) or trigger_error(mysql_error(),E_USER_ERROR); 
?>