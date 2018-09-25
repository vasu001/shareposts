<!-- Default Controller that runs at homepage -->

<?php

class Pages extends Controller {
    public function __construct() {
        
    }

    public function index() {
        if(isloggedIn()){
            redirect('posts');
        }
        // Runs first at homepage
        $data =  [
            'title'=>'SharePosts',
            'description' => 'Simple social network built on PHP-MVC Framework'            
        ];
        
        $this->view('pages/index', $data);
    }

    public function about() {
        $data =  [
            'title'=>'About',
            'description' => 'App to share posts with other users'
        ];
        $this->view('pages/about', $data);
    }
}