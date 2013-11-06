<?php if(isset($user)): ?>
   <h1><br><?=$user->first_name?>'s profile:</h1>
<?php else: ?>
                Router::redirect('/');
<?php endif; ?>


<?php if(!isset($user)): ?>
   <p> <br><br>Edit your profile, then press save:</p>
<?php else: ?>
   Router::redirect('/');
<?php endif; ?>
<br>


<form method='POST' action='/users/p_editprofile'>

    FirstName<br>
    <input type="text" name="email" autofocus="autofocus" id="email" />
    <!--input type='text' name='email' id="email"/-->
    Email<br>
    <input type="text" name="email" autofocus="autofocus" id="email" />
    <!--input type='text' name='email' id="email"/-->

    <br><br>

    Password<br>
    <input type='password' name='password'>

    <br><br>

    <input type='submit' value='Log in'>

</form>

<a  href='/'>Edit Profile</a>

