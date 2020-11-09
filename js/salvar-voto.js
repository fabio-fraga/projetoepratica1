function liker(evt) {
	evt.preventDefault();
	
	var l = document.getElementById('like').href;
	
	
	console.log('ta pegando')
	$.ajax(l, {
		success: function(){
			console.log('like')
			
			}
		});
};

function disliker(evt) {
	evt.preventDefault()
	
	var l = document.getElementById('dislike').href;
	
	
	$.ajax(l, {
		success: function(){
			console.log('dislike')
			
			}
		})
}



