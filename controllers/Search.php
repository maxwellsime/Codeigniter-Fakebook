<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller{
    public function index(){
        $this->load->view('Header');
        $this->load->view('Search');
    }
    public function dosearch(){
        //Get search information from GET
        $search = $this->input->get('string');      
        //Input-Validation on $search
        if ($search == null){echo "Please enter a search term"; return;}

        $this->load->model('Messages_Model');
        $data = $this->Messages_Model->searchMessages($search);
        $viewArr = array('results' => $data);
        
        //use ViewMessages to output data
        $this->load->view('Header');
        $this->load->view('ViewMessages', $viewArr);
    }
}

?>