<?php
class Comment extends AppModel
{
    public $validation = array(
        'username' => array(
            'length' => array(
                'change_length', 1, 16,
            ),
        ),
        'body' => array(
            'length' => array(
                'change_length', 1, 200,
            ),
        ),
    );
}
?>