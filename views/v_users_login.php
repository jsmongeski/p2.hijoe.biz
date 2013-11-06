<p> Please log in:</p>

<form method='POST' action='/users/p_login'>

    Email<br>
    <input type="text" name="email" autofocus="autofocus" id="email" />
    <!--input type='text' name='email' id="email"/-->

    <br><br>

    Password<br>
    <input type='password' name='password'>

    <br><br>

    <?php if(isset($error)): ?>
        <div class='error'>

        <?php if(!strcmp($error, "bademail")) : ?>
            Login failed, invalid email address. 
        <?php endif; ?>

        <?php if(!strcmp($error, "badpwd")) : ?>
            Login failed, bad password. 
        <?php endif; ?>
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Log in'>

</form>
