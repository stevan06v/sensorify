<?php

require_once "./classes/model/Address.class.php";

class User
{

     private $name;
     private $lastname;
     private $username;
     private $password;
     private $email;
     private $image_dest;
     private $addres;


     function __construct($name, $lastname, $username, $password, $email, $image_dest)
     {
          $this->name = $name;
          $this->lastname = $lastname;
          $this->username = $username;
          $this->password = $password;
          $this->email = $email;
          $this->image_dest = $image_dest;
     }

     //getters
     function getName()
     {
          return $this->name;
     }
     function getLastname()
     {
          return $this->lastname;
     }
     function getUsername()
     {
          return $this->username;
     }
     function getPassword()
     {
          return $this->password;
     }
     function getEmail()
     {
          return $this->email;
     }
     function getImageDest()
     {
          return $this->image_dest;
     }

     //setters 
     function setImageDest($image_dest){
          $this->image_dest = $image_dest;
     }

}
