
$("#harga").change(function(){
    var volume = Number($("#volume").val());
    var harga = Number($(this).val());
    var hasil = parseFloat(volume * harga);
	$("#jumlah").val(hasil);
});

$("#volume").change(function(){
    var volume = Number($(this).val());
    var harga = Number($("#harga").val());
    var hasil = parseFloat(volume * harga);
	$("#jumlah").val(hasil);
});