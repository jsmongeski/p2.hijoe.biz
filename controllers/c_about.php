<?php

class about_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "users_controller construct called<br><br>";
    } 

    public function about() {
       # Setup view
            #
       $this->template->content = View::instance('v_about');
       $this->template->title   = "About";

       # Render template
       echo $this->template;
    }

} # end of the class

?>
