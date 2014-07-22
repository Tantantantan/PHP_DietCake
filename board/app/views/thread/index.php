<h1>All threads</h1>

<ul>
  <?php foreach ($threads as $thread): ?>
  <li><a href="<?php eh(url('thread/view', array('thread_id' => $thread->id))) ?>"><?php eh($thread->title) ?></a></li>
  <?php endforeach ?>
</ul>

<br/>
<?php echo $page_links ?>
<br/><br/>
<a class="btn btn-large btn-primary" href="<?php eh(url('thread/create')) ?>">Create</a>
