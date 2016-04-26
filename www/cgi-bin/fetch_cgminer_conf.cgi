#!/bin/sh
. ./cgi_lib.cgi
# firewall_setup KNC
MINER_CONF="/config/cgminer/cgminer-s7.conf"

create_dummy_conf_file()
{
(
cat <<'EOF'
{
"pools" : [
{
"url" : "x",
"user" : "x",
"pass" : "x"
}
]
}

EOF
) > /config/cgminer/cgminer-s7.conf
}

minerconfstart=
while read line; do
case "$line" in
'{'*)	# Start JSON
	break
	;;
*=*)	# Parameter setting before config
	if [ ! $minerconfstart ]; then
		> /config/cgminer/cgminer-s7.conf
		minerconfstart=1
	fi
	OIFS=$IFS
	IFS="="
	set -- $line
	name=$1
	shift
	value="`urldecode "$@"`"
	echo "$name=\"$value\"" >> /config/cgminer/cgminer-s7.conf
	IFS="$OIFS"
	;;
*)	# Special config modes
	break
	;;
esac
done

input=`echo "$line" ; cat`

if [ "${input:-null}" != "null" ] ; then
    if [ "$input" = "FactoryDefault" ] ; then
	rm -f "$MINER_CONF"
	minerconfstart=1
    elif [ "$input" = "RestartCGMiner" ] ; then
	/etc/init.d/cgminer.sh restart > /dev/null
    else
	# Perhaps this needs to be re-validated as proper JSON,
	# even though the web form will not allow to save
	# if JSON is bad
	#if /usr/bin/validJson "$input" >/dev/null; then
	    echo "$input" > /config/cgminer/cgminer-s7.conf
	#fi
    fi
fi

if [ ! -f /config/cgminer/cgminer-s7.conf ] ; then
	create_dummy_conf_file
fi

if [[ "$minerconfstart" = "1" ]]; then
    /etc/firewall_setup
fi

if [ -f /config/cgminer/cgminer-s7.conf ]; then
    cat /config/cgminer/cgminer-s7.conf
fi
cat /config/cgminer/cgminer-s7.conf
