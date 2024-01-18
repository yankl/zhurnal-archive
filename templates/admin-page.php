<div class ='wrap' dir='rtl'>
<h1>זשורנאַל־אַרכיװ</h1>
<p>דאָס דאָזיקע קנעפּל סינכראָנזירט די דאַטן־באַזע פֿונעם אַרכיװ דאָ מיטן אינדעקס פֿון אַרטיקלען אויף
<a href='<?= sprintf('https://docs.google.com/spreadsheets/d/%s/edit#gid=0', $this->spreadsheetID) ?>'>אָט דעם צעגלידער־בלאַט</a>.</p>
<p><a href="#" id='sync-button' class="button button-primary button-hero">סינכראָניזירן</a><span class="spinner"></span></p>
</div>

<script>
jQuery(document).ready(function($) {
	$("#sync-button").on('click', function () {
		$(".spinner").addClass("is-active"); // add the spinner is-active class before the Ajax posting https://wordpress.stackexchange.com/questions/106734/how-to-add-a-waiting-icon-for-an-ajax-in-wp-frontend

		$.post(ajaxurl,
		  {
			action: "sync_zhurnal_db",
		  })
		  .done(function(data) {
			$('#sync-button').text('סינכראָניזירט!')
				.css('background', 'green').css('border-color','green');
		  })
		  .fail(function() {
			$('#sync-button').text('סינכראָניזירונג דורכגעפֿאַלן')
				.css('background', 'red').css('border-color','red');
		  })
		  .always(function() {
			  $(".spinner").removeClass('is-active');
		  });
	});
}); //end ready
</script>