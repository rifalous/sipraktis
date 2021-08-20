var tRole;
$(document).ready(function(){
	tRole = $('#tbl-anggaran').DataTable({
		ajax: SITE_URL + '/anggaran/get_data',
        columns: [
            { data: 'program_name', name: 'program_name'},
            { data: 'activity_name', name: 'activity_name' },
            { data: 'sub_activity_name', name: 'sub_activity_name' },
            { data: 'rincian_name', name: 'rincian_name' },
            { data: 'keterangan', name: 'keterangan' },
            { data: 'volume', name: 'volume' },
            { data: 'satuan', name: 'satuan' },
            { data: 'harga', name: 'harga' },
            { data: 'jumlah', name: 'jumlah' },
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