var tCompany;
$(document).ready(function(){

    // $( "#seller" ).prop( "hidden", true );
    // $( "#dealer" ).prop( "hidden", true );

	tRate = $('#table-monitoring-hadiah').DataTable({
		ajax: SITE_URL + '/monitoring_hadiah/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'id', name: 'id'},
            { data: 'seller_name', name: 'seller_name'},
            { data: 'dealer_name', name: 'dealer_name'},
            { data: 'angka2d', name: 'angka2d'},
            { data: 'angka3d', name: 'angka3d'},
            { data: 'angka4d', name: 'angka4d'},
            { data: 'hadiah2d', name: 'hadiah2d'},
            { data: 'hadiah3d', name: 'hadiah3d'},
            { data: 'hadiah4d', name: 'hadiah4d'},
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