#!/bin/sh

#Print phison F/W version only
echo $(phison PS8211 info | grep 'FW ver' | cut -f6 -d' ' | tr -d ',')


