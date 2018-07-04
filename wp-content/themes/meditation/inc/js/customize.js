jQuery( document ).ready(function( $ ) {

	$('body').on( 'click', '.section-toggle', function( event ) {
		$id = $( this ).attr('class').split( ' ' )[1];
		$( '.widget-section.' + $id ).toggle( 'active-class' );
		return false;
	});
	
	$('body').on( 'click', '.section-main-toggle', function( event ) {
		$id = $( this ).attr('class').split( ' ' )[1];
		$( '.widget-main-section.' + $id  ).toggle( 'active-main-class' );
		return false;
	});
});