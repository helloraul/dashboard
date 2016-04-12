

    <?php
    session_start();
    include('connection.php');
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $contact=$_POST['contact'];
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    mysql_query("INSERT INTO member(fname, lname, contact, username, password)VALUES('$fname', '$lname', '$contact', '$username', '$password')");
    header("location: index.php?remarks=success");
    mysql_close($con);
    ?>