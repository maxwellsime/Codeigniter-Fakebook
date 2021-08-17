<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller{
   public function index(){
      //Without login session, redirect to login page.
      if(isset($_SESSION['username']) == FALSE){
         redirect('user/login');
      }
      else {
         //Load post view
         $this->load->view('Header');
         $this->load->view('Post');
      }
   }

   //Post message 
   public function doPost(){
      //Redirects to login page if there is no session data
      if(isset($_SESSION['username']) == FALSE){
         redirect('user/login');
      }
      //Save POST variables
      $postData = $this->input->post('post');

      $this->load->model('Messages_Model');
      $this->Messages_Model->insertMessages($_SESSION['username'], $postData);

      //Redirects to user page, showing new post
      redirect('/user/view/' . $_SESSION['username']);
   }
}
?>