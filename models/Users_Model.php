<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users_Model extends CI_Model{
   public function __construct(){ $this->load->database();}

   //Validating login information, returns true if a match is found in the database
   public function checkLogin($username, $pass){
      //Boolean for validating user
      $validation = FALSE;

      //Query
      $query = $this->db->get_where('Users', array('username' => $username, 'password' => sha1($pass)));

      //Search database
      if ($query->num_rows() > 0){
         $validation = TRUE;
      }

      return $validation;
   }

   //returns true if $following is following $followed, false otherwise
   public function isFollowing($follower, $followed){
      //Boolean for validating follow state
      $validation = FALSE;
      
      //Query gets data in User_Follows if they match paramaters
      $query = $this->db->get_where('User_Follows', array('follower_username' => $follower, 'followed_username' => $followed));
      if ($query->num_rows() > 0){
         $validation = TRUE; 
      }
      return $validation;
   }

   //Appends new follow information to User_Follows database
   public function follow($followed){
      //create row
      $data = array('follower_username' => $_SESSION['username'], 
                    'followed_username' => $followed);
      //Append data
      $this->db->insert('User_Follows', $data);
      
   }
}
?>