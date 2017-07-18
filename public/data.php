<?php

    require("../includes/config.php");

    
    if(isset($_GET["dataSet"]))
    {
    
        switch($_GET["dataSet"])
        {
            case 1:
                $rows = CS50::query("SELECT focus AS 'focus', SUM( TIME ) AS 'totalTime' FROM account WHERE user_id = ? GROUP BY focus", $_SESSION["id"]);
                break;
            case 2:
                $rows = CS50::query("
                        SELECT 'Time', DAYOFMONTH( NOW( ) ) *16 *60 AS 'totalTime'
                        FROM history
                        UNION
                        SELECT 'Focus', SUM( TIME ) AS 'focus'
                        FROM history
                        WHERE MONTH( DATE ) = ( MONTH( NOW( ) ) ) 
                        AND YEAR( DATE ) = ( YEAR ( NOW() ) )
                        AND user_id = ?", $_SESSION["id"]);
                break;
            case 3:
                $rows = CS50::query("
                        SELECT 'Time', DAYOFWEEK( NOW( ) ) *16 *60 AS 'totalTime'
                        FROM history
                        UNION
                        SELECT 'Focus', SUM( TIME ) AS 'focus'
                        FROM history
                        WHERE YEARWEEK( DATE ) = YEARWEEK( NOW( ) )
                        AND user_id = ?", $_SESSION["id"]);
                break;
            case 4:
                $rows = CS50::query("SELECT date, SUM( TIME ) AS 'totalTime' FROM history WHERE user_id = ? GROUP BY date", $_SESSION["id"]);
                break;
        }
        
        if(isset($rows))
        {
            // output places as JSON (pretty-printed for debugging convenience)
            header("Content-type: application/json");
            print(json_encode($rows, JSON_PRETTY_PRINT));
        }
    }    

?>