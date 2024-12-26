<?php
// Check and display success messages
if (isset($success_msg)) {
    foreach ($success_msg as $message) {
        echo '<script>swal("' . $message . '", "", "success");</script>';
    }
}

// Check and display warning messages
if (isset($warning_msg)) {
    foreach ($warning_msg as $message) {
        echo '<script>swal("' . $message . '", "", "warning");</script>';
    }
}

// Check and display info messages
if (isset($info_msg)) {
    foreach ($info_msg as $message) {
        echo '<script>swal("' . $message . '", "", "info");</script>';
    }
}

// Check and display error messages
if (isset($error_msg)) {
    foreach ($error_msg as $message) {
        echo '<script>swal("' . $message . '", "", "error");</script>';
    }
}
?>
