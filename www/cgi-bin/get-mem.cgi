#!/bin/sh

echo {

#Read system memory
ant_mem_total=
ant_mem_used=
ant_mem_free=
ant_mem_buffers=
ant_mem_cached=

ant_tmp=`free | grep Mem:`
ant_tmp=${ant_tmp/Mem:/}
i=0
for ant_var in ${ant_tmp}
do
	case ${i} in
		0 )
		ant_mem_total=${ant_var}
		;;
		1 )
		ant_mem_used=${ant_var}
		;;
		2 )
		ant_mem_free=${ant_var}
		;;
		3)
		ant_mem_cached=${ant_var}
		;;
		4 )
		ant_mem_buffers=${ant_var}
		;;
	esac
	i=`expr $i + 1`
done;

echo \"mem_total\":\"${ant_mem_total}\",
echo \"mem_used\":\"${ant_mem_used}\",
echo \"mem_free\":\"${ant_mem_free}\",
echo \"mem_buffers\":\"${ant_mem_buffers}\",
echo \"mem_cached\":\"${ant_mem_cached}\"

echo }
