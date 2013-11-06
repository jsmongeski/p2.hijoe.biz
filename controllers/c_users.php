<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "users_controller construct called<br><br>";
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup($error = NULL, $reason = NULL) {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

            #$this->template->content->error = $error;
            $this->template->content->error = $reason;

        # Render template
            echo $this->template;
    }

    public function p_signup() {

        # Debug: dump out results of POST to see what the form submitted
        #echo '<pre>';
        #print_r($_POST);
        #echo '</pre>';          
   

        # Check for blank fields:
        foreach($_POST as $key => $value) {
           if (empty($value)) {
               Router::redirect("/users/signup/error/blank");
           }
        }

        # Check for valid email:
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
          Router::redirect("/users/signup/error/bademail");


        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Check if this user already exists:
        $q = "SELECT email 
           FROM users 
           WHERE email = '".$_POST['email']."'"; 

        $email = DB::instance(DB_NAME)->select_field($q);
        echo "email ". $email;
        if($email ) {
           Router::redirect("/users/signup/error/error");
        }
        

        # Store created/modified timestamps with the user:
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        # Encrypt the password  
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

        # Create an encrypted token via their email address and a random string
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

        # Insert this user into the database
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name']; 
        $from = Array("name" => APP_NAME, "email" => APP_EMAIL);
        $email = $_POST['email'];
        $email = SMTP_USERNAME;
        $subject = "Welcome to ".APP_NAME."!";
        $body = "Thanks for signing up, $first_name! Your registration is confirmed. \n";


        $to[] = Array("name" => "$first_name $last_name", "email" => $email);
        $email = Email::send($to, $from, $subject, $body, true);

        Router::redirect("/users/signup/error/thanks");
    }


    public function login($error = NULL, $reason = NULL) {

       # Setup view
       $this->template->content = View::instance('v_users_login');
       $this->template->title   = "Login";

       $this->template->content->error = $reason;

       # Render template
       echo $this->template;

    }


    public function p_login() {

        # Check for blank fields:
        foreach($_POST as $key => $value) {
           if (empty($value)) {
               Router::redirect("/users/login/error/blank");
           }
        }
       if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
          Router::redirect("/users/login/error/bademail");

       # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
       $_POST = DB::instance(DB_NAME)->sanitize($_POST);
   
       # Hash submitted password so we can compare it against one in the db
       $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
   
       # Search the db for this email and password
       # Retrieve the token if it's available
       $q = "SELECT token 
           FROM users 
           WHERE email = '".$_POST['email']."' 
           AND password = '".$_POST['password']."'";
   
       $token = DB::instance(DB_NAME)->select_field($q);
   
       # If we didn't find a matching token in the database, it means login failed
       if(!$token) {
          #if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) = FALSE) 
           # Send them back to the login page
           Router::redirect("/users/login/error/badpwd");
   
       # But if we did, login succeeded! 
       } else {
   
           /* 
           Store this token in a cookie using setcookie()
           Important Note: *Nothing* else can echo to the page before setcookie is called
           Not even one single white space.
           param 1 = name of the cookie
           param 2 = the value of the cookie
           param 3 = when to expire
           param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
           */

           setcookie("token", $token, strtotime('+1 year'), '/');
   
           # Redirect to the main page:
           Router::redirect("/");
   
       }
   }

    public function logout() {

        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");

    }

    public function editprofile($error = NULL, $reason = NULL) {

        # Setup view
            $this->template->content = View::instance('v_users_editprofile');
            $this->template->title   = "Edit Profile";
            if(!$this->user) {
                Router::redirect('/');
            }

            $this->template->content->error = $reason;

            # Render template
            echo $this->template;
    }

    public function p_editprofile() {


        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
   
        $_POST['modified'] = Time::now();

        # Check for blank fields:
        foreach($_POST as $key => $value) {
           if (empty($value)) {
               Router::redirect("/users/editprofile/error/blank");
           }
        }

        # Check for valid email:
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
          Router::redirect("/users/editprofile/error/bademail");

        # Dump out the results of POST to see what the form submitted
        #echo '<pre>';
        #print_r($_POST);
        #echo '</pre>';          


        DB::instance(DB_NAME)->update("users", $_POST, "WHERE token = '".$this->user->token."'");

        # Display the new profile:
        Router::redirect("/users/profile");

    }


    public function profile() {
    
        global $profile;

        # If user is not logged in; redirect to the login page:
        if(!$this->user) {
                Router::redirect('/');
        }

        $profile['firstname'] = $this->user->first_name;
        $profile['lastname'] = $this->user->last_name;
        $profile['nickname'] = $this->user->nickname;
        $profile['email'] = $this->user->email;
        $profile['favbeer'] = $this->user->favbeer;
        $profile['bio'] = $this->user->bio;
        

        $this->template->content = View::instance('v_users_profile'); 
        $this->template->title = "Profile";

        echo $this->template;


    }      


    public function deleteUser() {
      # Our SQL command
      $q = "DELETE FROM users
          WHERE email = 'samseaborn@whitehouse.gov'";

      echo DB::instance(DB_NAME)->query($q);
    }

} # end of the class
