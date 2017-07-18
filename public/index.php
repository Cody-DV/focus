<?php

    // configuration
    require("../includes/config.php"); 
    
    $rows = CS50::query("SELECT * FROM account WHERE user_id =?", $_SESSION["id"]);
    
    $totalTime = CS50::query("SELECT SUM( TIME )FROM  `account` WHERE user_id = ?", $_SESSION["id"]);
    
    $positions = [];
    
    foreach($rows as $row)
    {
        
        $positions[] = [
            "focus" => $row["focus"],
            "subfocus" => $row["subfocus"],
            "time" => $row["time"],
            ];
        
    }
    
  
    
    render("portfolio.php", ["positions" => $positions, "title" => "Portfolio", "totalTime" => $totalTime]);
    
?>
