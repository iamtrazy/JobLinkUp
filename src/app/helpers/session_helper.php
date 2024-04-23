<?php
session_start();

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered');
// DISPLAY IN VIEW - echo flash('register_success');
function flash($name = '', $message = '', $class = 'flash-message success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            if (!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            if (!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

function jsflash($message = '', $path = '')
{
    echo '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
    ';
    echo '<script type="text/javascript">';

    if (!empty($message) && !empty($path)) { // Fix: Corrected the condition to properly check both variables
        echo 'Swal.fire({';
        echo '  icon: "success",';
        echo '  title: "' . $message . '",';
        echo '}).then((result) => {';
        echo '  if (result.isConfirmed) {';
        echo '    window.location.href = "' . URLROOT . '/' . $path . '";';
        echo '  }';
        echo '});';
    }
    echo '</script>';
    echo '</body>';
    echo '</html>';
}
