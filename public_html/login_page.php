<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Log in to tucasana</title>
</head>

<body>
    <form method="post" action="login_page.php">
        <div class="container">
            <label for="username">Username</label>
            <input type="text" name="username" placeholder="Username" name="username" required>

            <label for="password">Password</label>
            <input type="password" placeholder="Password" name="password" required>
            
            <button type="submit">Login</button>
        </div>
    </form>
    <p>
        This paragraph will contain the value that was entered in the username field<br>
        <?php include 'PHPScripts/login.php';?>
    </p>
</body>
