<?php
require_once('includes/inc.php');
$error = false;
require_once('includes/my-vars.php');
$weitergehts="yes";


session_regenerate_id(true);
$_SESSION=array();
session_write_close();

$params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"],
        $params["domain"], $params["secure"], $params["httponly"]
    );
    session_destroy();

ob_end_flush();
session_start();

if (isset($_GET['checklicensenow'])) {

  	require_once("includes/my-vars.php");
  	//shell_exec(" curl - k  " . $licserverreff . "deactivate_license&item_name=" . $item_name . "&license=" . $licensekeylog . "&url=" . $outputmacnow . "");
  	shell_exec("rm /config/user_data/configs/license-active.json 2>&1");
    

$your_email = $_COOKIE['username'];
$nowmy_URL = "https://www.zwilla.de/?edd_action=deactivate_license&item_name=";
$nowmy_item = $item_name;
$nowmy_lic = "&license=" . $_COOKIE['licensekey'];
$nowmy_mac = "&url=" . $outputmacnow;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $nowmy_URL . $nowmy_item . $nowmy_lic . $nowmy_mac);
    curl_exec($curl);
    curl_close($curl);
    unset($_COOKIE['licensekey']);
    header('Location: logout.php');

function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else
    {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';

        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}

redirect('logout.php');
  }

require_once('includes/classes/login.php');

$loginObj = new Login();
if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['licensekey']) ) {

    if ($loginObj->login(trim($_POST['username']), trim($_POST['password']), trim($_POST['licensekey']) ) !== false) {
        $_SESSION['login_string'] = hash('sha512', $_POST['password'] && $_POST['licensekey']  . $_SERVER['HTTP_USER_AGENT']);

        session_regenerate_id(true);
        session_write_close();
        ob_end_flush();
        session_start();
        setcookie( 'licensekey', $_POST['licensekey'], time() + (1209600), "/", false);
        setcookie( 'username', $_POST['username'], time() + (1209600), "/", false);
        setcookie( 'makerunningmode', 'check_now', time() + (1209600), "/", false);
        setcookie( 'readandacceptlicense', 'accepted', time() + (1209600), "/", false);

$outputmac = shell_exec("/etc/init.d/minermac.sh 2>&1");
$outputmacnow = substr($outputmac, 0, 17);


$str = file_get_contents('/config/user_data/configs/license-active.json');
$jsonresult_out = json_decode($str, true);
//$jsonresult_out = json_decode($jsonresult, true);
$weitergehts = $jsonresult_out['license'];
foreach ($jsonresult_out['data'] as $key => $value) {
    $weitergehts = $value['license'];
     $customer_email = $value['customer_email'];
      $site_count = $value['site_count'];
       $activations_left = $value['activations_left'];

    }

$str2 = file_get_contents('/config/user_data/configs/cryptoglance.json');
$jsonresult_out2 = json_decode($str2, true);
$licensekeylog = $jsonresult_out2['general']['activate']['licensekey'];


        	if ($weitergehts == 'valid' && $customer_email == $_POST['username'] && $site_count > 0)
        	{header('Location: index.php'); exit();}

        		else{
        		header('Location: miner-settings.php');
                /*
        		echo "Ergebins:" . $str . "<br>";
        		echo "Ergebins:" . $jsonresult_out . "<br>";
        		echo "Ergebins:" . $weitergehts . "<br>";
				echo "Ergebins:" . $customer_email . "<br>";
				echo "Ergebins:" . $site_count . "<br>";
				echo "Ergebins:" . $outputmacnow . "<br>";
                */

        		}
    	}

    else {
    unset($_SESSION['login_string']);
    header('Location: /old-unsecure-style/pages/index.html');
    $error = true;}

	}

session_write_close();

include("includes/login-header.php");


?>


      <div id="dashboard-wrap" class="container sub-nav login-container">
          <?php if ($_COOKIE['readandacceptlicense'] != "accepted"){ ?>
              <script type="text/javascript">
                  $(document).ready(function() {
                      $('#myModal4').modal({
                          show: true,
                      })
                  });
              </script>
          <?php } ?>

         <div id="overview" class="panel panel-primary panel-no-grid panel-overview">
            <h1>Login</h1>
            <div class="panel-heading">
               <h2 class="panel-title"><small><i class="icon icon-enteralt"></i></small></h2>
            </div>
            <div class="panel-body panel-body-overview">
               <div id="panel-login">
                  <form method="POST" class="form-horizontal" role="form" autocomplete="on">
                    <div class="form-group">
                      <label for="username" class="col-sm-offset-1 col-sm-3 control-label"><i class="icon icon-user"></i></label>

                      <div class="col-sm-4">
                        <input autocomplete="on" type="text" name="username" id="username" placeholder="your_customer_email.address.com" class="form-control" value="<?php echo $_COOKIE['username']; ?>"/>

                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-sm-offset-1 col-sm-3 control-label"><i class="icon icon-key"></i></label>
                      <div class="col-sm-4">
                        <input autocomplete="on" type="password" name="password" id="password" class="form-control" placeholder="Password"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="licensekey" class="col-sm-offset-1 col-sm-3 control-label"><i class="icon icon-key"></i></label>
                      <div class="col-sm-4">
                        <input autocomplete="on" type="licensekey" name="licensekey" id="licensekey" class="form-control" placeholder="licensekey" value="<?php echo $_COOKIE['licensekey']; ?>" />
                      </div>
                    </div>

                    <!-- /config/user_data/configs/license-active.json -->
                    <div class="form-group">
                      <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="btn btn-lg btn-warning" onClick="" ><b>Login now!</b></button>
                      </div>
                    </div>






                 </form>

                 <form method="post" class="form-horizontal" role="form" autocomplete="on">
                    <a class="btn btn-lg btn-primary" href='?checklicensenow=$result'>unregister your Miner now!</a>
                 </form>
                <a  title="without a valid license you can use only the old style without any mods" class="btn btn-lg btn-primary" href="/old-unsecure-style/pages/index.html">old style</a>

               </div>

            </div><!-- / .panel-body -->


            <div class="panel-footer">


            <div class="panel-body">
            <form class="form-horizontal" role="form">
              <fieldset>
                <div class="form-group">
                  <div class="col-sm-12">
                    <span class="help-block"><i class="icon icon-info-sign"></i>
                    Read, understand and accept these license agreements, by login and using this software you agree with all!
                    </span>
                      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal4">READ LICENSE</button>
                  </div>
                </div>
              </fieldset>
            </form>
            <br><hr>
          </div>


               <p><b>Forgot your password?</b> Well then, you'll need to delete the file <em>/configs/user_data/account.json</em>, then log in with a fresh account immediately.</p>
               <hr>
               <p><span>Still having trouble? Touch base with us on &nbsp;<a href="https://www.zwilla.de/faq-items/custom-firmware-antminer-s7/" rel="external"><i class="icon icon-googleplus"></i></a> <a href="https://www.zwilla.de/faq-items/custom-firmware-antminer-s7/" rel="external"><i class="icon icon-reddit"></i></a> <a href="https://www.zwilla.de/faq-items/custom-firmware-antminer-s7/" rel="external"><i class="icon icon-twitter"></i></a> or <a href="https://www.zwilla.de/login-2/" rel="external">join our Portal chat</a>.</span></p>
            </div>
         </div>
      </div>



<!-- Modal License-->
<div id="myModal4" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Running in Old-Mode ?</h4>
            </div>
            <div class="modal-body">
                <br>
                THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
                IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
                FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
                AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
                LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
                OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
                SOFTWARE.
                <br>

                <a
                    href="https://www.zwilla.de/faq-items/custom-firmware-antminer-s7/"
                    target="_blank">FAQ about</a><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK! I understand!</button>
                <?php setcookie( 'readandacceptlicense', 'accepted', time() + (1209600), "/", false); ?>
            </div>
        </div>

    </div>
</div>


      <!-- /container -->
      <script type="text/javascript" src="js/packages/jquery-1.12.3.min.js"></script>
      <script type="text/javascript" src="js/packages/jquery-ui-1.10.3.custom.min.js"></script>
      <script type="text/javascript" src="js/packages/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/packages/jquery.toastmessage.js"></script>
      <script type="text/javascript" src="js/packages/bootstrap-switch.min.js"></script>
      <script type="text/javascript" src="js/settings.js"></script>

      <?php if (!$loginObj->firstLogin()) { ?>
      <script type="text/javascript">
          // (Toast) First login (no account.json)
          function showToastFirstLogin() {
            var toastMsgFirstLogin = '<b>Read Carefully!</b><br>This is your first time logging into your miner. Please set a new username + password + licensekey that will serve as your credentials.';
            $().toastmessage('showToast', {
              sticky  : true,
              text    : toastMsgFirstLogin,
              type    : 'warning',
              position: 'top-center'
            });
          }

          $(document).ready(function() {
            showToastFirstLogin();
          });
    </script>
    <?php } ?>


      <?php
      if ($error) {
      ?>
      <script type="text/javascript">
          // (Toast) Login error
          function showToastLoginError() {
            var toastMsgLoginError = '<b>You shall NOT pass!</b><br>You\'ve entered incorrect credentials. (If you\'re having trouble, read the notes below the login button.)';
            $().toastmessage('showToast', {
              sticky  : true,
              text    : toastMsgLoginError,
              type    : 'error',
              position: 'top-center'
            });
          }

          $(document).ready(function() {
            showToastLoginError();
          });
      </script>
      <?php
      }
      ?>
   </body>
</html>