#!/bin/sh

killall -9 cgminer
killall -9 cgminer492

# CGI output must start with at least empty line (or headers)
printf "Content-type: text/html\r\n\r\n"

cat <<-EOH
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="3; url=history.go(-1);">
        <script type="text/javascript">
            window.location.href = document.referrer;
        </script>
        
        
<script>
function goBack() {
    window.history.go(-1);
}
</script>

        <title>Cgminer restarted I hope!</title>
    </head>
     <H1>Cgminer restarted I hope!!</H1>
    <body>
       
        If you are not redirected automatically, follow the <a href='goBack()'>link</a>
    </body>
</html>



EOH

exec 2>&1