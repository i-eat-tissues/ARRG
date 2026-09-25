<?php

/* this script honestly is extremely overkill for projects for school, but in the real
world these practices can prevent cyberattacks:D 
(cyberattacks are really bad)*/

ini_set('session.use_only_cookies', 1); // forces the browser to only use cookies, completely blocking any url-based session theft which would be bad!!
ini_set('session.use_strict_mode', 1); //forces php to reject any non server created session ids. this rejects attacker-made ids, basically.

session_set_cookie_params([ //the array of parameters that each session id will be created following.
    'lifetime' => 1800,
    'domain' => 'localhost', // CHANGE LATER to domain name 
    'path' => '/', // "/" allows for ALL paths.
    'secure' => false, //blocks any attempted access from non-https based urls I THINK CHANGE TO TRUE WHEN USING DOMAIN
    'httponly' => true
]);

session_start();

if (!isset($_SESSION["last_regeneration"])) { //if there is NO last_regeneration date in existence, do:
    session_regenerate_id(); // regenerate an id for the session
    $_SESSION["last_regeneration"] = time(); // update the last regen time to the current time using the built in time() 
} else { //if there IS a last regen date that exists, DO:
    $interval = 1800;
    if (time() - $_SESSION["last_regeneration"] >= $interval) { //checks if this session has expired, if it has, the statement goes ahead.
        session_regenerate_id(); //makes a new id
        $_SESSION["last_regeneration"] = time(); //updates the last_regeneration tiem again
    }
}

/*this is used to secure our website from attackers, changing the session id every 30 minutes so it 
is harder for attackers to steal or fake session ids. */