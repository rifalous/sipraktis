var tCompany;
$(document).ready(function(){

	tRate = $('#table-seller').DataTable({
		ajax: SITE_URL + '/seller/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name'},
            { data: 'phone', name: 'phone'},
            { data: 'persen2a', name: 'persen2a'},
            { data: 'persen3a', name: 'persen3a'},
            { data: 'persen4a', name: 'persen4a'},
            { data: 'hd2a', name: 'hd2a'},
            { data: 'hd3a', name: 'hd3a'},
            { data: 'hd4a', name: 'hd4a'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var seller_id = $(this).data('value');
        $('#form-delete-' + seller_id).submit();
    });

});

function on_delete(seller_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', seller_id);
}