var reset_filter = 0,filter_subcategoria=0,filter_nombre='',filter_codigoERP=0,filter_almacen='';

function miOpenAndClosedContent(objeto){
    var closeado = document.getElementById(objeto).style;
    if(closeado.display === 'none'){
      closeado.display = 'block';
    }else{
      closeado.display = 'none';
    }
}

function getProductStockList(desde = 0, hasta = 20){
    let tabla_body = document.getElementById("tbody_cargar");
    $.ajax({
        type: "POST",
        url: "../controller/stock/getStockList.php",
        data: {desde: desde, hasta: hasta,subcategoria: filter_subcategoria, nombre: filter_nombre, codigoERP: filter_codigoERP, almacen:filter_almacen, setLimit:1},
        beforeSend: function () {
            miOpenAndClosedContent("my_capa_negra_tabla");
        },
        success: function (info) {
            tabla_body.innerHTML = ``;
            let mi_json = JSON.parse(info);
            if(mi_json.estado == 1 ){
                window.ns_contador.paginacion(mi_json.paginacion);
                mi_json.lista.forEach(element => {
                    tabla_body.innerHTML += `
                    <tr>
                        <td class="p-1">` + element.nombre + `</td>
                        <td class="p-1 sticky-table-column">` + element.codigoERP + `</td>
                        <td class="p-1">` + element.IDtienda + `</td>
                        <td class="p-1">` + element.talla + `</td>
                        <td class="p-1">` + element.stock + `</td>
                        <td class="p-1">` + element.stock_tienda + `</td>
                        <td class="p-1">` + element.stock_disponible + `</td>
                        <td class="p-1"><input id="` + element.IDtienda +`_`+ element.codigoERP +`_`+ element.IDtallero +`_`+ element.IDtipo + `" class="input-stock form-control border-theme" type="number"></td>
                        <td class="p-1">` + element.fecha_registro + `</td>
                    </tr>`;
                });
                $('.table-responsive').doubleScroll({
                    resetOnWindowResize: true
                });
                setInputStockFunction();
            }else if(mi_json.estado == 2 ){
                tabla_body.innerHTML = `<tr id="no-result"><td colspan="9" class="p-1">No se encontro resultado a su busqueda.</td></tr>`;
                window.ns_contador.paginacion(mi_json.paginacion);
            }
            reset_filter = 0;
            miOpenAndClosedContent("my_capa_negra_tabla");
        },
        error: function () {
            alertify.error('Ha ocurrido un error');
        }
    });
}

document.getElementById("export-stock").onclick = function(event){
    let id_result = $('#tbody_cargar tr:first').attr('id');
    if(id_result!="no-result"){
        window.location.href = `../controller/stock/exportarStock.php?subcategoria=`+filter_subcategoria+`&nombre=`+filter_nombre+`&codigoERP=`+filter_codigoERP+`&almacen=`+filter_almacen;
    }else{
        alertify.warning('No existen datos para exportar');
    }
};

document.getElementById("mi_btn_anterior").onclick = function(){
    window.ns_contador.anterior(); 
};

document.getElementById("mi_btn_siguiente").onclick = function(){
    window.ns_contador.siguiente(); 
};

function setInputStockFunction(){
    $('.input-stock').on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13){
            let reg = /^\d*$/;
            if(this.value!=''&&reg.test(this.value)==true){
                onEnterStock(this,this.value);
                this.value = '';
            }
        }
    });
}


function onEnterStock(objeto, value){
    let mensaje_modal = "¿Desea actualizar el stock del producto a <b>"+value+"</b> unidades?";

    alertify.confirm(mensaje_modal, function (param1) {
        let data = objeto.id.split('_');
        var parametros = {
            "stock_nuevo": value,
            "IDtienda": data[0],
            "codigoERP": data[1],
            "IDtallero": data[2],
            "IDtipo": data[3]
        };
        $.ajax({
            url: "../controller/stock/updateStock.php",
            data: parametros,
            type: "post",
            dataType: "json",
            beforeSend: function () {
            },
            success: function (result) {
                if (result.status == "1"){
                    let table_row = $(objeto).parent().parent();
                    let fila = $(table_row).find("td");
                    $(fila[4]).text(value);
                    $(fila[6]).text(value - $(fila[5]).text());
                    $(fila[8]).text(result.lista);
                    alertify.success('Stock actualizado');
                }else{
                    alertify.error(result.msg);
                }
            },
            error: function () {
                alertify.error('Ha ocurrido un error');
            }
        });
    },function(param2){
        console.log("no actualizar stock");
    }).set({title:"Actualizacion de Stock"}).set({labels:{ok:'SI', cancel: 'NO'}});
}

$("#form-search-inventario").submit(function (event) {
    event.preventDefault();

    $('input').each(function () {
        $(this).val(jQuery.trim($(this).val()));
    });

    filter_subcategoria = document.getElementById('product-subcategoria').value;
    
    if( filter_subcategoria == '' ){ filter_subcategoria = '0'; }
    else{
        filter_subcategoria = '';
        var subcategorias = $('#product-subcategoria option:selected');
        $(subcategorias).each(function(){
            filter_subcategoria += [$(this).val()] + ",";
        });
        filter_subcategoria = filter_subcategoria.slice(0, -1);
    }

    filter_nombre = document.getElementById('product-nombre').value;
    filter_codigoERP = document.getElementById('product-sku').value;
    filter_almacen = document.getElementById('product-almacen').value;

    reset_filter = 1;
    getProductStockList();
});

function selectFactoryList(componente = "", url = "", paramametro = 100){
    let mi_select = document.getElementById(componente);
    $.ajax({
        type: "POST",
        url: "../controller/" + url,
        data: {numero:paramametro},
        beforeSend: function () {
        },
        success: function (info) {
            mi_select.innerHTML = ``;
            let mi_json = JSON.parse(info);
            if(mi_json.estado == 1 ){
                mi_json.lista.forEach(mi_dato_select => {
                    mi_select.innerHTML += `<option value="`+mi_dato_select.id+`">`+mi_dato_select.nombre+`</option>`;
                });
                $(mi_select).selectpicker("refresh");
            }
        },
        error: function () {
            alertify.error('Ha ocurrido un error');
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
            if(reset_filter==1){this.primera_vez=0;this.desde=0;}
            if (this.primera_vez == 0){
                this.mostrado = mi_paginacion.mostrado;
                this.total = mi_paginacion.total;
                this.pagina_actual = mi_paginacion.pagina_actual;
                this.hasta = mi_paginacion.mostrado;
                this.pagina_total = mi_paginacion.pagina_total;
                this.primera_vez = 1;
                this.mi_pagina_actual();
                // this.valores();
            }else{
                this.pagina_total = mi_paginacion.pagina_total;
            }
        },
        siguiente: function(){
            if(this.pagina_total > this.pagina_actual){
                this.pagina_actual += 1; 
                this.desde += (this.mostrado);
                this.hasta += ( this.mostrado); 
                // this.valores();
                getProductStockList(this.desde, this.hasta);
                this.mi_pagina_actual();
            }
        },
        anterior: function(){
            if(this.pagina_actual  > 1){
                this.pagina_actual -= 1; 
                this.desde -= (this.mostrado );
                this.hasta -= ( this.mostrado ); 
                // this.valores();
                getProductStockList(this.desde, this.hasta);
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
    selectFactoryList("product-subcategoria","subcategoria/getListSelect.php");
    getProductStockList();
});