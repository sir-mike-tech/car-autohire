<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_partner = "localhost";
$database_partner = "autohire";
$username_partner = "root";
$password_partner = "";
$partner = mysql_pconnect($hostname_partner, $username_partner, $password_partner) or trigger_error(mysql_error(),E_USER_ERROR); 
?>