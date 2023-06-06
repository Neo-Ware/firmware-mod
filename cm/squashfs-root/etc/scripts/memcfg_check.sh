#!/bin/sh

# 
# Setup memory configuration
#

# If conf file exists in /nvram, use it
# Otherwise, if file exists in /etc, use it
# Otherwise - nothing
file_name=sysctl_mem.conf
dirs="/nvram /etc"
#echo "Looking for file \"$file_name\" in directories \"$dirs\" "
for dir in $dirs
do
    use_file=${dir}/${file_name}
    #echo "Looking for \"$use_file\" "
    if [ -e $use_file ] 
    then
        echo "Setup memory config from file \"$use_file\" "
        sysctl -p $use_file
        break
    fi
done

exit 0

