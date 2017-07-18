<?php

// configuration
    require("../includes/config.php"); 
    
    $data = CS50::query("SELECT * FROM history WHERE user_id = ?", $_SESSION["id"]);
    
    //dump($data);
    // if user reached page via GET (as by clicking a link or via redirect)
    if (!empty($data))
    {
        // render form
        render("home_view.php", ["title" => "Dashboard"]);
    }
    else
    {
        render("home_empty.php", ["title" => "Dashboard"]);
    }

?>