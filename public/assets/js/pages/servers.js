var tPermission;
$(document).ready(function(){
	tPermission = $('#tbl-servers').DataTable({
		ajax: SITE_URL + '/settings/servers/get_data',
        columns: [
            { data: 'display_name', name: 'display_name'},
            { data: 'description', name: 'description' },
            { data: 'image_path', name: 'image_path' },
            { data: 'options', name: 'options', class: 'text-center' },
        ],
	});

	$('#btn-confirm').click(function(){
		var id = $(this).data('id');
		$('#form-delete-'+id).submit();
	});


});

function on_delete(id)
{
	$('#modal-delete-confirm').modal('show');
	$('#btn-confirm').data('id', id);
}