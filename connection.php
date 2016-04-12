

    <?php
    $mysql_hostname = '127.0.0.1';
    $mysql_user = 'root';
    $mysql_password = '';
    $mysql_database = 'alumni';
    $prefix = "";
    $bd = mysql_connect("localhost","root","") or die("Could not connect database");
    mysql_select_db($mysql_database, $bd) or die("Could not select database");
    ?>