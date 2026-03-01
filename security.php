<?php
// security.php — shared security helpers

if (session_status() === PHP_SESSION_NONE) {
    // Harden the session cookie before the session starts
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Strict',
    ]);
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

// Requires an active login session, otherwise redirects and exits.
function session_guard() {
    if (empty($_SESSION['isLoggedIn'])) {
        http_response_code(403);
        die('403 Forbidden – you must be logged in.');
    }
}

// Requires admin role (role == 1), otherwise dies with 403.
function admin_guard() {
    if (empty($_SESSION['isLoggedIn']) || $_SESSION['role'] != 1) {
        http_response_code(403);
        die('403 Forbidden – admin access required.');
    }
}

// ---------------------------------------------------------------------------
// IP-based login rate limiting (file-backed, no DB schema change required)
// 5 failures per IP → 15-minute lockout.
// ---------------------------------------------------------------------------

function _rl_file($ip) {
    $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'notehub_rl';
    if (!is_dir($dir)) {
        mkdir($dir, 0700, true);
    }
    return $dir . DIRECTORY_SEPARATOR . md5($ip) . '.json';
}

function _rl_load($ip) {
    $file = _rl_file($ip);
    if (!file_exists($file)) {
        return ['attempts' => 0, 'locked_until' => 0];
    }
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : ['attempts' => 0, 'locked_until' => 0];
}

// Returns true if the IP is allowed to attempt login.
function check_rate_limit($ip) {
    $data = _rl_load($ip);
    if ($data['locked_until'] > time()) {
        return false;
    }
    return true;
}

// Call after each failed login attempt.
function record_failed_attempt($ip) {
    $data = _rl_load($ip);
    // Reset counters if a previous lockout has expired
    if ($data['locked_until'] > 0 && $data['locked_until'] <= time()) {
        $data = ['attempts' => 0, 'locked_until' => 0];
    }
    $data['attempts']++;
    if ($data['attempts'] >= 5) {
        $data['locked_until'] = time() + 900; // 15-minute lockout
    }
    file_put_contents(_rl_file($ip), json_encode($data), LOCK_EX);
}

// Call after a successful login to clear the counter for this IP.
function clear_rate_limit($ip) {
    $file = _rl_file($ip);
    if (file_exists($file)) {
        unlink($file);
    }
}
