#!/bin/sh -e

# POST upload format:
# -----------------------------29995809218093749221856446032^M
# Content-Disposition: form-data; name="file1"; filename="..."^M
# Content-Type: application/octet-stream^M
# ^M    <--------- headers end with empty line
# file contents
# file contents
# file contents
# ^M    <--------- extra empty line
# -----------------------------29995809218093749221856446032--^M

file=/tmp/$$

trap atexit 0

atexit() {
	rm -rf $file
	umount $file.boot 2>/dev/null || true
	rmdir $file.boot 2>/dev/null || true
	sync
	if [ ! $ok ]; then
	    print "<h1>System upgrade failed</h1>"
	fi
}

CR=`printf '\r'`

exec 2>/tmp/upgrade_result

IFS="$CR"
read -r delim_line
IFS=""

while read -r line; do
    test x"$line" = x"" && break
    test x"$line" = x"$CR" && break
done

mkdir $file
cd $file
tar zxf -
if [ -f runme.sh ]; then
	sh runme.sh
fi

ant_result=`cat /tmp/upgrade_result`

# CGI output must start with at least empty line (or headers)
printf "Content-type: text/html\r\n\r\n"

cat <<-EOH
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="cache-control" content="no-cache" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/cascade.css" />
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery Toast Message Plugin (https://github.com/akquinet/jquery-toastmessage-plugin) styles -->
    <link href="../css/jquery.toastmessage.css" rel="stylesheet">
    <!-- jQuery Slider styles -->
    <link href="../css/slider.css" rel="stylesheet">
    <!-- Glyph Icon Font from WebHostingHub (http://www.webhostinghub.com/glyphs/) styles -->
    <link href="../css/whhg.css" rel="stylesheet">
    <!-- extend Bootstrap styles -->
    <link href="../css/bootstrap-switch.min.css" rel="stylesheet">
    <!-- Custom cryptoGlance styles -->
    <link href="../css/cryptoglance-base.css" rel="stylesheet">
    <!--/build-->
<script>
function f_submit_reboot() {
	setTimeout(function(){
		window.location.href="/login.php";
	}, 90000);
	
	jQuery.ajax({
		url: 'cgi-bin/reboot.cgi',
		type: 'GET',
		dataType: 'json',
		timeout: 30000,
		cache: false,
		data: {},
		success: function(data) {
		},
		error: function() {
		}
	});
}
function f_submit_goback() {
	window.location.href="/upgrade.php";
}
</script>
<title>Upgrade new Firmware</title>
</head>
EOH

if [ "${ant_result}" == "" ]; then
	echo "<body class=\"lang_en\" onload=\"f_submit_reboot();\">"
else
	echo "<body class=\"lang_en\">"
fi

cat <<-EOB
<p class="skiplink">
</p>

EOB

if [ "${ant_result}" == "" ]; then
	echo "<h2><a id=\"content\" name=\"content\">System Upgrade Successed</a></h2>"
	echo "<fieldset class=\"cbi-section\" id=\"cbi_apply_cgminer_fieldset\" style=\"display:block\">"
	echo "<img src=\"/resources/icons/loading.gif\" alt=\"Loading\" style=\"vertical-align:middle\" />"
	echo "<span id=\"cbi-apply-cgminer-status\">Rebooting System ...wow! All works fine if you see this line, now waiting for rebooting the system<br>&nbsp;<br>(please wait for 90 seconds or check within the next 60 seconds)</span>"
	echo "</fieldset>"
else
	echo "<h2><a id=\"content\" name=\"content\">System Upgrade Failed</a></h2>"
	echo "<fieldset class=\"cbi-section\">"
	echo "<p>"
	cat /tmp/upgrade_result
	echo "</p>"
	echo "<table>"
	echo "<tr>"
	echo "<td>"
	echo "<input class=\"cbi-button cbi-button-link btn-primary\" type=\"button\" onclick=\"f_submit_goback();\" value=\"Go Back s.... happens\" />"
	echo "</td>"
	echo "</tr>"
	echo "</table>"
	echo "</fieldset>"
	echo "</br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>"

fi

cat <<EOT

	<div class="clear"></div>

</body>
</html>
EOT

ok=1
