$(document).ready(function () {
    $('#form-msj').hide();
    $('#sec-table-result').hide();
    $('#sec-progress').hide();
    
    list_categorias();

    $('#product-sku').keypress(function(event) {
        var keyCode = event.keyCode || event.which;
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        
        if(this.value.length==10){ return false; }
        else{
            if(isValid){ return true; }
            else{ return false; }
        }
    });

    $('#close-alert').click(function() {
        $('#form-msj').hide();
    });
});

function list_categorias() {
    var parametros = {
        'option': "list_categorias"
    };
    $.ajax({
        url: '../controller/stock-controller.php',
        data: parametros,
        type: "post",
        dataType: 'json',
        success: function (data) {
            if (data.msj == 1) {
                $("#product-categoria").html(data.select_cat).fadeIn('slow');
            }else if (data.msj == 2) {
                $("#product-categoria").html(data.select_cat).fadeIn('slow');
                $("#product-categoria").attr('disabled','disabled');
            }
        }
    });
}

$("#form-search-inventario").submit(function (event) {
    event.preventDefault();
    var product_sku = document.getElementById('product-sku').value;
    var product_nombre = document.getElementById('product-nombre').value;
    var product_categoria = document.getElementById('product-categoria').value;
    var in_sku = product_sku.replace(/\s/g, '');
    var in_nombre = product_nombre.replace(/\s/g, '');

    if(in_sku=='' && in_nombre=='' && product_categoria==0){
        // $('#form-msj').removeClass('alert-success');
        $('#form-msj').addClass('alert-info');
        $('#form-msj-text').html('Inserte por lo menos un parametro de filtrado.');
        $('#form-msj').show();
    }else{
        // $('#form-msj').removeClass('alert-info');
        // $('#form-msj').addClass('alert-success');
        // $('#form-msj-text').html('Empezando Busqueda');
        // $('#form-msj').show();
        var parametros = $(this).serialize();
        var option ='search_stock';

        $.ajax({
            url: '../controller/stock-controller.php',
            data: parametros+"&option="+option,
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $('#sec-table-result').hide();
                $('#sec-progress').show();
                // var progreso = 0;
                // var idIterval = setInterval(function(){
                //     // Aumento en 10 el progeso
                //     progreso +=10;
                //     $('#bar').css('width', progreso + '%');
                //     $('#span-bar').html(progreso + '% Completado');
                //     //Si llegó a 100 elimino el interval
                //     if(progreso == 100){
                //         clearInterval(idIterval);
                //     }
                // },200);
            },
            success: function (data) {
                $('#sec-progress').hide();
                if (data.msj == 1) {
                    // $('#bar').css('width', '0%');
                    $('#edit-select-stock').show();
                    $('#export-result-stock').show();
                    $('#form-msj').addClass('alert-info');
                    $('#form-msj-text').html(data.sql);
                    $('#form-msj').show();
                    $('#sec-table-result').show();
                    $("#tbody-stock-list-pro").html(data.table_results);
                }
                else if(data.msj == 2) {
                    $('#edit-select-stock').hide();
                    $('#export-result-stock').hide();
                    $('#sec-table-result').show();
                    $("#tbody-stock-list-pro").html(data.table_results);
                }
            },
            error: function () {
    
            }
        });
    }
});

$("#form-table-stock").submit(function (event) {
    event.preventDefault();
    var checkboxes = document.getElementsByName('stocks[]');
    var IDs = ""; var cant_checked=0;
    for (var i=0, n=checkboxes.length;i<n;i++) {
        if (checkboxes[i].checked) {
            IDs += ","+checkboxes[i].value;
            cant_checked++;
        }
    }
    if (IDs) IDs = IDs.substring(1);

    if(cant_checked>0){
        var parametros = IDs;
        var option ='generate_modal_list_stock';

        $.ajax({
            url: '../controller/stock-controller.php',
            data: "IDs="+parametros+"&option="+option,
            type: "post",
            dataType: "json",
            beforeSend: function () {
                $("#modal-body-stock").html('');
                $('#spinner-modal').show();
                $('#Modal-Actualizar-Stock').modal('show');
            },
            success: function (data) {
                $('#spinner-modal').hide();
                if (data.msj == 1) {
                    $('#form-msj').addClass('alert-info');
                    $('#form-msj-text').html(data.IDs);
                    $('#form-msj').show();
                    $("#modal-body-stock").html(data.modal_results);
                }
                else if(data.msj == 2) {
                    
                }
            },
            error: function () {
    
            }
        });
    }else{
        alert("selecciona pss");
    }
});