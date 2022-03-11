<?php 
    if($_SESSION['loggedin']){
        echo "<p>You are logged in as " . $_SESSION['username'] . "</p>
        <form>
            <button formaction='PHPScripts/signout.php'>Sign out</button>
        </form>";
    }
    else{
        echo "<p>You are not logged in</p>
            <form>
		        <button formaction='login_page.php'>Login here</button>
	        </form>";
    }
?>