#!/bin/sh -e

file=`date +%Y-%m-%d_%H%M%S`_zwilla-mod_backup_v019.tar
dir="/config/backup/backup-$$"
#dir="/config/backup"
#bkup_files="cgminer.conf"
bkup_files="start480.txt start492overkill.txt start492.txt cgminer.conf cgminer-s7.conf FanTempChecker.conf network.conf"


trap atexit 0

atexit() {
	rm -rf $dir
cp /config/backup/$file /www/files/backup/$file
#ln -s /config/backup/$file /www/files/backup/$file
	sync
	
	if [ ! $ok ]; then
	    print "<h1>Create backup failed</h1>"
	fi
}

# CGI output must start with at least empty line (or headers)
printf "Content-type: text/html\r\n\r\n"

cat <<-EOH
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="3; url=../mybackups.php">
        <script type="text/javascript">
            window.location.href = "../mybackups.php"
        </script>
        <title>Your folder is now clean!</title>
    </head>
     <H1>Your folder is now clean!</H1>
    <body>
       
        If you are not redirected automatically, follow the <a href='../mybackups.php'>link</a>
    </body>
</html>
EOH

exec 2>&1

mkdir -p $dir
cd $dir

for f in $bkup_files ; do
    if [ -f /config/cgminer/$f ] ; then
	cp /config/cgminer/$f .
    fi
done

> ./restoreConfig.sh
echo 'mkdir -p /config/cgminer/.old_config'                      >> ./restoreConfig.sh
echo 'rm -rf /config/cgminer/.old_config/*'                      >> ./restoreConfig.sh
echo 'cd /config/cgminer/'                                       >> ./restoreConfig.sh
echo "for f in $bkup_files ; do"                         >> ./restoreConfig.sh
echo '    if [ -f $f ] ; then'                           >> ./restoreConfig.sh
echo '	    cp $f /config/cgminer/.old_config/'                  >> ./restoreConfig.sh
echo '    fi'                                            >> ./restoreConfig.sh
echo 'done'                                              >> ./restoreConfig.sh
echo 'cd - >> /dev/null'                                 >> ./restoreConfig.sh
echo 'cp * /config/cgminer/'                                     >> ./restoreConfig.sh
echo 'sync'                                              >> ./restoreConfig.sh

tar cf /config/backup/$file *
if [ $? -ne 0 ] ; then
    exit
fi
sync & 
cat <<EOT
<p>Save backup to PC.</p>
<table>
	<tr>
		<td>
			<form action="/.backup/$file">
			
			echo "" /config/backup/$file
			<p></p>
			echo $dir
			<p></p>
			echo $bkup_files
			<p></p>
			echo $f
			<p></p>
				<input class="cbi-button cbi-button-down" type="submit" name="save" value="Save" />
			</form>
		</td>
		<td style="padding-left:10px;">
			<form action="../upgrade.php">
				<input class="cbi-button cbi-button-link" type="submit" name="goback" value="Go Back" />
			</form>
		</td>
	</tr>
</table>
</fieldset>

EOT

ok=1
