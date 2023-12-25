<ul id="zhurnal-menu"><?php 
	foreach ($this->views as $slug => $viewData) {
	if ($viewData['in-menu']) { ?>
	<li><a class="<?= ($slug == $this->current_page) ? 'active' : '' ?>" href="?view=<?=$slug ?>"><?=$viewData['text'] ?></a>
	<?php } 
	} ?>
</ul>