var loadBanner = function(event) {
	var image = document.getElementById('img');
	image.src = URL.createObjectURL(event.target.files[0]);
	
};