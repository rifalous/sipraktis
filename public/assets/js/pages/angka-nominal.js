$(document).ready(function(){
	$("#btn_submit").click(function(){
        // $("#form-transaksi").validate({
        //     rules: {
        //         'angka': {
        //             minlength: 2
        //         }
        //     }
        // });
        //get the form values
        var angka = $('#angka').val();     
        var nominal = $('#nominal').val();     
        var seller_id = $('#seller_id').val(); 
       
        console.log("Length Angka " + angka.length);
        console.log("Length Nominal " + nominal.length);

        if (angka.length < 2) {
            alert('Panjang Angka Minimal 2!');
            $('#angka').val('');
            $('#nominal').val('');
            return;
        }
        if (angka.length > 4) {
            alert('Panjang Angka Maksimal 4!');
            $('#angka').val('');
            $('#nominal').val('');
            return;
        }
        if (nominal.length > 4) {
            alert('Panjang Nominal Maksimal 4!');
            $('#angka').val('');
            $('#nominal').val('');
            return;
        }
        if (nominal.length == 1) {
            if (nominal == 0) {
                alert('Nilai Nominal Tidak Boleh 0!');
                $('#angka').val('');
                $('#nominal').val('');
                return;
            }
        } 
        //make the postdata
        var postData = 'angka='+angka+'&nominal='+nominal+'&seller_id='+seller_id;
       
        //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)
       
        $.ajax({
           url : "/angkanominal/store",
		   headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           type: "POST",
           data : postData,
           success: function(data,status, xhr)
           {
               //if success then just output the text to the status div then clear the form inputs to prepare for new data
                // $("#data_angka_tabel").remove(); 
                // $("#data_angka_tabel").html(data);
                console.log("ini adalah angka " + angka + " nominal " + nominal + " seller_id " + seller_id);
                var row_data = "";
                row_data = "<tr>" +
                    "<td width='230px'>" + angka + "</td></div>" + 
                    "<td width='230px'>" + nominal + "</td></div>" +
                    "<td width='160px'><center><a href='' Onclick='return RefreshFirst()'>HAPUS</a></center></td>" +
                "</tr>";
                $("#data_angka_tabel").prepend(row_data);
                $('#angka').val('');
                $('#nominal').val('');
                $('#angka').focus();
           },
           error: function (jqXHR, status, errorThrown)
           {
               //if fail show error and server status
               $("#status_text").html('there was an error ' + errorThrown + ' with status ' + textStatus);
           }
       });
    })
});