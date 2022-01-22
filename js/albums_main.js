window.onmousewheel = function(e){
	var el = document.querySelector(".insider");
	
	var test = el.classList.contains("slideUp");
	
	if( document.body.scrollTop > 500 && !test){
		var divs = document.querySelectorAll('.insider');
		for (var i = 0; i < divs.length; i++) {
			divs[i].classList.add('slideUp');
		}
	}
};
