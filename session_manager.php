<?php
class SessionManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function saveUrl($uuid, $url) {
        $_SESSION['user_urls'][$uuid] = $url;
    }

    public function getUrl($uuid) {
        return isset($_SESSION['user_urls'][$uuid]) ? $_SESSION['user_urls'][$uuid] : null;
    }

    public function userExists($uuid) {
        return isset($_SESSION['user_urls'][$uuid]);
    }
}
?>