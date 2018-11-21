$('.galeria__img').click(function(e){
	var img = e.target.src;
//pasamos la variable con la ruta de la imagen seleccionada
	var modal = '<div class="modal" id="modal"><img src="'+img+'" class="modal__img"><div class="modal__boton" id="modal__boton"> Z </div></div>';
	$('body').append(modal);

	$('#modal__boton').click(function(){
		$('#modal').remove();
	})
});

$(document).keyup(function(e){
	if (e.which == 27) {
		$('#modal').remove();
	}
})