<?php

class CommentModel extends ViewModel
{
    public $table = 'addon_comment';
    public $view = array(
        'addon_comment' => array(
            '_type' => 'INNER',
        ),
        'user' => array(
            '_type' => 'INNER',
            '_on' => 'addon_comment.user_id=user.uid',
        )
    );
}