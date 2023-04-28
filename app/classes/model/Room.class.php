<?php

class Room{
    private $user_id;
    private $room_id; 
    private $room_name;
    private $room_image;
    private $creation_date;
    

    function __construct($room_name, $user_id, $room_image){
        $this->room_name = $room_name;
        $this->user_id = $user_id;
        $this->room_image = $room_image;
    }


    public function get_creation_date() {
        return $this->creation_date;
    }
    
    public function set_creation_date($date) {
        $this->creation_date = $date;
    }
      
    public function get_room_image() {
        return $this->room_image;
    }

    public function get_formatted_creation_date(){
        $dateString = $this->get_creation_date();
        $dateTime = new DateTime($dateString);
        return $dateTime->format('d.m.Y');
    }
    
    public function set_room_image($image) {
    $this->room_image = $image;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    public function get_room_id() {
        return $this->room_id;
    }

    public function set_room_id($room_id) {
        $this->room_id = $room_id;
    }

    public function get_room_name() {
        return $this->room_name;
    }

    public function set_room_name($room_name) {
        $this->room_name = $room_name;
    }

}
