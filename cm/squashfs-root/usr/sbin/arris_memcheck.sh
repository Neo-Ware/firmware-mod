#!/bin/sh
totalRss=0;
totalPss=0;
totalUss=0;

for pid in /proc/[0-9]*; do
        # get private clean, private dirty, and pss from smaps file
        # use sed to generate column output - col1 = pc, col2 = pd, col3 = pss
        # use awk to generate the total
        smaps_str=`sed -e 's/Private_Clean:[ ]*\([0-9]*\).*/\1 0 0/;t done; s/Private_Dirty:[ ]*\([0-9]*\).*/0 \1 0/;t done; s/Pss:[ ]*\([0-9]*\).*/0 0 \1/;t done;d; :done' ${pid}/smaps |
        awk '{ pc+=$1; pd+=$2; pss+=$3 } END { print pc " " pd " " pss } '`
                                   
        # stringlen = 2 is just the awk delimiters - ignore process
        if [ ${#smaps_str} -eq 2 ]; then
            continue;
        fi;
                                                       
        # get RSS 
        Rss=$((`sed -e 's/VmRSS:[ ]*[^0-9]*\([0-9]*\)[^0-9]*/\1 + /;tx;d;:x' ${pid}/status`0))
        # Get variables from awk string output
        set -- $smaps_str
                                                                          
        Uss=$(($1 + $2));
        Pss=$3
                                                                                  
        totalRss=$(($totalRss + $Rss));
        totalPss=$(($totalPss + $Pss));
        totalUss=$(($totalUss + $Uss));
                                                                                              
        echo $pid `awk '/Name/ {print $2,$3}' $pid/status` - Rss $Rss kB Pss $Pss kB Uss $Uss kB;
                                                                                                 
done                                                           
                                                                                                                                       
echo TOTAL: Rss $totalRss kB Pss $totalPss kB Uss $totalUss kB;

