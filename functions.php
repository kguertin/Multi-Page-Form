<?php
// Escaping Function used to protect against cross site scripting attack
// htmlspecialchars converts special characters back to text
// ENT_COMPAT converts double quotes and leaves single quotes alone
function __($text) {
  return htmlspecialchars($text, ENT_COMPAT);
}

function checked($value, $array) {
  if(in_array($value, $array)){
    echo 'checked="checked"';
  }
}