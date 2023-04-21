<?php 
class Device{
    private $ip;
    private $is_on; 
    private $room_id;
    private $device_name;
    private $device_id;

    function __construct($ip, $device_name){
        $this->ip = $ip; 
        $this->device_name;
    }
    function trigger_device($switchState){
        $url = "http://". $this->ip .":/relay/0?turn=" . $switchState;
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl); 

        $switchState == "on" ? $this->is_on = true : $this->is_on = false; 
    }
    function is_reachable(){
        exec("ping -c 4 " . $this->ip, $output, $result);
        $result == 0 ? $valid = true : $valid = false; 
        return $valid;
    }
    function is_on(){
        return $this->is_on;
    }
    function set_ip($ip)
    {
        $this->ip = $ip;;
    }
    function set_device_name($name)
    {
        $this->device_name = $name;
    }
    function set_room_id($room_id)
    {
        $this->room_id = $room_id;
    }
    function set_device_id($device_id)
    {
        $this->device_id = $device_id;
    }

    // getters 
    function get_ip(){
        return $this->ip;
    }
    function get_device_name(){
        return $this->device_name;
    }
    function get_room_id(){
        return $this->room_id;
    }
    function get_device_id(){
        return $this->device_id;
    }
}
?>