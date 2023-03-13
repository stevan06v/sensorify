<?php
require_once 'Net/IPv4.php';

// Get the IP address of the current machine
$current_ip = Net_IPv4::getIp(false);

// Get the network address and subnet mask of the current network
$network_address = Net_IPv4::parseAddress("$current_ip/24");
$subnet_mask = $network_address->subnet;

// Get all IP addresses on the current network
$ips = array();
for ($i = 1; $i <= 254; $i++) {
  $ip = long2ip(ip2long($network_address->network) + $i);
  $ips[] = $ip;
}

// Output the list of IPs
echo "<pre>";
print_r($ips);
echo "</pre>";
?>