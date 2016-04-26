#!/bin/sh
echo "test the miner, give the boards an kick and restart miner software again, do this if your mining stops! "
echo "."
echo "s c r e e n  - r  and sleeping for 8 seconds "
screen -r
sleep 8s
test.sh


# can be used for more options, when fpga dies, try it first before reboot?!?!
sleep 15s
ps

/etc/init.d/cgminer.sh stop

/etc/init.d/initc.sh stop

sleep 35s

/etc/init.d/initc.sh start

sleep 25s

killall -9 cgminer
killall -9 cgminer492

echo "not starting, just wait! Your mining system will come back from alone within some minutes"

echo "more options later, now no TIMEEEEEEE! Cheers Zwilla"

echo  "if nothing happens, just reboot! Automation will come soon!"

ps

screen -r

echo "now click on any menu option."

exec 2>&1
