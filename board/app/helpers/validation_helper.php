<?php
    function check_length($check, $min, $max)
    {
        $n = mb_strlen($check);
        return $min <= $n && $n <= $max;
    }

    function check_password($confpass)
    {
        $password = Param::get("password");
        return $password === $confpass;
    }

    function check_email($email)
    {
        if(preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
            return true;
        }
        return false;
    }
