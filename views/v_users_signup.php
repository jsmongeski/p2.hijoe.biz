<?php if(isset($error)): ?>

   <?php if(!strcmp($error, "blank")) : ?>
           <p>Sorry, no blank lines allowed, please hit the back button and try again.</p>

   <?php elseif(!strcmp($error, "bademail")) : ?>
           <p>Invalid email address, please hit the back button and try again.</p>

    <?php elseif(!strcmp($error, "thanks")) : ?>
            Thanks for signing up! Please <a = "login" href='/users/login'>Login!</a>

    <?php elseif(!strcmp($error, "error")) : ?>
            Account already exists! Please try again: <a = "signup" href='/users/signup'>Signup!</a>

    <?php endif; ?>

<?php else : ?>

      <form method='POST' action='/users/p_signup'>
   
        <p>Please sign up to add your wisdom to the lore of Homebrewing!</p>
   
        First Name<br>
        <input type='text' name='first_name' autofocus="autofocus" id="first_name">
        <br><br>
   
        Last Name<br>
        <input type='text' name='last_name'>
        <br><br>
   
        Email<br>
        <input type='text' name='email'>
        <br><br>
   
        Password<br>
        <input type='password' name='password'>
        <br><br>
   
        <input type='submit' value='Sign up'>
   
      </form>
<?php endif; ?>
