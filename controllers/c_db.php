<?php

   public function lastQuery() {

      echo DB::instance(DB_NAME)->last_query();
    }
    public function insertUser(first,last,email) {

        $data = Array(
                'first_name' => $first, 
                'last_name' = $last, 
                'email' => $email);

        /*
        Insert requires 2 params
        1) The table to insert to
        2) An array of data to enter where key = field name and value = field data

        The insert method returns the id of the row that was created
        */
        $user_id = DB::instance(DB_NAME)->insert('users', $data);

        echo 'Inserted a new row; resulting id:'.$user_id;

/*
      $q = "INSERT INTO users SET 
          first_name = 'Sam', 
          last_name = 'Seaborn',
          email = 'seaborn@whitehouse.gov'";

      # Run the command
      echo DB::instance(DB_NAME)->query($q);
 */
    }      

    public function updateUser() {

      $q = "UPDATE users
      SET email = 'samseaborn@whitehouse.gov'
      WHERE email = 'seaborn@whitehouse.gov'";

      # Run the command
      echo DB::instance(DB_NAME)->query($q);
    }
   
    public function deleteUser() {
      # Our SQL command
      $q = "DELETE FROM users
          WHERE email = 'samseaborn@whitehouse.gov'";

      echo DB::instance(DB_NAME)->query($q);
    }
?>
