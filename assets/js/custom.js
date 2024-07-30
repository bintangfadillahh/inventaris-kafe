/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */
 // $(document).ready(function() {
 //
 //
 //   });
   function coba() {
     getElementById('jumlah').append("<p>jQuery is Amazing...</p>");
   }

   function stok() {
    	var tes = document.getElementById("barang").value;
            document.getElementById("jumlah").value=tes;
            document.getElementById('ket').append("max jumlahnya adalah");
    }

   $("#nama_laptop").click(function() {
     $("#jumlah").after("<p>jQuery is Amazing...</p>");
   });

   $("#nama_barang").click(function() {
     $("#jumlah").after("<p>jQuery is Amazing...</p>");
   })
