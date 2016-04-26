#!/bin/sh
#set -x
set -e

firsttimeupgrade="leer"
zwillamod="leer"
zwillamod=$(cat /config/zwilla-mod/zwilla-mod-on.txt)  2>/dev/null  || :
firsttimeupgrade=$(cat /config/zwilla-mod/notfirsttime.txt)   2>/dev/null  || :



echo $zwillamod
echo $firsttimeupgrade

if [ -f "/config/zwilla-mod/notfirsttime.txt" ]

then
	echo "Found! Im upgrading zwilla mod"
	firsttimeupgrade=$"imupgradingzwillamod"
else
	echo "NOT found. This is my first upgrade!"
	firsttimeupgrade=$"fisttimeyes"
fi



if [ [$firsttimeupgrade == "fisttimeyes"] ]; then
		# start-stop-daemon -b -S -x screen -- -S cgminer -t cgminer -m -d "$DAEMON" --default-config /config/zwilla-mod/cgminer-zwilla.conf
        echo Es ist nicht das erste mal, also dann mit neuen Einstellungen starten 


	elif [ [$firsttimeupgrade == "fisttimeyes"] ]; then
	
	    if [! [$zwillamod == "istrue"] ]; then
	    		
			# start-stop-daemon -b -S -x screen -- -S cgminer -t cgminer -m -d "$DAEMON" $PARAMS --api-listen --default-config /config/zwilla-mod/cgminer-zwilla.conf
			echo Es ist das erste mal, also dann mit den ALTEN Einstellungen starten
		fi

	else
	echo Hier bei E L S E
fi

