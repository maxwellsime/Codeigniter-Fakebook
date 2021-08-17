<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_Model extends CI_Model{
   public function __construct(){ $this->load->database();}

   //Returns messages of specified username, most recent first
   public function getMessagesByPoster($name){
      $sql = "SELECT user_username, text, posted_at FROM Messages WHERE user_username = '" . $name . "' ORDER BY posted_at DESC";
      $query = $this->db->query($sql);
      return $query->result_array();
   }

   //Returns messages containing specified search string, most recent first.
   public function searchMessages($string){
      $sql = "SELECT user_username, text, posted_at FROM Messages WHERE text LIKE '%" . $string . "%' ORDER BY posted_at DESC";
      $query = $this->db->query($sql);
      return $query->result_array();
   }

   //Append message to database
   public function insertMessages($poster, $string){
      //Generate row
      $data = array(
         'user_username'=> $poster, 
         'text' => $string, 
         'posted_at' => date('Y-m-d H:i:s'));
      //Append data
      $this->db->insert('Messages', $data);
   }

   //Returns Messages from users which $name follows
   public function getFollowedMessages($name){
      //SQL query selecting messages made by users followed by $user
      $sql = "SELECT user_username, text, posted_at FROM Messages WHERE user_username IN 
             (SELECT followed_username FROM User_Follows WHERE follower_username = '" . $name . "') 
             ORDER BY posted_at DESC";
      //query users, return results
      $query = $this->db->query($sql);
      return $query->result_array();
   }
}
?>