#!/bin/sh

#Print phison F/W version only
echo $(phison PS7000 info | grep 'FW ver' | cut -f6 -d' ' | tr -d ',')


