#! /bin/sh

echo ">>>>> Starting mccache IP tables"

# remove all setting with specific port since it can change;  it will be done in assist-mccache
#iptables -I FORWARD -p tcp -m tcp --dport 8088 -d 192.168.251.254 -j ACCEPT

#iptables -t nat -I POSTROUTING -p tcp -m tcp --dport 8088 -d 192.168.251.254 -j SNAT --to-source 192.168.251.1
#iptables -I OUTPUT 1 -d 239.255.255.250 -j DROP
#iptables -I OUTPUT 1 -d 224.0.0.251 -j DROP

# keep these for access to our specific webpages from outside
# add these to get access to atom side webserver from wan
#iptables -t nat -I PREROUTING -i erouter0 -p tcp --dport 8089 -j DNAT --to-destination 10.0.0.252
#iptables -I FORWARD -p tcp --dport 8089 -j ACCEPT

if ps | grep -v grep | grep assist-mccache > /dev/null
then
    echo "assist-mccache already running"
else
    echo "starting assist-mccache"
    assist-mccache l2sd0.4090 &
fi
