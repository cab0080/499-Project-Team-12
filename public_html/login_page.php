<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Log in to tucasana</title>
    
</head>
<body>
    <form method="post">
        <div class="container">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" name="username" required>

            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="password" required>
            
            <button type="submit">Login</button>
        </div>
    </form>
    <p id="set to invisible using js">
        <?php include 'PHPScripts/login.php';?>
    </p>
    <form>
        <button formaction='index.php'>Click here to go back home</button>
    </form>

</body>
