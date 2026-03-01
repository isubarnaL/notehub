<?php
// security.php — shared security helpers

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Returns the session CSRF token, generating one if not yet set.
function csrf_token() {
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

// Validates the CSRF token from POST or GET, dies with 403 on failure.
function csrf_check() {
    $token = isset($_POST['_token']) ? $_POST['_token']
           : (isset($_GET['_token'])  ? $_GET['_token'] : '');
    if (empty($_SESSION['_csrf_token']) || !hash_equals($_SESSION['_csrf_token'], $token)) {
        http_response_code(403);
        die('403 Forbidden – invalid CSRF token.');
    }
}

// Requires an active login session, otherwise dies with 403.
function session_guard() {
    if (empty($_SESSION['isLoggedIn'])) {
        http_response_code(403);
        die('403 Forbidden – you must be logged in.');
    }
}

// Requires admin role (role == 1), otherwise dies with 403.
function admin_guard() {
    session_guard();
    if ($_SESSION['role'] != 1) {
        http_response_code(403);
        die('403 Forbidden – admin access required.');
    }
}
