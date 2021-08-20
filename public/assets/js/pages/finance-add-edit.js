$(document).ready(function(){
	$('#form-add-edit').validate();
    // $( "#seller" ).prop( "hidden", true );
	// $( "#dealer" ).prop( "hidden", true );
	
    $('#switch').change(function() {
        if ($( '#switch' ).val() == 'Seller') {
			$( "#seller" ).prop( "hidden", false );
            $( "#dealer" ).prop( "hidden", true );
		}
		else {
			$( "#seller" ).prop( "hidden", true );
            $( "#dealer" ).prop( "hidden", false );
		}
    });
});