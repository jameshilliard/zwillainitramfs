#!/bin/sh 
# Zwilla Mod https://www.zwilla.de 2016
# ip dev fs
while true; do

Check_RET=`pidof lighttpd| wc -w`

echo "Check_RET ${Check_RET}" 

OFF_ON_NUM=$(grep "\" yes \"" /config/user_data/configs/account.json | wc -l)  

echo "OFF_ON_NUM ${OFF_ON_NUM}" 

C=`pidof lighttpd | wc -w`
echo $C

if [ "$C" == "1" ]; then 
	if [ "$Check_RET" = "0" ] && [ "$OFF_ON_NUM" = "1" ];
 then
 echo "restart www monitor again!"
    	killall -9 monitor-www 
    	echo 1 > /proc/sys/vm/drop_caches
		echo 2 > /proc/sys/vm/drop_caches
		echo 3 > /proc/sys/vm/drop_caches
		#/etc/init.d/lighttpd start
		
    exec /etc/init.d/monitor-www & 
    echo "restart www monitor again!"  
fi

	if  [ "$OFF_ON_NUM" = "0" ] && [ $Check_RET -gt  1 ];
 then
    killall -9 monitor-www
     echo "restart lighttpd monitor again!"
    	echo 1 > /proc/sys/vm/drop_caches
		echo 2 > /proc/sys/vm/drop_caches
		echo 3 > /proc/sys/vm/drop_caches
		/etc/init.d/lighttpd start
    exec monitor-www & 
    echo "kill kill client!"
fi 
fi
	sleep 20


done
exit 0
