<?php
function redirection($url) {
    if (headers_sent()) {
        print('<meta http-equiv="refresh" content="0;URL='.$url.'">');
    } else {
        header("Location: $url");
        exit();
    }
}
function clean($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>
