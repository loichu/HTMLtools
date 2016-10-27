<?php
session_start();
if (!count($_SESSION)) {
    $_SESSION['auth'] = array(
        "is_identified" => false
    );
}

if (!function_exists("killSession")) {
    function killSession($reset = false) {
        $_SESSION = array();
        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
            );
        }
        // Finally, destroy the session.
        session_destroy();
        // If you want to reset the session
        if ($reset) {
            session_start();
        }
    }
}

