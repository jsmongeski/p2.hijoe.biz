<?php if(isset($user)): ?>
   <h2><?=$user->first_name?>'s profile:</h2>

      Name :  <?= ($GLOBALS["profile"]['firstname']); ?> <?= ($GLOBALS["profile"]['lastname']); ?><br>
      Nickname :  <?= ($GLOBALS["profile"]['nickname']); ?> <br>
      Email:  <?= ($GLOBALS["profile"]['email']); ?> <br>
      Favorite Beer:  <?= ($GLOBALS["profile"]['favbeer']); ?> <br>
      Bio:  <?= ($GLOBALS["profile"]['bio']); ?> <br>
      <!--pre>
      <?php print_r($GLOBALS["profile"]); ?>
      </pre-->
              
<?php else: ?>
                Router::redirect('/');
<?php endif; ?>

<a  href='/users/editprofile'><br><br>Edit Profile</a>

