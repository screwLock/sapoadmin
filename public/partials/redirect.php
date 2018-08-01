<?php
/**
 * 
 * Functionality for server side redirects
 * 
 * 
 * 
 */

function redirect($url) {
    ob_start();
    header('Location: '.$url);
    ob_end_flush();
    die();
}