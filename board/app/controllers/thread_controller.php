<?php
class ThreadController extends AppController{

	public function index(){
		$threads = Thread::getAll();
		$this->set(get_defined_vars());
	}

	public function view(){
		$thread = Thread::get(Param::get('thread_id'));
		$comments = $thread->getComments();
		$this->set(get_defined_vars());
	}
	
	public function getComments(){
		$comments = array();
		$db = DB::conn();
		$rows = $db->rows(
		'SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC',
		array($this->id)
		);

		foreach ($rows as $row) {
		$comments[] = new Comment($row);
		}
		return $comments;
	}
	public function write(){
		$thread = Thread::get(Param::get('thread_id'));
		$comment = new Comment;
		$page = Param::get('page_next');

		switch ($page) {
			case 'write':
			break;
			case 'write_end':
				$comment->username = Param::get('username');
				$comment->body = Param::get('body');
				try{
					$thread->write($comment);
					} 
				catch (ValidationException $e) {
					$page = 'write';
					}
			break;
			default:
			throw new NotFoundException("{$page} is not found");
			break;
		}

		$this->set(get_defined_vars());
		$this->render($page);
	}
	public function create(){
		$thread = new Thread;
		$comment = new Comment;
		$page = Param::get('page_next', 'create');
			
		switch ($page) {
			case 'create':
			break;
			case 'create_end':
				$thread->title = Param::get('title');
				$comment->username = Param::get('username');
				$comment->body = Param::get('body');
				try {
				$thread->create($comment);
				}
				catch (ValidationException $e) {
				$page = 'create';
				}break;

			default:
			throw new NotFoundException("{$page} is not found");
			break;
		}//switch
		$this->set(get_defined_vars());
		$this->render($page);
	}
}
?>