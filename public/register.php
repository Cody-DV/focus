<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if (empty($_POST["username"]))
        {
            apologize("Please enter your username.");
        }
        
        if (empty($_POST["password"]))
        {
            apologize("Please enter your password.");
        }
        
        if (empty($_POST["confirmation"]))
        {
            apologize("Please confirm your password.");
        }
        
        if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Your passwords do not match.");
        }
        
        else
        {
            $result = CS50::query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
            if ($result == true)
            {
                apologize("Username already exists.");
            }
            else
            {
                $result = CS50::query("INSERT INTO users(username, hash) VALUES (?,?)", $_POST["username"], crypt($_POST["password"]));
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                $_SESSION["id"] = $id;
                
                redirect("/newEntry.php");
            }
        }
    }
    
  
?>