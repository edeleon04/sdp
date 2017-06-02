$(document).ready(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $( "#submit" ).click(function( event ) {
    event.preventDefault();

    var formData = new FormData($("#submit_form")[0]);

    $.ajax({
      type: "POST",
      url: "/findWord",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json"
    })
    .done(function(data) {
      if (data.occurrences > 1) {
        bootbox.alert("La secuencia 'OIE' aparece "+data.occurrences+" veces.");
      } else if(data.occurrences == 1){
        bootbox.alert("La secuencia 'OIE' aparece "+data.occurrences+" vez.");
      } else if(data.occurrences == 0){
        bootbox.alert("La secuencia 'OIE' no aparece en la matriz dada.");
      }
    })
    .fail(function(data) {
      alert('Error cargando archivo de prueba.');
    });

  });

});
