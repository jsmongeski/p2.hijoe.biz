<!DOCTYPE html>
<html>
<head>
	<title><?=APP_NAME?> </title>

   <link rel="stylesheet" type="text/css" href="/style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>

   <!--style type="text/css">
        h1 {font-family:"Comic Sans MS", cursive, sans-serif;}
        h1 {font-size:40px;}
   </style-->
	
</head>

<h1>
    <a  href='/'><img src="/images/mug.jpg" alt="Beer Mug" width="72" height="72"></a>
    <a style="color:blue" href='/'><?=APP_NAME?>!<br></a>
</h1>

<body>  

   
    <div id='menu'>

        <a nav="Home" href='/'>Home</a>
    
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
   
            <a nav="logout" href='/users/logout'>Logout</a>
            <a nav="profile" href='/users/profile'>Profile</a>
            <a nav="add" href='/posts/add'>Add a new post!</a>
            <a nav="add" href='/posts/users'>List All Users </a>
            <a nav="add" href='/posts/index'>I'm following...</a>
            <a nav="about" href='/about/about'>About HBB</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>
            <a nav="login" href='/users/login'>Lager in</a>
            <a nav="signup" href='/users/signup'>Sign up</a>
            <a nav="about" href='/about/about'>About HBB</a>

        <?php endif; ?>

        <img src="/images/handle.jpg" alt="handle" width="72" height="72">

    </div>

    <br>

    <?php if(isset($content)) echo $content; ?>

    <?php if(isset($client_files_body)) echo $client_files_body; ?>

</body>
</html>
