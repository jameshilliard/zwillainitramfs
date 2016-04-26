#!/bin/sh

PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
DAEMON=/usr/bin/cgminer
NAME=cgminer
DESC="Cgminer daemon"
CONFIG_NAME="/config/asic-freq.config"
USER_SETTING="/config/user_setting"
EXTERNAL_OPT=""
havestart=0
set -e
#set -x
test -x "$DAEMON" || exit 0

# modded by zwilla 2016

do_start() {
	# gpio1_16 = 48 = net check LED
	if [ ! -e /sys/class/gpio/gpio48 ]; then
		echo 48 > /sys/class/gpio/export
	fi
	echo low > /sys/class/gpio/gpio48/direction

	gateway=$(route -n | grep 'UG[ \t]' | awk '{print $2}')
	if [ x"" == x"$gateway" ]; then
		gateway="192.168.178.1"
	fi	
	if [ "`ping -w 1 -c 1 $gateway | grep "100%" >/dev/null`" ]; then                                                   
		prs=1                                                
		echo "$gateway is Not reachable"                             
	else                                               
	    prs=0
		echo "$gateway is reachable" 	
	fi                    
	#ping $gateway -W1 -c1 & > /dev/null
	#prs=$?
	if [ $prs = "0" ]; then
		echo heartbeat > /sys/class/leds/beaglebone:green:usr3/trigger
		echo 1 > /sys/class/gpio/gpio48/value	
	else
		echo none > /sys/class/leds/beaglebone:green:usr3/trigger
		return
	fi
	sleep 5s
	if [ -z  "`lsmod | grep bitmain_spi`"  ]; then
		echo "No bitmain-asic"
		insmod /lib/modules/`uname -r`/kernel/drivers/bitmain/bitmain_spi.ko
	else
		echo "Have bitmain-asic"
		rmmod bitmain_spi.ko
		sleep 1
		insmod /lib/modules/`uname -r`/kernel/drivers/bitmain/bitmain_spi.ko fpga_ret_prnt=0 rx_st_prnt=0

	fi

	
	if [ -f /config/cgminer/start492.txt ]; then
	havestart=1
	echo "Starting cgminer 4.9.2. zwilla mod"
	DAEMON=/usr/bin/cgminer
	PARAMS=""
	EXTERNAL_OPT=$(cat /config/cgminer/start492.txt)
	echo "Starting 492 style zwilla Mod" $PARAMS
	echo "$DAEMON" $EXTERNAL_OPT --default-config /config/cgminer/cgminer-s7.conf
	start-stop-daemon -b -S -x screen -- -S cgminer -t cgminer -m -d "$DAEMON" $EXTERNAL_OPT --default-config /config/cgminer/cgminer-s7.conf
	fi
	
	if [ -f /config/cgminer/start492overkill.txt ]; then
	havestart=1
	echo "Starting cgminer 4.9.2. zwilla mod overkill"
	DAEMON=/usr/bin/cgminer492
	PARAMS=""
	EXTERNAL_OPT=$(cat /config/cgminer/start492overkill.txt)
	echo "Starting start492overkill zwilla Mod" $PARAMS
	echo "$DAEMON" $EXTERNAL_OPT --default-config /config/cgminer/cgminer-s7.conf
	start-stop-daemon -b -S -x screen -- -S cgminer -t cgminer -m -d "$DAEMON" $EXTERNAL_OPT --default-config /config/cgminer/cgminer-s7.conf
	fi
	
	if [ -f /config/cgminer/start480.txt ]; then
	havestart=1
	echo "Starting 480 cgminer"
	DAEMON=/usr/bin/cgminer
	EXTERNAL_OPT=$(cat /config/cgminer/start480.txt)
	echo "Starting 480 style zwilla Mod" $PARAMS
	start-stop-daemon -b -S -x screen -- -S cgminer -t cgminer -m -d "$DAEMON" $EXTERNAL_OPT --default-config /config/cgminer/cgminer-s7.conf 
	fi
	
	
	if [ ! -f /config/cgminer/start480.txt ] && [ ! -f /config/cgminer/start492.txt ] && [ ! -f /config/cgminer/start492overkill.txt ]; then
	havestart=1
	DAEMON=/usr/bin/cgminer
	echo "run in old style mode"
	freq_value=0782
	chip_value=200
	chip_num=40
	freq_m=$(($chip_value * 1000))                                                                           
	timeout=$((2 ** (32 - 8) * (256 / $chip_num) / freq_m / 64))                                            
	echo $timeout

	queue_value=8192
	echo " queue_vale=$queue_value"
	
	if [ -z $queue_value ]; then
		queue_value=8192
	fi
	
	PARAMS="--bitmain-dev /dev/bitmain-asic --bitmain-options 115200:32:8:$timeout:$chip_value:$freq_value:0725 --bitmain-checkn2diff --bitmain-hwerror --version-file /usr/bin/compile_time --queue $queue_value"
	echo "Starting old style" $PARAMS
	start-stop-daemon -b -S -x screen -- -S cgminer -t cgminer -m -d "$DAEMON" $PARAMS --api-listen --default-config /config/cgminer/cgminer-s7.conf

	fi
	#41
	

	 #/mnt/mmc1/cgminer.conf your old config
	 if [ havestart=0 ] && [ ! -f /config/cgminer/cgminer-s7.conf ] && [ -f /mnt/mmc1/cgminer.conf ]; then
	havestart=1
	DAEMON=/usr/bin/cgminer
	echo "run in old style mode"
	freq_value=0782
	chip_value=200
	chip_num=40
	freq_m=$(($chip_value * 1000))                                                                           
	timeout=$((2 ** (32 - 8) * (256 / $chip_num) / freq_m / 64))                                            
	echo $timeout

	queue_value=8192
	echo " queue_vale=$queue_value"
	
	if [ -z $queue_value ]; then
		queue_value=8192
	fi
	
	PARAMS="--bitmain-dev /dev/bitmain-asic --bitmain-options 115200:32:8:$timeout:$chip_value:$freq_value:0725 --bitmain-checkn2diff --bitmain-hwerror --version-file /usr/bin/compile_time --queue $queue_value"
	echo "Starting old style" $PARAMS
	start-stop-daemon -b -S -x screen -- -S cgminer -t cgminer -m -d "$DAEMON" $PARAMS --api-listen --default-config /mnt/mmc1/cgminer.conf

	fi

}

do_stop() {
        killall -9 cgminer || true
        killall -9 cgminer492 || true
}
case "$1" in
  start)
        echo -n "Starting $DESC: "
	do_start
        echo "$NAME."
        ;;
  stop)
        echo -n "Stopping $DESC: "
	do_stop
        echo "$NAME."
        ;;
  restart|force-reload)
        echo -n "Restarting $DESC: "
        do_stop
        do_start
        echo "$NAME."
        ;;
  *)
        N=/etc/init.d/$NAME
        echo "Usage: $N {start|stop|restart|force-reload}" >&2
        exit 1
        ;;
esac

exit 0
