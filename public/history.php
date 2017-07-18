<?php

    // configuration
    require("../includes/config.php"); 
    
    $rows = CS50::query("SELECT * FROM history WHERE user_id =?", $_SESSION["id"]);
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if (isset($rows))
    {
        
        $positions = [];
        
        foreach($rows as $row)
        {
            
            $positions[] = [
                "focus" => $row["focus"],
                "subfocus" => $row["subfocus"],
                "date" => $row["date"],
                "start" => $row["start"],
                "end" => $row["end"],
                "time" =>  $row["time"]
                ];
            
        }
       
        render("history_view.php", ["positions" => $positions, "title" => "History"]);
        
    }
    else
    {
        render("history_view.php", ["title" => "History"]);
    }
    
?>