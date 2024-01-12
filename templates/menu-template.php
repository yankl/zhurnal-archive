<ul id="zhurnal-menu"><?php 
	foreach ($this->views as $slug => $viewData) {
	if ($viewData['in-menu']) { ?>
	<li><a class="zhurnal-button <?= ($slug == $this->current_page) ? 'active' : '' ?>" href="?view=<?=$slug ?>"><?=$viewData['text'] ?></a>
	<?php } 
	} ?>
</ul>
<form id="zukh" method="get">
		<input type="hidden" name="view" value="zukh" />
		<input type="text" class="yidbox" name="q" />
		<input type="submit" value="זוך!" />
</form>