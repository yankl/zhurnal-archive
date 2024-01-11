<div class='zhurnal-container <?=$this->page ?>' dir='rtl'>
<?=$this->menu->html_output();?>
<form id="zukh" method="get">
		<input type="hidden" name="view" value="zukh" />
		<input type="text" class="yidbox" name="q" />
		<input type="submit" value="זוך!" />
</form>
<?=$this->xml_with_xsl() ?>
<?=$this->reader_html() ?>
</div>