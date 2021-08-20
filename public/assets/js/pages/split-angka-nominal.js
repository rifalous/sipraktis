$(document).ready(function(){

    var isFiltered = false;
    $( "#buttonClear" ).prop( "disabled", true );
    $( "#buttonSplit" ).prop( "disabled", true );

    function filter(split_sum) {
        $('#table-split-angka-nominal').DataTable({
            ajax: SITE_URL + '/split_angka_nominal/filter?split_sum=' + split_sum,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            columns: [
                { data: 'id', name: 'id'},
                { data: 'angka', name: 'angka'},
                { data: 'nominal', name: 'nominal'},
                { data: 'running_total', name: 'running_total'}
            ]
        });
    } 

    $('#buttonFilter').click(function() {
        if (isFiltered) {
            alert('Clear Table Dahulu!');
        }
        else {
            var split_sum = $('#split_sum').val();
            if (split_sum == '') {
               alert('Split Nominal Tidak Boleh Kosong!');
            }
            else {
                filter(split_sum);
                isFiltered = true;
                $( "#buttonClear" ).prop( "disabled", false );
                $( "#buttonSplit" ).prop( "disabled", false );
            }
        }
    });

    $('#buttonClear').click(function() {
        // $('#table-rekap-split-angka-nominal').DataTable().destroy();
        var table = $('#table-split-angka-nominal').DataTable();
        table
            .clear()
            .destroy();
        isFiltered = false;
        $( "#buttonClear" ).prop( "disabled", true );
        $( "#buttonSplit" ).prop( "disabled", true );
    });

    $('#buttonSplit').click(function() { 
        $('#modal-split-confirm').modal('show');
    });
});
