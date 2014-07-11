<?php
class AppException extends Exception
{
}

class ValidationException extends AppException
{
}

class UserNotFoundException extends AppException
{
}

class NotFoundException extends AppException
{
}
?>