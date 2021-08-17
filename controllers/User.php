<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{   
   //View Messages by users
   public function view($name = null){
      //Input validation, $name is default null if no other values are passed
      if ($name == null) {echo 'No name to use for view'; return;}

      //Check for session data and $name not matching
      if (isset($_SESSION['username']) && $_SESSION['username'] != $name){
         $this->load->model('Users_Model');

         //Find if session username is following $name
         if ($this->Users_Model->isFollowing($_SESSION['username'], $name) == FALSE){
            //Set flash data to pass onto view
            $this->session->set_flashdata('following', FALSE);
         }
      }

	   //Generate Messages
	   $this->load->model('Messages_Model');
      $viewArr = array('results' => $this->Messages_Model->getMessagesByPoster($name), 'name' => $name);
      $this->load->view('Header');
      $this->load->view('ViewMessages', $viewArr);
   }

   //Login view
   public function login(){
      $this->load->view('Login');
   }

   //Login function, calls validation and generates session data
   public function doLogin(){
      //Load User_Model
      $this->load->model('Users_Model');
      //Saving POST data
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      //call checkLogin passing POST data
      if($this->Users_Model->checkLogin($username, $password) == TRUE){
         //Create session data
         $this->session->set_userdata('username', $username);
         
         redirect('user/view/'. $username);
      }
      else{
         //Create error message in Session flashdata
         $this->session->set_flashdata('error', 'Username & Password combination incorrect.');

         redirect('user/login');
      }
   }

   //Logout function used to reset session data
   public function logout(){
      //Destroy all session data
      session_destroy();
      redirect('user/login');
   }

   //Calls method to append follow information to db, redirects to followed user
   public function follow($followed){
      $this->load->model('Users_Model');
      $this->Users_Model->follow($followed);
      //invokes follow()

      redirect('user/view/' . $followed);
   }

   //List of messages from users $name follows, presented in view
   public function feed($name){
      $this->load->model('Messages_Model');
      $viewArr = array('results' => $this->Messages_Model->getFollowedMessages($name));
      $this->load->view('Header');
      $this->load->view('ViewMessages', $viewArr);
   }
}
?>