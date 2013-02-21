<?php

/**
 * @author Leonardo Allegrini
 * @copyright 2013 Leonardo Allegrini
 */
require_once ('action.php');

$apikey = 'INSERT YOUR API KEY HERE';
$url = 'http://api.musixmatch.com/ws/1.1/';
$result = '';
$check = '';
if(isset($_POST['artist']) && !empty($_POST['artist']) && isset($_POST['song']) && !empty($_POST['song'])){
            $result = Action::postLyrics($apikey,$url);
            $check = 1;
        }
?>

<!doctype html>
<meta charset="UTF-8"/>
<html>
    <head>
        <title>LyricSearch</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <div class="container">
        <?php 
            if (is_null($result) && $check==1){
                echo '<h2 class="error">No results</h2>';
            }   
        ?>
            <form method="POST" action="index.php">
                <input type="text" class="testo" name="artist" placeholder="Artist" />
                <input type="text" class="testo" name="song" placeholder="Song" />
                <input type="submit" value="Submit" />
            </form>
        <div class="lyrics">
            <h2>
                <?php
                    if(isset($_POST['artist']) && !empty($_POST['artist']) && isset($_POST['song']) && !empty($_POST['song']) && !is_null($result)){
                    echo strtoupper($_POST['artist']); 
                    echo ' - ';
                    echo strtoupper($_POST['song']);
                    }
                     ?>
            </h2>
            <?php echo $result ?>
        </div>
        <footer>
            <p style="text-align: center;">2013 Created by Leonardo Allegrini. For support, send me an email at leonardoallegrini1@gmail.com</p>
        </footer>
    </div>
    </body>
</html>
