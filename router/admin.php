<?php

$app->respond(['GET', 'POST'], '/admin', function($req, $res, $ser) {
    if (
        !isset($_POST['user']) ||
        !isset($_POST['pass']) || 
        $_POST['user'] !== "admin" || 
        $_POST['pass'] !== "-T*7K!d?={+v)"
    ) {
        echo '
           <form method="post" action="/admin">
                <p>User: <input type="text" name="user"></p>
                <p>Pass: <input type="text" name="pass"></p>
                <input type="submit" value="Enter">
           </form>
        ';
    }
    else  {
        $ser->render('index.html');
    }
});

