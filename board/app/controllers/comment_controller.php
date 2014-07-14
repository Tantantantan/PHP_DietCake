<?php
class CommentController extends AppController
{

    public function view()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comments = array();

        //Thread must exist in order to view its comments
        if ($thread) {
            $comments = Comment::get($thread->id);
        }
        
        $this->set(get_defined_vars());
    }

      public function write()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        
        $page = Param::get('next_page', 'write');
        switch ($page) {
        case 'write':
            break;
        case 'write_end':
            $comment->body = Param::get('body');
            try {
                $comment->write($thread->id);
            } catch (ValidationException $e) {
                $page = 'write';
            }
            break;
        default:
            throw new NotFoundExeption("{$page} is not found");
            break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }
}