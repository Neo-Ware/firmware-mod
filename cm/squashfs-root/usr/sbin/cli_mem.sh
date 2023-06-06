#! /bin/sh

cat /proc/cpuinfo
echo Process information:
ps -T
sched
top -b -n 1
echo Memory information:
cat /proc/meminfo
arris_memcheck.sh
echo Slab information:
cat /proc/slabinfo
echo Buddy information:
cat /proc/buddyinfo
echo Zone information:
cat /proc/zoneinfo
echo Alignment:
cat /proc/cpu/alignment
echo MTDs:
cat /proc/mtd
echo Mounts:
cat /proc/mounts
echo ICC information:
iccctl status
iccctl messages
iccctl mallocs
iccctl owners

