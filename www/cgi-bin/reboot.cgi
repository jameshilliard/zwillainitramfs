#!/bin/sh
reboot


# CGI output must start with at least empty line (or headers)
printf "Content-type: text/html\r\n\r\n"

cat <<-EOH
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="60; url=../login.php">
        <script type="text/javascript">
            window.location.href = "../index.php"
        </script>
        <title>You will be redirected to the login screen after 60 seconds!</title>
    </head>
     <H1>System is rebooting at moment, please wait 60 seconds!</H1>
    <body>

        If you are not redirected automatically after 60 seconds, follow the <a href='../login.php'>link</a>
    </body>
</html>
EOH

exec 2>&1