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
        url: "../controller/categoria/getCategoriaList.php",
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
                    tabla_body.innerHTML += `<tr id="pro_identity_` + mi_sku.IDcategoria + `"  ` + ( mi_sku.estado == 0 ? ` style="color:gray;" ` : ``) + `  >
                    <td class="mi_celda_boton p-1">
                        <button type="button" class="btn btn-sm btn-theme-plane" title="Editar" onclick="onProductEditable(this)" ><i class="fas fa-pencil-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-` + ( mi_sku.estado == 1 ? `danger` : `success`) + `" 
                            title="` + ( mi_sku.estado == 1 ? `Desactivar` : `Activar`) + `" onclick="onProductDelete(this,` + (mi_sku.estado == 1 ? 0 : 1) + `)" >
                            <i class="fas ` + ( mi_sku.estado == 1 ? `fa-minus-circle` : `fa-check-circle`) + `"></i></button>
                    </td>
                    <td class="p-1">` + (mi_sku.nombre != null ?  mi_sku.nombre : `-`) + `</td>
                    <td class="p-1">` + (mi_sku.orden != null ?  mi_sku.orden : `0`) + `</td>
                    <td class="p-1">` + mi_sku.fecha_registro + `</td>
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

document.getElementById("btn_producto_exportar").onclick = function(event){
    console.log("e");
    window.location.href = "../controller/categoria/exportarCategoria.php";
};

document.getElementById("btn_producto_nuevo").onclick = function(event){
    console.log("ala");
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
        mensaje_modal ="¿Deseas activar la sub categoria?";
    }else{
        mensaje_modal ="¿Deseas desactivar la sub categoria?";
    }

    alertify.confirm(mensaje_modal, function (param1) {
        console.log("si");
        let entidad = $(objeto).parent().parent().attr('id');
        $.ajax({
            type: "POST",
            url: "../controller/categoria/desactivarCategoria.php",
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


    $("#pro_categoria").val($(fila[1]).text());
    $("#pro_orden").val($(fila[2]).text());


    $("#btn_producto_nuevo").attr("disabled", true);
    $("#btn_producto_guardar").attr("disabled", false);
    $("#btn_producto_cancelar").attr("disabled", false);
    // $("#btn_producto_importar").attr("disabled", true);
    $("#btn_producto_exportar").attr("disabled", true);

    $('#collapseOne').collapse();
    $('#pro_categoria').focus();
    alertify.success('Registro listo para editar.');
}

function onResetFormulario(){
    $("#pro_producto").val("0");

    // $("#pro_categoria").val("");
    // $("#pro_sku_1").val("0");
    // $("#pro_sku_2").val("0");
    // $("#pro_orden").val("0");

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
        url: "../controller/categoria/saveOrUpdateCategoria.php",
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


$('#remove-image').on('click',function(file) {
    dropzone.removeFile(file);
});

// DROPZONE NEW - FIN

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
        },
        fabridaPeticionAjax(tipo, url, parametros, handler){
            let mi_resultado = null;
            $.ajax({
                type: tipo,
                // dataType: 'json',
                url: url,
                data: parametros
            }).done(function(data) {
                // console.log(data);
                mi_resultado = data;
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus + ': ' + errorThrown);
                mi_resultado = null;
            });
            return mi_resultado;
        }
    }
    getProductsList();
});