

<?php if(isset($error)): ?>
   <?php if(!strcmp($error, "blank")) : ?>
           <p>Sorry, no blank lines allowed, please hit the back button and try again.</p>
   <?php endif; ?>

   <?php if(!strcmp($error, "bademail")) : ?>
           <p>Invalid email address, please hit the back button and try again.</p>
   <?php endif; ?>

<?php else: ?>

   <!-- Make sure user is logged in: -->
   <?php if(isset($user)): ?>
      <p>Edit your profile, then press Submit:</p>
   <?php else: ?>
      Router::redirect('/');
   <?php endif; ?>


   <form method='POST' action='/users/p_editProfile'>

       Add/Change Nickname<br>
       <input type='text' name='nickname' value="<?= $user->nickname ?>">
       <br>
   
       Email<br>
       <input type='text' name='email' value="<?= $user->email ?>">
       <br>
   
       Favorite Beer<br>
       <input type='text' name='favbeer' value="<?= $user->favbeer ?>">
       <br>
  
       Bio<br>
       <input type='text' name='bio' value="<?= $user->bio ?>">
       <br>
   
       <!--Photo<br>
       <input type='text' name='photo'>
       <br>
       Password<br>
       <input type='password' name='password'>
       <br>-->
   
       <input type='submit' value='Submit'>
   
   </form>
   
<?php endif; ?>
   
