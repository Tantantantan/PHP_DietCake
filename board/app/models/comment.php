<?php
class Comment extends AppModel{

    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', MIN_COM_USERNAME, MAX_COM_USERNAME,
            ),
        ),
        'body' => array(
            'length' => array(
                'validate_between', MIN_COM_BODY, MAX_COM_BODY,
            ),
        ),
    );//end of array
}
