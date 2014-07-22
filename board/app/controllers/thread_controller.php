<?php
class ThreadController extends AppController
{
    /**
     *Index shows the existing Threads 
     */
    public function index()
    {
        $page_links = Pagination::buildPages(Param::get('page'), Thread::countThreads());
        $threads = Thread::getAll();
        $this->set(get_defined_vars());
    }
    /**
     *Create Threads
     */
    public function create()
    {
        $thread = new Thread;
        $comment = new Comment;
        $page = Param::get('page_next', 'create');
        $title = Param::get('title');
        $username = Param::get('username');
        $body = Param::get('body');

        switch ($page) {
            case 'create':
                break;
            case 'create_end':
                $thread->title = $title;
                $comment->username = $username;
                $comment->body = $body;
                try {
                    $thread->create($comment);
                } catch (ValidationException $e){
                    $page = 'create';
                }
        default:
            throw new NotFoundException("{$page} is not found");
            break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }
    /**
     *View Threads
     */
    public function view()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comments = $thread->getComments();
        $this->set(get_defined_vars());
    }
    /**
     *Write Thread
     */
    public function write()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        $page = Param::get('page_next', 'write');
        $username = Param::get('username');
        $body = Param::get('body');

        switch ($page) {
            case 'write':
                break;
            case 'write_end':
                $comment->username = $username;
                $comment->body = $body;
                try {
                    $thread->write($comment);
                } catch (ValidationException $e) {
                    $page = 'write';
                }
            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }
}
