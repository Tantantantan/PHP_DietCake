<?php

function eh($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function readable_text($string)
{
    $string = htmlspecialchars($string, ENT_QUOTES);
    $string = nl2br($string);
    return $string;
}
?>
