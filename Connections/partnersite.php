<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_partnersite = "localhost";
$database_partnersite = "autohire";
$username_partnersite = "root";
$password_partnersite = "";
$partnersite = mysql_pconnect($hostname_partnersite, $username_partnersite, $password_partnersite) or trigger_error(mysql_error(),E_USER_ERROR); 
?>