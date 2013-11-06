<h2> Welcome to <?=APP_NAME?>
   <?php if($user): ?>
       <?php echo $user->first_name."!"; ?>
   <?php else: ?>
   This is a site for beer makers to discuss all things related to their favorite hobby. <br>Please login or sign up!
   <?php endif; ?>

</h2>
 
