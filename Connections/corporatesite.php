<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_corporatesite = "localhost";
$database_corporatesite = "autohire";
$username_corporatesite = "root";
$password_corporatesite = "";
$corporatesite = mysql_pconnect($hostname_corporatesite, $username_corporatesite, $password_corporatesite) or trigger_error(mysql_error(),E_USER_ERROR); 
?>