const IMG_RUTA_P01 = `../../assets/upload/producto/`;

function updateCoords(c) {
  $("#x").val(c.x);
  $("#y").val(c.y);
  $("#w").val(c.w);
  $("#h").val(c.h);
  console.log($("#x").val());
  console.log($("#y").val());
  console.log($("#w").val());
  console.log($("#h").val());
}

$("#form_u_imagen").submit(function (event) {
  event.preventDefault();
  let parametros = $(this).serialize();
  buscarSku(parametros);
});

function testJSON(text){
  if (typeof text!=="string"){
      return false;
  }
  try{
      JSON.parse(text);
      return true;
  }
  catch (error){
      return false;
  }
}

function buscarSku(parametros){
  $.ajax({
      type: "POST",
      url: "../controller/img/getSkuImg.php",
      data: parametros,
      beforeSend: function () {
      },
      success: function (info) {
          console.log(info);
          if(testJSON(info)){
              let mi_json = JSON.parse(info);
              console.log(mi_json);
              setImageProduct(mi_json);
          }
      },
      error: function () {
          alertify.error("Error.");
      }
  });
}

function setImageProduct(mi_json){
  if(mi_json != null && mi_json.lista != null && mi_json.lista.img != null){
    document.getElementById("imgentidad").value = mi_json.lista.codigoERP;
    let mi_resultado = $("#img_crop_editar").find("img");
    $(mi_resultado).each(function(index, element){
      $(element).attr('src', IMG_RUTA_P01 + mi_json.lista.img);
    });
    $("#cropbox").Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords,
    });
  }else{
    alertify.error("Sku sin imagen.");
  }
}

$("#form_pro_textura").submit(function (event) {
    event.preventDefault();
    if (parseInt($("#w").val())){
      let parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "../controller/img/createTextura.php",
        data: parametros,
        beforeSend: function () {
        },
        success: function (info) {
            console.log(1);
            if(info != null){
              console.log(2);
              let mi_json = JSON.parse(info);
              if(mi_json.estado != null){
                console.log(3);
                alertify.success(mi_json.mensaje);
              }
            }
        },
        error: function () {
            console.log("Error");
        }
      });
      
    }else{
      if(parseInt($("#w").val()) == 0){
        alertify.error("Seleccionar el corte de la textura.");
      }else{
        alertify.error("Busca la imagen para realizar el corte de la textura.");
      }
    }
});