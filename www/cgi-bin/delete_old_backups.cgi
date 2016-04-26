#!/bin/sh -e

file=zwilla-mod_backup_v019_`date +%Y-%m-%d_%H%M%S`.tar
dir=/www/files/backup
bkup_files="*.tar" 2>&1


find /www/files/backup -name *.tar | xargs rm
find /config/backup -name *.tar | xargs rm

#rm $dir/$bkup_files
#rm -rf /config/backup
#mkdir -p /config/backup
#chmod 777 /config/backup*
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

        <title>Your folder is now clean!</title>
    </head>
     <H1>Your folder is now clean!</H1>
    <body>
       
        If you are not redirected automatically, follow the <a href='goBack()'>link</a>
    </body>
</html>



EOH

exec 2>&1