<?php
 echo '<header>
<div class="head-container">
    <div>BLOGGER</div>
    <div>Search</div>
    <div>
        <form action="newsletter.php" method="post">
            <button type="submit" class="">newsletter</button>
        </form>
    </div>';
    
    
        if (!isset($_SESSION["user_id"])) {
            echo '<div>  <form action="login-page.php" method="post">
            <button type="submit" class="">Login</button>
        </form></div>';
        }
        else{
            echo '<div>  <form action="includes/logout.inc.php" method="post">
            <button type="submit" class="">Logout</button>
        </form> <form action="create-blog.php" method="post">
        <button type="submit" class="">Create post</button>
    </form>  </div>';
        }
    
    echo '<div>notification</div>';
    
        if (isset($_SESSION["user_id"])) {
            echo "<div><span class=''>{$_SESSION['user_username']}</span></div>";
        }
 echo '</div>
</header>' ;

?>