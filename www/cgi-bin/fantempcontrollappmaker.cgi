#!/bin/sh

cat >/config/cgminer/bitmainfanapp.sh <<\EOF
#!/bin/sh
FAN_FORCE=$(awk 'NR==1{print $1}' /config/cgminer/FanTempChecker.conf)
FAN_FORCE=$(($FAN_FORCE + 5 ))


FAN_MIN=$(awk 'NR==1{print $1}' /config/cgminer/FanTempChecker.conf);
FAN_LOW=$(awk 'NR==2{print $1}' /config/cgminer/FanTempChecker.conf);
FAN_MAX=$(awk 'NR==3{print $1}' /config/cgminer/FanTempChecker.conf);
CELSIUS_LOW=$(awk 'NR==4{print $1}' /config/cgminer/FanTempChecker.conf);
CELSIUS_MAX=$(awk 'NR==5{print $1}' /config/cgminer/FanTempChecker.conf);
CELSIUS_DIE=$(awk 'NR==6{print $1}' /config/cgminer/FanTempChecker.conf);
DELAY=$(awk 'NR==7{print $1}' /config/cgminer/FanTempChecker.conf);
#DELAY=$(($DELAY * 10 ));
DELAY="$DELAY"s

while true; do
  if [ $(ps | grep "cgminer " | grep -v 'grep cgminer' | wc -l) -gt 0 ]; then
    temp1=$(cgminer-api stats | grep temp1] | awk '{print $3}');
    temp2=$(cgminer-api stats | grep temp2] | awk '{print $3}');
    fan1=$(cgminer-api stats | grep fan1] | awk '{print $3}');
    pwm=$(grep bitmain-fan-pwm /config/cgminer/cgminer-s7.conf | awk '{print $3}' | sed -e 's/[[:punct:]]//g');
    if [ -z $temp1 ]; then
      echo -n "ZOMBIE at " && date;
    else
      maxtemp=$(( $temp1 > $temp2 ? $temp1 : $temp2 ));
      echo -n "TEMP: $maxtemp ($temp1:$temp2), FAN: $fan1 ($pwm%) at " && date;
      FAN_MOD=0;
      if [ "$FAN_FORCE" -eq "$FAN_FORCE" ] 2>/dev/null && [ $FAN_FORCE -gt $FAN_MIN ]; then
        FAN_MOD=$FAN_FORCE;
      elif [ "$FAN_FORCE" -eq "$FAN_FORCE" ] 2>/dev/null && [ $FAN_FORCE -gt 0 ]; then
        echo "SET $FAN_FORCE% ignored because is less than $FAN_MIN%." && exit;
      else
        if [ $maxtemp -gt $CELSIUS_DIE ]; then
          FAN_MOD=-1;
        elif [ $maxtemp -gt $CELSIUS_MAX ]; then
          test $pwm -ne $FAN_MAX && FAN_MOD=$FAN_MAX;
        elif [ $maxtemp -gt $CELSIUS_LOW ]; then
          test $pwm -ne $FAN_LOW && FAN_MOD=$FAN_LOW;
        else
          test $pwm -ne $FAN_MIN && FAN_MOD=$FAN_MIN;
        fi;
      fi;
      if [ $FAN_MOD -lt 0 ]; then
        echo -n "DIE at " && date && \
        /etc/init.d/cgminer.sh stop > /dev/null;
        echo 1 > /sys/class/gpio/gpio20/value && \
        sleep 3 && \
        echo 0 > /sys/class/gpio/gpio20/value;
      elif [ $FAN_MOD -gt 0 ]; then
        sed -i "/bitmain-fan-pwm/c\"bitmain-fan-pwm\" : \"$FAN_MOD\"," /config/cgminer/cgminer-s7.conf  && \
        echo -n "SET $FAN_MOD% at " && date && \
        /etc/init.d/cgminer.sh restart > /dev/null;
        test $pwm -lt $FAN_MOD && \
        echo 1 > /sys/class/gpio/gpio20/value && \
        sleep 1 && \
        echo 0 > /sys/class/gpio/gpio20/value;
        test "$FAN_FORCE" -eq "$FAN_FORCE" 2>/dev/null && test $FAN_FORCE -gt 0 && exit;
      fi;
    fi;
  else
    echo -n "DEATH at " && date;
  fi;
  sleep $DELAY;
done;
EOF

cat <<-EOH
<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="3; url=/index.php">
        <script type="text/javascript">
            window.location.href = "/index.php"
        </script>
        
        <script type="text/javascript"> function setcookiejs() {
		$.cookie('FanTemApp', 'running');}
        window.onload = setcookiejs;
        </script>
        
        <title>Now we make the App working for everyone Cheers Zwilla!</title>
    </head>
     <H1>App is now install, please monitor it!</H1>
    <body>
    
       
        If you are not redirected automatically, follow the <a href='/index.php'>link</a>
    </body>
</html>
EOH

exec 2>&1
exit 0