 jQuery(document).ready(function(){
 	
	jQuery('.author-name,.category-name,.zhurnal.tag')
		.css({'cursor':'pointer'})
		.click(function () {
			jQuery(this).next().slideToggle('fast');
		})
		.next().hide()

});