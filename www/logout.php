<?php
require_once('includes/inc.php');
$error = false;
$delete_old_session = true;
session_regenerate_id(true);
$_SESSION=array();
session_write_close();
        ob_end_flush();
        session_start();

unset($_SESSION["login_string"]);

session_unset();
session_destroy();


$_GET[session_name()]=$sid;
session_start();
// prove we are getting the web session data
foreach ($_SESSION as $k => $v) echo($k."=".$v);
// now kill the thief
$_SESSION['username']=null;
//web session variable now null - honestly!


session_write_close();

    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);

header('Location: login.php');
exit();
?>



