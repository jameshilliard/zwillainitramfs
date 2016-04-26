<?php
include("includes/inc.php");
require_once("includes/header.php");
$generalSaveResult = "save";
include("includes/footernav.php");
unset($file480);
unset($file492);
unset($file492o);
unset($fop492);
unset($fop492o);
unset($fop480);
unset($fopfile480);
unset($fopfile492);
unset($fopfile492o);
unset($fopconf);
unset($dataconf);
unset($datastart480);
unset($datastart492);
unset($datastart492o);
unset($writefileto);
unset($readfileconf);
unset($readfilestart);

$cryptoGlance = new CryptoGlance();
$settings = $cryptoGlance->getSettings();
$getsettings = $cryptoGlance->getSettings();

setcookie('makerunningmode', $settings['general']['activate']['ridonnow']);

    function ReadConf()
    {
        $file = "/config/cgminer/cgminer-s7.conf";
        $fop = fopen ($file, "r");
        echo file_get_contents ($file);
        fclose ($fop);
        unset($file);
    }



    function ReadStart()
    {
        if (file_exists ('/config/cgminer/start480.txt')) {
            $file480 = "/config/cgminer/start480.txt";
            $fop480 = fopen ($file480, "r");
            echo file_get_contents ($file480);
            fclose ($fop480);
            unset($file480);

        }


        if (file_exists ("/config/cgminer/start492.txt") ) {
            $file492 = "/config/cgminer/start492.txt";
            $fop492 = fopen ($file492, "r");
            echo file_get_contents ($file492);
            fclose ($fop492);
            unset($file492);

        }

        if (file_exists ("/config/cgminer/start492overkill.txt") ) {
            $file492o = "/config/cgminer/start492overkill.txt";
            $fop492o = fopen ($file492o, "r");
            echo file_get_contents ($file492o);
            fclose ($fop492o);
            unset($file492o);

        }

        
    }



    function Write()
    {
        //makerunningmode = for all the same file
        $fileconf = "/config/cgminer/cgminer-s7.conf";
        $fopconf = fopen ($fileconf,"w+");
        $dataconf = $_POST[ "cgminerconf" ];
        fwrite ($fopconf, $dataconf);
        unset($dataconf);
        fclose ($fopconf);

        //makerunningmode
        if (file_exists ('/config/cgminer/start480.txt') && $_COOKIE['makerunningmode'] == "Z-Mod480" ) {
            $file480 = "/config/cgminer/start480.txt";
            $fopfile480 = fopen ($file480,"w+");
            $datastart480 = $_POST[ "cgminerstart" ];
            //echo file_put_contents($fop, $data);
            fwrite ($fopfile480, $datastart480);
            unset($datastart480);
            fclose ($fopfile480);
        }

        //makerunningmode
        if (file_exists ("/config/cgminer/start492.txt") && $_COOKIE['makerunningmode'] == "Z-Mod492" ) {
            $file492 = "/config/cgminer/start492.txt";
            $fopfile492 = fopen ($file492,"w+");
            $datastart492 = $_POST[ "cgminerstart" ];
            //echo file_put_contents($fop, $data);
            fwrite ($fopfile492, $datastart492);
            unset($datastart492);
            fclose ($fopfile492);
        }

        if (file_exists ("/config/cgminer/start492overkill.txt") && $_COOKIE['makerunningmode'] == "Overkill" ) {
            $file492o = "/config/cgminer/start492overkill.txt";
            $fopfile492o = fopen ($file492o,"w+");
            $datastart492o = $_POST[ "cgminerstart" ];
            //echo file_put_contents($fop, $data);
            fwrite ($fopfile492o, $datastart492o);
            unset($datastart492o);
            fclose ($fopfile492o);
        }
    }


?>

    <br>
    <br>
    <br>
<h1>only local Miner Settings</h1>     
<div class="panel-body panel-body-overview">

<h2> You are riding at moment on Mode:... <?php echo $settings['general']['activate']['ridonnow'];?> </h2>

        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <textarea title="Read Miner Config internal" rows="30" cols="120" name="cgminerconf"><?php ReadConf(); ?></textarea>
<br><br>
            <button class="btn btn-lg btn-success btn-saveConfig" type="submit" name="submit">Update Cgminer S7-Conf and Start Settings</button>
            <br><br>
            <textarea title="Read external Settings" rows="4" cols="160" name="cgminerstart"><?php ReadStart(); ?></textarea>

 <input type="hidden" name="submit_check" value="1"/>
 <br>
 </form>
        
    <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input class="btn btn-lg btn-warning btn-saveConfig" onClick="parent.location='cgminer-conf.php'; $.cookie('makerunningmode', 'Old-Mod');" type="submit" name="resetold" value="Reset to my old config (click 2 x)"/>
    <input type="hidden" name="resetold" value="1"/>
    </form>
</div>


<?php
if ($_POST["resetold"] )
{
    $oldfile = "/config/cgminer.conf";
    $newfile = "/config/cgminer/cgminer-s7.conf";
    copy($oldfile, $newfile);
    $generalSaveResult="save";
    echo "Cgminer-S7.conf reset";
    $file="/config/cgminer/start480.txt";
    if (file_exists($file))
    {
        unlink($file);
        unset($file);
};

$file="/config/cgminer/start492.txt";
if (file_exists($file))
{

    unlink($file);
    unset($file);
    };
    { ?>
 <script type="text/javascript"> function setcookiejs() 
    {
		$.cookie('makerunningmode', 'Old-Mod');
    }
        window.onload = setcookiejs;
</script>

<?php } }; ?>

<?php
if ($_POST["submit_check"] )
    {
        Write();
        unset($file480);
        unset($file492);
        unset($fop492);
        unset($fop480);
        unset($fopfile480);
        unset($fopfile492);
        unset($fopconf);
        unset($dataconf);
        unset($datastart480);
        unset($datastart492);
        unset($writefileto);
        unset($readfileconf);
        unset($readfilestart);
        $generalSaveResult="save";

    echo "Cgminer-S7.conf updated";
        echo "<meta http-equiv='refresh' content='0'>";
};
?>

<?php require_once("includes/footer.php");?>

<br><br><br>
</div>
   <!-- /page-container -->

<?php
    // Load Last
    $jsArray[] = 'dashboard/script';
    require_once("includes/scripts.php");
unset($file480);
unset($file492);
unset($file492o);
unset($fop492);
unset($fop492o);
unset($fop480);
unset($fopfile480);
unset($fopfile492);
unset($fopfile492o);
unset($fopconf);
unset($dataconf);
unset($datastart480);
unset($datastart492);
unset($datastart492o);
unset($writefileto);
unset($readfileconf);
unset($readfilestart);
?>
</body></html>