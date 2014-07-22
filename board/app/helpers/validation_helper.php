<?php
    function validate_length($check, $min, $max)
    {
        $n = mb_strlen($check);
        return $min <= $n && $n <= $max;
    }

    function validate_password($confpass)
    {
        $password = Param::get("password");
        return $password === $confpass;
    }

    function validate_email($email)
    {
        if(preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
            return true;
        }
        return false;
    }
