#!/bin/sh
#set -x

# Zwilla Mod https://www.zwilla.de 2016
# ip 60 fully working
# /etc/init.d/monitor-www.sh > /dev/null 2>&1 &
# ps -p "$$" -o etimes=


check_inter="1s"
echo $check_inter
while true; do

	echo s l e e p $check_inter
	
	sleep $check_inter
	
	date
	# not ps -x
	lighttpd_moni="$(ps -x| grep lighttpd | grep -v 'grep lighttpd')"
	

	echo $lighttpd_moni 
	
	if [ -z "$lighttpd_moni" ] ; then
	    killall -s 9 php-cgi
	    killall -s 9 rrdtool
	# killall -s 9 dropbear
	echo d r o p _ c a c h e s 1
	    echo 1 > /proc/sys/vm/drop_caches
	echo d r o p _ c a c h e s 2
		echo 2 > /proc/sys/vm/drop_caches
	 echo d r o p _ c a c h e s 3
		echo 3 > /proc/sys/vm/drop_caches
	 echo s w a p o f f
		swapoff -a
	 echo s w a p o n
		swapon -a
	 echo n t p d a t e
		ntpdate ptbtime1.ptb.de > /dev/null 2>&1 &
	 echo h w c l o c k
		hwclock --systohc > /dev/null 2>&1 &
	 echo s y n c
		sync
	 echo s l e e p
		
	 echo l i g h t t p s t a r t
		/etc/init.d/lighttpd start > /dev/null 2>&1 &
	echo s l e e p 1 0 s
	 sleep 10
	 echo e l s e   c h e c k
	else
	 echo e l s e   a c t i v
		if [ "$check_inter" == "1s" ]; then
		    echo t i m e i s 1s
			check_inter="1m"
			echo t i m e 1 0 m
			
			continue
		fi
	fi
echo d o n e 
done