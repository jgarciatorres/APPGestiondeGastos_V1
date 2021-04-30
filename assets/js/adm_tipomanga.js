function miOpenAndClosedContent(objeto){
    var closeado = document.getElementById(objeto).style;
    if(closeado.display === 'none'){
      closeado.display = 'block';
    }else{
      closeado.display = 'none';
    }
}

function getProductsList(desde = 0, hasta = 100){
    let tabla_body = document.getElementById("tbody_cargar");
    $.ajax({
        type: "POST",
        url: "../controller/tipomanga/getTipoMangaList.php",
        data: {desde: desde, hasta: hasta},
        beforeSend: function () {
            miOpenAndClosedContent("my_capa_negra_tabla");
        },
        success: function (info) {
            //console.log(info);
            tabla_body.innerHTML = ``;
            let mi_json = JSON.parse(info);
            console.log(mi_json);
            if(mi_json.estado == 1 ){
                //<i class="fas fa-check-square"></i>
                window.ns_contador.paginacion(mi_json.paginacion);
                
                mi_json.lista.forEach(mi_sku => {
                    tabla_body.innerHTML += `<tr id="pro_identity_` + mi_sku.IDmanga + `"  ` + ( mi_sku.estado == 0 ? ` style="color:gray;" ` : ``) + `  >
                    <td class="mi_celda_boton p-1">
                        <button type="button" class="btn btn-sm btn-theme-plane" title="Editar" onclick="onProductEditable(this)" ><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-` + ( mi_sku.estado == 1 ? `danger` : `success`) + `" 
                            title="` + ( mi_sku.estado == 1 ? `Desactivar` : `Activar`) + `" onclick="onProductDelete(this,` + (mi_sku.estado == 1 ? 0 : 1) + `)" >
                            <i class="fas ` + ( mi_sku.estado == 1 ? `fa-minus-circle` : `fa-check-circle`) + `"></i></button>
                    </td>
                    <td class="p-1">` + mi_sku.nombre + `</td>
                </tr>`;
          
                });
               
            }else if(mi_json.estado == 2 ){
                tabla_body.innerHTML = ``;
            }
            miOpenAndClosedContent("my_capa_negra_tabla");
        },
        error: function () {
            console.log("Error");
        }
    });
}

// document.getElementById("btn_producto_importar").onclick = function(event){
//     console.log("i");
//     $("#mi_modal_importar_productos").modal('show');
// };

document.getElementById("btn_producto_exportar").onclick = function(event){
    console.log("e");
    //$("#mi_modal_importar_productos").modal('show');
    window.location.href = "../controller/tipomanga/exportarTipoManga.php";
};

document.getElementById("btn_producto_nuevo").onclick = function(event){
    //let objeto = event.target;
    $("#btn_producto_nuevo").attr("disabled", true);
    $("#btn_producto_guardar").attr("disabled", false);
    $("#btn_producto_cancelar").attr("disabled", false);
    // $("#btn_producto_importar").attr("disabled", true);
    $("#btn_producto_exportar").attr("disabled", true);
};

document.getElementById("btn_producto_cancelar").onclick = function(){
    $("#btn_producto_nuevo").attr("disabled", false);
    $("#btn_producto_guardar").attr("disabled", true);
    $("#btn_producto_cancelar").attr("disabled", true);
    // $("#btn_producto_importar").attr("disabled", false);
    $("#btn_producto_exportar").attr("disabled", false);

    onResetFormulario();
};

document.getElementById("mi_btn_anterior").onclick = function(){
    window.ns_contador.anterior(); 
};

document.getElementById("mi_btn_siguiente").onclick = function(){
    window.ns_contador.siguiente(); 
};


document.getElementById("btn_producto_importar_excel").onclick = function(){
    let archivos = dropzone.files.length;
    let mi_mensaje_importacion = document.getElementById("pro_mensaje_importacion");
    if(archivos > 0 ){
       
        let mi_form_data = new FormData();

        for (let i = 0; i < archivos; i++) {
            mi_form_data.append('files[]', dropzone.files[i]);
        }
        $.ajax({
            type: "POST",
            url: "../controller/producto/importarProducto.php",
            contentType: false,
            processData: false,
            data: mi_form_data,
            beforeSend: function () {
            },
            success: function (info) {
                console.log(info);
                dropzone.removeAllFiles();
                mi_mensaje_importacion.innerText = info;
            },
            error: function () {
                console.log("Error");
            }
        });
    }else{
        console.log("No contiene archivos, seleccione un archivo .xls");
        mi_mensaje_importacion.innerText = "No contiene archivos, seleccione un archivo .xls";
    }
};

function seleccionarComboPorTexto(id, texto){
    var eid = document.getElementById(id);
    var devolucion = false;
    for (var i = 0; i < eid.options.length; ++i) {
        if(eid.options[i].text === texto){
          eid.options[i].selected = true;
          devolucion = true;
          break;
        }
    }
    return devolucion;
}

function seleccionarComboPorTextoNuevo(id, texto){
    var eid = document.getElementById(id);
    var devolucion = false;
    for (var i = 0; i < eid.options.length; ++i) {
        //console.log(eid.options[i].text + "-" + texto + "-" + eid.options[i].text.indexOf(texto));
        if(eid.options[i].text.indexOf(texto) > -1){
          eid.options[i].selected = true;
          devolucion = true;
          break;
        }
    }
    return devolucion;
}

function validacionEspecial(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    tecla = String.fromCharCode(tecla)
    return /^\d|\-|\*|\/$/.test(tecla);
  }
  
  function validacionNumero(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    tecla = String.fromCharCode(tecla)
    return /^\d$/.test(tecla);
  }
  
  function validacionLetra(e){
    var tecla = (document.all) ? e.keyCode : e.which;
    tecla = String.fromCharCode(tecla)
    return /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]$/.test(tecla);
  }
  


function onProductDelete(objeto, value){
    let mensaje_modal = "";
    if(value==1){
        mensaje_modal ="¿Deseas activar el tipo de manga?";
    }else{
        mensaje_modal ="¿Deseas desactivar el tipo de manga?";
    }

    alertify.confirm(mensaje_modal, function (param1) {
        console.log("si");
        let entidad = $(objeto).parent().parent().attr('id');
        $.ajax({
            type: "POST",
            url: "../controller/tipomanga/desactivarTipoManga.php",
            data: { entidad: entidad, valor: value},
            beforeSend: function () {
            },
            success: function (info) {
                console.log(info);
                let mi_json = JSON.parse(info);
                if (mi_json.estado == "1"){
                    alertify.success(mi_json.mensaje);
                }else{
                    alertify.error(mi_json.mensaje);
                }
            },
            error: function () {
                alertify.error('Error');
            }
        });
    },function(param2){
        console.log("no");
    }).set({title:"Producto"}).set({labels:{ok:'SI', cancel: 'NO'}});
}

function onProductEditable(objeto){
    let registro = $(objeto).parent().parent();
    let entidad = $(registro).attr('id');
    let fila = $(registro).find("td");

    $("#pro_producto").val(entidad);

    $("#pro_nombre").val($(fila[1]).text());


    $("#btn_producto_nuevo").attr("disabled", true);
    $("#btn_producto_guardar").attr("disabled", false);
    $("#btn_producto_cancelar").attr("disabled", false);
    // $("#btn_producto_importar").attr("disabled", true);
    $("#btn_producto_exportar").attr("disabled", true);

    $('#collapseOne').collapse();
    $('#pro_nombre').focus();
    alertify.success('Registro listo para editar.');
}

function onResetFormulario(){
    $("#pro_producto").val("0");

    //$('#pro_nombre').val("");
    $('#producto_gruardar').trigger("reset"); 
    
    $("#btn_producto_nuevo").attr("disabled", false);
    $("#btn_producto_guardar").attr("disabled", true);
    $("#btn_producto_cancelar").attr("disabled", true);
    // $("#btn_producto_importar").attr("disabled", false);
    $("#btn_producto_exportar").attr("disabled", false);
}

$("#producto_gruardar").submit(function (event) {
    event.preventDefault();
    let parametros = $(this).serialize();
    saverOrUpdateProduct(parametros);
});

function saverOrUpdateProduct(parametros){
    $.ajax({
        type: "POST",
        url: "../controller/tipomanga/saveOrUpdateTipoManga.php",
        data: parametros,
        beforeSend: function () {
        },
        success: function (info) {
            console.log(info);
            let mi_json = JSON.parse(info);
            if (mi_json.estado == "1"){
                onResetFormulario();
                alertify.success(mi_json.mensaje);
            }else{
                alertify.success(mi_json.mensaje);
            }
        },
        error: function () {
            console.log("Error");
        }
    });
}


$(document).ready(function () {
    window.ns_contador = {
        mostrado: 1,
        desde: 0,
        hasta: 1,
        total: 1,
        pagina_actual: 1,
        pagina_total: 1,
        primera_vez: 0,
        primer_siguiente:  0,
        paginacion: function(mi_paginacion){
            if (this.primera_vez == 0){
                this.mostrado = mi_paginacion.mostrado;
                this.total = mi_paginacion.total;
                this.pagina_actual = mi_paginacion.pagina_actual;
                this.hasta = mi_paginacion.mostrado;
                this.pagina_total = mi_paginacion.pagina_total;
                this.primera_vez = 1;
                this.mi_pagina_actual();
                console.log("E Primera");
                this.valores();
            }else{
                this.pagina_total = mi_paginacion.pagina_total;
            }
            

        },
        siguiente: function(){
            if(this.pagina_total > this.pagina_actual){
                this.pagina_actual += 1; 
                this.desde += (this.mostrado);
                this.hasta += ( this.mostrado); 
                this.valores();
                getProductsList(this.desde, this.hasta);
                this.mi_pagina_actual();
            }
        },
        anterior: function(){
            if(this.pagina_actual  > 1){
                this.pagina_actual -= 1; 
                this.desde -= (this.mostrado );
                this.hasta -= ( this.mostrado ); 
                this.valores();
                getProductsList(this.desde, this.hasta);
                this.mi_pagina_actual();
            }
        },
        mi_pagina_actual: function(){
            document.getElementById("mi_pagina_actual").innerText = this.pagina_actual + " / " + this.pagina_total;
        },
        valores: function(){
            console.log("de: " + this.mostrado);
            console.log("desde: " + this.desde);
            console.log("hasta: " + this.hasta);
            console.log("total: " +this.total);
            console.log("pag. actual: " + this.pagina_actual);
            console.log("pag. total: " + this.pagina_total);
        }
    }
    getProductsList();
});