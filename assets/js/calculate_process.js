$( "form" ).on( "submit", function(e) {
  e.preventDefault();

    var data = {
      'a_lat' : $('#point-a-lat').val(),
      'a_long' : $('#point-a-long').val(),
      'b_lat' : $('#point-b-lat').val(),
      'b_long' : $('#point-b-long').val(),
    };

    $.ajax({
      type: "POST",
      url: "http://127.0.0.1:8000//src/Rectangle/RectangleCalculateProcess.php", //just for development
      data: data,
      dataType: "json",
      success: function (response) {
        if (!response.success) {
          $("#point_c").text('');
          $("#point_d").text('');
          $("#perimeter").text('0');
          $("#area").text('0');
          $("#cost").text('0');
          if (response.errors.is_valid) {
            response.errors.is_valid.a_lat ? $("#a-lat-error").text(response.errors.is_valid.a_lat) : $("#a-lat-error").text('');
            response.errors.is_valid.a_long ? $("#a-long-error").text(response.errors.is_valid.a_long): $("#a-long-error").text('');
            response.errors.is_valid.b_lat ? $("#b-lat-error").text(response.errors.is_valid.b_lat): $("#b-lat-error").text('');
            response.errors.is_valid.b_long ? $("#b-long-error").text(response.errors.is_valid.b_long): $("#b-long-error").text('');
          }

          if (response.errors.is_empty) {
            response.errors.is_empty.a_lat ? $("#a-lat-error").text(response.errors.is_empty.a_lat) : $("#a-lat-error").text('');
            response.errors.is_empty.a_long ? $("#a-long-error").text(response.errors.is_empty.a_long): $("#a-long-error").text('');
            response.errors.is_empty.b_lat ? $("#b-lat-error").text(response.errors.is_empty.b_lat): $("#b-lat-error").text('');
            response.errors.is_empty.b_long ? $("#b-long-error").text(response.errors.is_empty.b_long): $("#b-long-error").text('');
          }
        } else {
          $(".error").text('');
          $("#point_c").text(response.values.point_c.lat + ';' + response.values.point_c.long);
          $("#point_d").text(response.values.point_d.lat + ';' + response.values.point_d.long);
          $("#perimeter").text(response.values.perimeter);
          $("#area").text(response.values.area);
          $("#cost").text(response.values.cost);
        }          
      },
      error: function (response) {
        alert(response);
      }
    });
 
  });
