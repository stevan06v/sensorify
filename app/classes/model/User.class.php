<?php

class User
{
     private $name;
     private $lastname;
     private $username;
     private $email;
     private $password;
     private $image_dest;
     private $creation_date;
     private $login_date;
     private $phonenumber;
     private $user_id;
   

     function __construct($name, $lastname, $username, $password, $email, $image_dest)
     {
          $this->name = $name;
          $this->lastname = $lastname;
          $this->username = $username;
          $this->password = $password;
          $this->email = $email;
          $this->image_dest = $image_dest;
     }


// Setter for name
     public function setName($name) {
     $this->name = $name;
   }
 
   // Setter for lastname
   public function setLastname($lastname) {
     $this->lastname = $lastname;
   }
 
   // Setter for username
   public function setUsername($username) {
     $this->username = $username;
   }
 
   // Setter for email
   public function setEmail($email) {
     $this->email = $email;
   }
 
   // Setter for password
   public function setPassword($password) {
     $this->password = $password;
   }
 
   // Setter for image_dest
   public function setImageDest($image_dest) {
     $this->image_dest = $image_dest;
   }
 
   // Setter for creation_date
   public function setCreationDate($creation_date) {
     $this->creation_date = $creation_date;
   }
 
   // Setter for login_date
   public function setLoginDate($login_date) {
     $this->login_date = $login_date;
   }
 
   // Setter for phonenumber
   public function setPhonenumber($phonenumber) {
     $this->phonenumber = $phonenumber;
   }
 
   // Setter for user_id
   public function setUserId($user_id) {
     $this->user_id = $user_id;
   }

    // Getter for name
  public function getName() {
     return $this->name;
   }
 
   // Getter for lastname
   public function getLastname() {
     return $this->lastname;
   }
 
   // Getter for username
   public function getUsername() {
     return $this->username;
   }
 
   // Getter for email
   public function getEmail() {
     return $this->email;
   }
 
   // Getter for password
   public function getPassword() {
     return $this->password;
   }
 
   // Getter for image_dest
   public function getImageDest() {
     return $this->image_dest;
   }
 
   // Getter for creation_date
   public function getCreationDate() {
     return $this->creation_date;
   }
 
   // Getter for login_date
   public function getLoginDate() {
     return $this->login_date;
   }
 
   // Getter for phonenumber
   public function getPhonenumber() {
     return $this->phonenumber;
   }
 
   // Getter for user_id
   public function getUserId() {
     return $this->user_id;
   }
}
