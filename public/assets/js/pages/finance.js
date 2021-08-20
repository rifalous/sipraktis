var tCompany;
$(document).ready(function(){

    // $( "#seller" ).prop( "hidden", true );
    // $( "#dealer" ).prop( "hidden", true );

	tRate = $('#table-finance').DataTable({
		ajax: SITE_URL + '/finance/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'id', name: 'id'},
            { data: 'display_name', name: 'display_name'},
            { data: 'values', name: 'values'},
            { data: 'operator_name', name: 'operator_name'},
            { data: 'seller_name', name: 'seller_name'},
            { data: 'dealer_name', name: 'dealer_name'},
            { data: 'server_name', name: 'server_name'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var finance_id = $(this).data('value');
        $('#form-delete-' + finance_id).submit();
    });

});

function on_delete(finance_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', finance_id);
}