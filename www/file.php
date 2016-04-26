<?php

// configuration
//$url = 'filee.php';
$file = '/etc/init.d/cgminer.sh';

// check if form has been submitted
if (isset($_POST['text']))
{
    // save the text contents
    file_put_contents($file, $_POST['text']);

    // redirect to form again
    header(sprintf('Location: %s', $url));
    printf('<a href="%s">Moved</a>.', htmlspecialchars($url));
    exit();
}

// read the textfile
$text = file_get_contents($file);

?>
<!-- HTML form -->
<form action="" method="post">
<textarea name="text"><?php echo htmlspecialchars($text) ?></textarea>
<input type="submit" />
<input type="reset" />
</form>

<!-- HTML form -->
<form method="post" action="">
<textarea name="zw_freq_value_v"><?php echo "650" ?></textarea>
<textarea name="zw_volt_v"><?php echo "0706" ?></textarea>
<textarea name="zw_timeout_v"><?php echo "7" ?></textarea>
<input type="submit" value="save" name="submit"/>
<input type="reset" />
<button class="btn" onclick="mhz("$zw_freq_value_v, zw_volt_v, zw_timeout_v);">Add</button>
</form>

<?php
function foo ($arg_1, $arg_2, $arg_n)
{
    echo "Beispielfunktion.\n";
    return $retval;
}
?>

<?php

function mhz ($zw_freq_value, $zw_volt, $zw_timeout)
{
$str = '';
$lines = file("/etc/init.d/cgminer.sh");
foreach($lines as $line_no=>$line_txt)
{
$line_no += 1; // Start with zero 
//check the line number and concatenate the string 
if($line_no == 105)
{
// Append the $str with your replaceable text
print "Hello world!=" && $zw_freq_value; 
}
else{
$str .= $line_txt."\n";
}
}
// Then overwrite the $str content to same file
file_put_contents("/etc/init.d/cgminer.sh", $str);
}

function schreiben ($zw_freq_value, $zw_volt, $zw_timeout)
{
$file = "/etc/init.d/cgminer.sh";
$fh = fopen($file,'r+');

// string to put username and passwords
$zw_freq_value = '';
$zw_volt = '';
$zw_timeout = '';

while(!feof($fh)) {

    $user = explode(',',fgets($fh));

    // take-off old "\r\n"
    $freq_value = trim($freq_value[105]);
    $zw_volt = trim($user[106]);
     $zw_timeout = trim($timeout[107]);

    // check for empty indexes
    if (!empty($username) AND !empty($password)) {
        if ($username == 'mahdi') {
            $password = 'okay';
        }

        $users .= $username . ',' . $password;
        $users .= "\r\n";
     }
}

// using file_put_contents() instead of fwrite()
file_put_contents('/etc/init.d/cgminer.sh', $users);

fclose($fh);
}
?>