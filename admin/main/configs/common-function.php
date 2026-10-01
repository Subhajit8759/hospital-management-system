<?php

function validateRequired($value) {
    if (empty($value)) {
       return !empty(trim($value));
    }
}

?>