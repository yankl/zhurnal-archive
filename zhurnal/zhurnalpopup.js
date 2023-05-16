jQuery(document).ready(function(){
	jQuery('.absoluteIframeDOMWindow').openDOMWindow({
		height:jQuery(window).height() - 100,
		width:jQuery(window).width() - 100,
		positionType:'fixed',
		positionTop:50,
		eventType:'click',
		positionLeft:50,
		windowSource:'iframe',
		windowPadding:0,
		loader:1,
		loaderImagePath:'animationProcessing.gif',
		loaderHeight:16,
		loaderWidth:17
	});




	jQuery('.author-name,.category-name')
		.css({'cursor':'pointer'})
		.click(function () {
			jQuery(this).next().slideToggle('fast');
		})
		.next().hide()

});