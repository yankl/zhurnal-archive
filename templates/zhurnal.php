<div class='zhurnal-container'>
<h1 style="text-align:center">יוגנטרוף־אַרכיװ</h1>
<ul id="zhurnal-menu" class="$menu_style">
	<li><a class="<?=$active_flag['index'] ?>" href="?view=ale-numern">אַלע נומערן</a></li>
	<li><a class="<?=$active_flag['authors'] ?>" href="?view=mekhabrim">מחברים</a></li>
	<li><a class="<?=$active_flag['categories'] ?>" href="?view=kategoryes">קאַטעגאָריעס</a></li>
	<li><a class="<?=$active_flag['tags'] ?>" href="?view=zukhtsetl">זוכצעטל</a></li>
</ul>
<form id="zukh" method="get">
		<input type="hidden" name="view" value="zukh" />
		<input type="text" class="yidbox" name="q" />
		<input type="submit" value="זוך!" />
</form>
<?=$xsloutput ?>
</div>