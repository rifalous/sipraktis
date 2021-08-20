var tSection;
$(document).ready(function(){

	tRate = $('#table-rincian').DataTable({
		ajax: SITE_URL + '/rincian/get_data',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        columns: [
            { data: 'kode', name: 'kode'},
            { data: 'rincian_name', name: 'rincian_name'},
            { data: 'options', name: 'options', searching: false, sorting: false, class: 'text-center' }
        ],
        drawCallback: function(){
        	$('[data-toggle="tooltip"]').tooltip();
        }
	});


    $('#btn-confirm').click(function(){
        var section_id = $(this).data('value');
        $('#form-delete-' + section_id).submit();
    });

});

function on_delete(section_id)
{
    $('#modal-delete-confirm').modal('show');
    $('#btn-confirm').data('value', section_id);
}