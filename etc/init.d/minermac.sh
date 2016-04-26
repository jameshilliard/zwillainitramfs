MAC=`LANG=C cat /sys/class/net/eth0/address`
#MACMINER=`echo $MAC | tr '[a-z]' '[A-Z]'`
MACMINER=$MAC
echo $MACMINER