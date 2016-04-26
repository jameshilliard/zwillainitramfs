#!/bin/sh
killall -9 cgminer
killall -9 cgminer492


/etc/init.d/cgminer.sh restart

sleep 8s

ps

# CGI output must start with at least empty line (or headers)
printf "Content-type: text/html\r\n\r\n"

cat <<-EOH
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="7; url=../index.php">
        <script type="text/javascript">
            window.location.href = "../index.php"
        </script>
        <title>Your folder is now clean!</title>
    </head>
     <H1>Your folder is now clean!</H1>
    <body>

        If you are not redirected automatically, follow the <a href='../index.php'>link</a>
    </body>
</html>
EOH

exec 2>&1