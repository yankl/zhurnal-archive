<div class='zhurnal-container <?=$this->page ?>' dir='rtl'>
<h1 style="text-align:center">יוגנטרוף־אַרכיװ</h1>
<ul id="zhurnal-menu"><?php 
	foreach ($views as $view) {
	if ($view['in-menu']) { ?>
	<li><a class="<?= ($view['slug'] == $this->page) ? 'active' : '' ?>" href="?view=<?=$view['slug'] ?>"><?=$view['text'] ?></a>
	<?php } 
	} ?>
</ul>
<form id="zukh" method="get">
		<input type="hidden" name="view" value="zukh" />
		<input type="text" class="yidbox" name="q" />
		<input type="submit" value="זוך!" />
</form>
<?=$xsloutput ?>
</div>