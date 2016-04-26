#!/bin/sh

sh /config/cgminer/FanTempChecker.conf

cat <<-EOH
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="3; url=/index.php">
        <script type="text/javascript">
            window.location.href = "/index.php"
        </script>
        
        <script type="text/javascript"> function setcookiejs() {
		$.cookie('FanTemApp', 'running');}
        window.onload = setcookiejs;
        </script>
        
        <title>App is now running, please monitor it!</title>
    </head>
     <H1>App is now running, please monitor it!</H1>
    <body>
    
       
        If you are not redirected automatically, follow the <a href='/index.php'>link</a>
    </body>
</html>
EOH

exec 2>&1
exit 0