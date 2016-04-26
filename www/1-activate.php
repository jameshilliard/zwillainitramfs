<?php
echo " ohne anführungszeichen " . $_COOKIE['fullspeedmode492a'] . "<br>";
echo " mit anführungszeichen " . $_COOKIE['fullspeedmode492a'] . "<br>";
?>


<?php if ($_COOKIE['fullspeedmode492a'] <> "Old-Mode"){ ?>
<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" onclick="$.cookie('ReadWarnings', 'yes more than twice!');" data-target="#myModal0">WARNING READ THIS!</button>
<?php } ?>

<?php echo "<br>" . "cookie:" . $_COOKIE["fullspeedmode492a"]  . "<br>";?>

    <?php  echo "licensekey" . $_COOKIE['licensekey'] . "</br>";
            echo "fullspeedmode492a" . $_COOKIE["fullspeedmode492a"].['?'].['?'] . "</br>";
            echo "username" . $_COOKIE['username'] . "</br>";
            echo "fullspeedmode492a" . htmlspecialchars($_COOKIE["fullspeedmode492a"]) . "</br>";
            echo "cryptoGlance-antminer-zwilla-mod" . $_COOKIE['cryptoGlance-antminer-zwilla-mod'] . "</br>";
    






    //
$mhz = "600";
$mhz = intval($mhz);

$mhz = dechex ($mhz);

    echo 'megaherz is: ...  ' . $mhz;
    ?>




