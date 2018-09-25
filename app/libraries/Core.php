<!-- Looking at urls and pulling out what we need [example: /post/1] and decides what's the controller, view, etc.  -->

<?php 

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct() {
            // Create a url array
            $url = $this->getUrl();
            //Check if the controller file exists in the controller directory
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                //if exists, then set as current controller
                $this->currentController = ucwords($url[0]); // ucwords capitalizes the first letter
                //Unset index 0
                unset($url[0]);
            }
            // Require the current controller
            require_once('../app/controllers/' . $this->currentController . '.php');

            // Instantiate controller class
            $this->currentController = new $this->currentController;


            // Check for second part of the url
            if(isset($url[1])){
                // Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }
            
            // Set the parameters
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl() {
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/'); //to skip the ending slash
                $url = filter_var($url, FILTER_SANITIZE_URL); //shouldn't have any character that url doesn't have in general
                $url = explode('/', $url); //to separate url by slashes into url array
                return $url;
            }
        }
    }