#!/bin/sh -e

	echo 1 > /proc/sys/vm/drop_caches
	echo 2 > /proc/sys/vm/drop_caches
	echo 3 > /proc/sys/vm/drop_caches
	swapoff -a
	swapon -a
	ntpdate ptbtime1.ptb.de
	hwclock --systohc
	sync

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

        <title>Your Memory is now clean!</title>
    </head>
     <H1>Your Memory is now clean!</H1>
    <body>
       
        If you are not redirected automatically, follow the <a href='goBack()'>link</a>
    </body>
</html>



EOH

exec 2>&1