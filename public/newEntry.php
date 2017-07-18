<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        
        render("newEntry_form.php", ["title" => "New Entry"]);
        
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["focus"]))
        {
            apologize("You must provide a focus.");
        }
        else if (empty($_POST["subfocus"]))
        {
            $_POST["subfocus"] = "NA";
        }
        
        $rows = CS50::query("SELECT * FROM account WHERE user_id =?", $_SESSION["id"]);
    
    
        // Convert time into decimal value for calculations 
        function convertTime($time)
        {
            $hms = explode(':', $time);
            return ($hms[0] * 60) + $hms[1];
        }
        
        //$start = $_POST("start");
        //$end = $_POST("end");
        
        $decTime = (convertTime($_POST["end"]) - convertTime($_POST["start"]));   
        
        
        
        // Adjust DB Values ----
        
        //$focus = CS50::query("SELECT * FROM account WHERE focus = ?", $_POST["focus"]);
        $subFocus = CS50::query("SELECT * FROM account WHERE user_id = ? AND focus = ? AND subfocus = ?", $_SESSION["id"], $_POST["focus"], $_POST["subfocus"]);
        
        
        // Check if subfocus and focus exist together in table already
        if(!empty($subFocus))
            {
                // Adjust existing values
                CS50::query("UPDATE account SET time = time + ? WHERE user_id = ? and focus = ? AND subfocus = ?", $decTime, $_SESSION["id"], $_POST["focus"], $_POST["subfocus"]);
                
            }
        
        else
            {
                // If focus and subfocus are not in table yet -> insert new data
                CS50::query("INSERT INTO account (user_id, focus, subfocus, time) VALUES(?, ?, ?, ?)", $_SESSION["id"], $_POST["focus"], $_POST["subfocus"], $decTime);
                
                //CS50::query("INSERT INTO account (user_id, focus, subfocus, time) VALUES(?, ?, ?, ?) ON DUPLICATE KEY UPDATE time = time + VALUES(time)", $_SESSION["id"], $_POST["focus"], $_POST["subfocus"], $decTime);
            }
                
        
        
        // Update history
        CS50::query("INSERT INTO history (user_id, focus, subfocus, date, start, end, time) VALUES (?, ?, ?, ?, ?, ?, ?)", $_SESSION["id"], $_POST["focus"], $_POST["subfocus"], $_POST["date"], $_POST["start"], $_POST["end"], $decTime);
    
    
        // Redirect to updated account
        redirect("/history.php");
        
    }    
    
?>