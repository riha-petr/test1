var images = [
		'first.jpg',
		'second.jpg',
		'third.jpg',
        'fourth.jpg'
	];

var counter = images.length - 1;

function slider(counter) {
	var s = counter;
    var der = document.querySelector('.divider img');
    der.src = './img/' + images[s];
}


function countMyself() {

    if ( typeof countMyself.counter == 'undefined' ) {
        countMyself.counter = 0;
    }

    if (countMyself.counter > counter) {
    	countMyself.counter = 0;
    }

    return countMyself.counter++;
}

slider(counter);

setInterval(function() {
	slider(countMyself()); 
}, 5000);