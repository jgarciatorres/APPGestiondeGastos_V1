var reset_filter = 0,filter_categoria=0,filter_nombre='';

function miOpenAndClosedContent(objeto){
    var closeado = document.getElementById(objeto).style;
    if(closeado.display === 'none'){
      closeado.display = 'block';
    }else{
      closeado.display = 'none';
    }
}

function getPostsCategoryList(){
    let tabla_body = document.getElementById("tbody-cargar-categorias");
    $.ajax({
        type: "POST",
        url: "../controller/blog/getCategoriaList.php",
        data: { estados : "0,1" },
        beforeSend: function () {
            miOpenAndClosedContent("my_carga_posts_category");
        },
        success: function (info) {
            tabla_body.innerHTML = ``;
            let mi_json = JSON.parse(info);
            if(mi_json.estado == 1 ){
                mi_json.lista.forEach(element => {
                    tabla_body.innerHTML += `
                    <tr id="` + element.id + `">
                        <td class="mi_celda_boton p-1">
                            <button type="button" class="btn btn-sm btn-theme-plane" title="Editar" onclick="onPostCatEditable(this)" ><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-` + ( element.estado == 1 ? `danger` : `success`) + `" 
                                title="` + ( element.estado == 1 ? `Desactivar` : `Activar`) + `" onclick="onPostCatEDelete(this)" >
                                <i class="fas ` + ( element.estado == 1 ? `fa-minus-circle` : `fa-check-circle`) + `"></i></button>
                        </td>
                        <td class="p-1">` + element.nombre + `</td>
                        <td class="p-1 mi_celda_boton"><button type="button" class="btn-prev-img btn btn-sm btn-theme-2 shadow-none" title="Ver Imagen" data="` + element.img + `">Ver</button></td>
                        <td class="p-1"><a href="http://10.80.41.150/norton.pe/views/blog/categoria/` + element.url + `" target="_blank">` + element.url + `</td>
                    </tr>`;
                });
            }else if(mi_json.estado == 2 ){
                tabla_body.innerHTML = `<tr id="no-result"><td colspan="9" class="p-1">No se encontro ningun registros.</td></tr>`;
            }
            miOpenAndClosedContent("my_carga_posts_category");
        },
        error: function () {
            alertify.error('Ha ocurrido un error');
        }
    });
}

function getPostsList(desde = 0, hasta = 20){
    let tabla_body = document.getElementById("tbody-cargar-posts");
    $.ajax({
        type: "POST",
        url: "../controller/blog/getPostsList.php",
        data: {desde: desde, hasta: hasta, categoria: filter_categoria, nombre: filter_nombre},
        beforeSend: function () {
            miOpenAndClosedContent("my_carga_posts");
        },
        success: function (info) {
            tabla_body.innerHTML = ``;
            let mi_json = JSON.parse(info);
            if(mi_json.estado == 1 ){
                window.ns_contador.paginacion(mi_json.paginacion);
                mi_json.lista.forEach(element => {
                    tabla_body.innerHTML += `
                    <tr id="pro_identity_` + element.IDpost + `">
                        <td class="mi_celda_boton p-1">
                            <button type="button" class="btn btn-sm btn-theme-plane" title="Editar" onclick="onPostEditable(this)" ><i class="fas fa-pencil-alt"></i></button>
                            <button type="button" class="btn btn-sm btn-` + ( element.estado == 1 ? `danger` : `success`) + `" 
                                title="` + ( element.estado == 1 ? `Ocultar` : `Publicar`) + `" onclick="onPostDelete(this,` + (element.estado == 1 ? 0 : 1) + `)" >
                                <i class="fas ` + ( element.estado == 1 ? `fa-eye-slash` : `fa-eye`) + `"></i></button>
                        </td>
                        <td class="p-1">` + element.categoria + `</td>
                        <td class="p-1">` + element.title + `</td>
                        <td class="p-1 texto_sobrecargado">` + element.preview_body + `</td>
                        <td class="p-1"><a href="http://10.80.41.150/norton.pe/views/blog/posts/` + element.url + `" target="_blank">` + element.url + `</td>
                        <td class="p-1">` + element.fecha + `</td>
                    </tr>`;
                });
                setPreviewImgFunction();
                $('.table-responsive').doubleScroll({
                    resetOnWindowResize: true
                });
            }else if(mi_json.estado == 2 ){
                tabla_body.innerHTML = `<tr id="no-result"><td colspan="9" class="p-1">No se encontro ningun registros.</td></tr>`;
                window.ns_contador.paginacion(mi_json.paginacion);
            }
            reset_filter = 0;
            miOpenAndClosedContent("my_carga_posts");
        },
        error: function () {
            alertify.error('Ha ocurrido un error');
        }
    });
}

function setPreviewImgFunction(){
    $('.btn-prev-img').click(function (){
        let img = $(this).attr("data");
        viewImg('../../assets/upload/blog/categories/'+img);
    });
}
function viewImg(imgUrl){
    if (!$('#ModalViewImg').length) {
        $('body').append(`
        <div class="modal fade" id="ModalViewImg">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="close close-absolute" data-dismiss="modal" >&times;</button>
                    <img src="`+imgUrl+`" width="100%" alt="" class="img-thumbnail">
                </div>
            </div>
        </div>
        `);
    }else{
        $('#ModalViewImg').find('img.img-thumbnail').attr("src", imgUrl);
    }

    $('#ModalViewImg').modal('show');
}

function onPostCatEditable(objeto){
    let registro = $(objeto).parent().parent();
    let id = $(registro).attr('id');
    let fila = $(registro).find("td");

    $("#cat-id").val(id);
    $("#cat-nombre").val($(fila[1]).text());
    let img_name = $(fila[2]).find('button.btn-prev-img').attr("data");
    $("#cat-ant-img").val(img_name);
    btp_set_input_img_thumbnail("#cat-img","../../assets/upload/blog/categories/",img_name);

    $("#btn-cat-nuevo").attr("disabled", true);
    $("#btn-cat-guardar").attr("disabled", false);
    $("#btn-cat-cancelar").attr("disabled", false);

    $('#cat-nombre').focus();
    alertify.success('Registro listo para editar.');
}

function onPostCatEDelete(objeto){
    let desactivated = objeto.classList.contains('btn-danger');
    let status = 1; 
    let mensaje_modal = "¿Desea activar la categoria?";
    if(desactivated){ status = 0; mensaje_modal = "¿Desea desactivar la categoria?"; }


    alertify.confirm(mensaje_modal, function (param1) {
        let registro = $(objeto).parent().parent();
        let id = $(registro).attr('id');

        $.ajax({
            url: "../controller/blog/changeStatusBlogCategoria.php",
            data: {estado: status, IDcategoria: id },
            type: "post",
            dataType: "json",
            beforeSend: function () {
            },
            success: function (result) {
                if (result.status == "1"){
                    if(desactivated){ 
                        $(objeto).removeClass('btn-danger');
                        $(objeto).addClass('btn-success');
                        $(objeto).html('<i class="fas fa-check-circle"></i>');
                        $(objeto).attr("title", "Activar");
                    }else{
                        $(objeto).addClass('btn-danger');
                        $(objeto).removeClass('btn-success');
                        $(objeto).html('<i class="fas fa-minus-circle"></i>');
                        $(objeto).attr("title", "Desactivar");
                    }
                    cargarGeneral();
                    alertify.success('Estado actualizado');
                }else{
                    alertify.error(result.msg);
                }
            },
            error: function () {
                alertify.error('Ha ocurrido un error');
            }
        });
    },function(param2){
        console.log("no desactivar");
    }).set({title:"Activacion de Categoria"}).set({labels:{ok:'SI', cancel: 'NO'}});
}

$("#form-blog-categorias").submit(function (event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: "../controller/blog/saverOrUpdateBlogCategory.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function () {
            $("#btn-cat-guardar").addClass('disabled-action');
            $("#btn-cat-guardar").html('<div class="spinner-border spinner-border-sm"></div>');
            $("#btn-cat-cancelar").attr("disabled", true);
        },
        success: function (info) {
            let result = JSON.parse(info);
            if (result.estado == "1"){
                onResetCatFormulario();
                cargarGeneral();
                getPostsCategoryList();
            }
            else if (result.estado == "-1"){
                onResetCatFormulario();
            }
            alertify.success(result.mensaje);
        },
        error: function () {
            console.log("Error");
        }
    });
});


$("#form-blogpost").submit(function (event) {
    event.preventDefault();
    $('#div-modals').html(`
    <div class="modal fade" id="ModalProccessPost" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="row mt-5 mb-5">
                    <div class="col-12 text-center mb-2">
                        <div class="spinner-border  text-theme"></div>
                    </div>
                    <div class="col-12 text-center">Procesando Blog...</div>
                </div>
            </div>
        </div>
    </div>`);

    $('#ModalProccessPost').modal('show');
    
    setTimeout(function () {
        $('#ModalProccessPost').modal('toggle');
        console.log(document.getElementById('post-body').value);
          $.ajax({
            type: "POST",
            url: "../controller/blog/saverOrUpdateBlogPost.php",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function () {
                $("#btn-post-guardar").addClass('disabled-action');
                $("#btn-post-guardar").html('<div class="spinner-border spinner-border-sm"></div>');
                $("#btn-post-cancelar").attr("disabled", true);
            },
            success: function (info) {
                let result = JSON.parse(info);
                if (result.estado == "1"){
                    onResetPostFormulario();
                    getPostsList();
                }
                else if (result.estado == "-1"){
                    onResetPostFormulario();
                }
                alertify.success(result.mensaje);
            },
            error: function () {
                console.log("Error");
            }
        });
    }, 5000);
});

document.getElementById("mi_btn_anterior").onclick = function(){
    window.ns_contador.anterior(); 
};

document.getElementById("mi_btn_siguiente").onclick = function(){
    window.ns_contador.siguiente(); 
};

document.getElementById("btn-post-nuevo").onclick = function(event){
    $("#btn-post-nuevo").attr("disabled", true);
    $("#btn-post-guardar").attr("disabled", false);
    $("#btn-post-cancelar").attr("disabled", false);
};

document.getElementById("btn-post-cancelar").onclick = function(){
    $("#btn-post-nuevo").attr("disabled", false);
    $("#btn-post-guardar").attr("disabled", true);
    $("#btn-post-cancelar").attr("disabled", true);

    onResetPostFormulario();
};

function onResetPostFormulario(){
    $("#post-id").val('0');

    $('#post-cat').val("0");
    $("#post-cat").selectpicker("refresh");
    $('#post-cat').trigger('change');

    $("#post-title").val('');
    $("#post-previewbody").val('');

    $("#post-ant-img").val('');
    $('#post-previewimg').find("button.btn-reset-file").click();

    $("#btn-post-nuevo").attr("disabled", false);
    $("#btn-post-guardar").html('Guardar');
    $("#btn-post-guardar").attr("disabled", true);
    $("#btn-post-guardar").removeClass('disabled-action');
    $("#btn-post-cancelar").attr("disabled", true);
}

document.getElementById("btn-cat-nuevo").onclick = function(event){
    $("#btn-cat-nuevo").attr("disabled", true);
    $("#btn-cat-guardar").attr("disabled", false);
    $("#btn-cat-cancelar").attr("disabled", false);
};

document.getElementById("btn-cat-cancelar").onclick = function(){
    $("#btn-cat-nuevo").attr("disabled", false);
    $("#btn-cat-guardar").attr("disabled", true);
    $("#btn-cat-cancelar").attr("disabled", true);

    onResetCatFormulario();
};

function onResetCatFormulario(){
    $("#cat-id").val('0');
    $("#cat-nombre").val('');

    $("#cat-ant-img").val('');
    $('#cat-img').find("button.btn-reset-file").click();

    $("#btn-cat-nuevo").attr("disabled", false);
    $("#btn-cat-guardar").html('Guardar');
    $("#btn-cat-guardar").removeClass('disabled-action');
    $("#btn-cat-guardar").attr("disabled", true);
    $("#btn-cat-cancelar").attr("disabled", true);
}

$("#form-search-post").submit(function (event) {
    event.preventDefault();

    $('input').each(function () {
        $(this).val(jQuery.trim($(this).val()));
    });

    filter_categoria = document.getElementById('filter-post-cat').value;
    
    if( filter_categoria == '' ){ filter_categoria = '0'; }
    else{
        filter_categoria = '';
        var categorias = $('#filter-post-cat option:selected');
        $(categorias).each(function(){
            filter_categoria += [$(this).val()] + ",";
        });
        filter_categoria = filter_categoria.slice(0, -1);
    }

    filter_nombre = document.getElementById('filter-post-title').value;

    reset_filter = 1;
    getPostsList();
});

function selectFactoryList(componente = "", url = ""){
    let mi_select = document.getElementById(componente);
    $.ajax({
        type: "POST",
        url: "../controller/" + url,
        beforeSend: function () {
        },
        success: function (info) {
            mi_select.innerHTML = ``;
            let mi_json = JSON.parse(info);
            if(mi_json.estado == 1 ){
                mi_json.lista.forEach(mi_dato_select => {
                    mi_select.innerHTML += `<option value="`+mi_dato_select.id+`">`+mi_dato_select.nombre+`</option>`;
                });
                $(mi_select).val("0");
                $(mi_select).selectpicker("refresh");
                $(mi_select).trigger('change');
            }
        },
        error: function () {
            console.log("Error");
        }
    });
}

function cargarGeneral(){
    selectFactoryList("post-cat","blog/getCategoriaList.php");
    selectFactoryList("filter-post-cat","blog/getCategoriaList.php");
}

$(document).ready(function () {
    btp_input_img_file("#cat-img","../../assets/upload/blog/categories/default.png",512000,600,324);
    btp_input_img_file("#post-previewimg","../../assets/upload/blog/post/default.png",512000,1350,824);
    var editor = CKEDITOR.replace('post-body', {
        // filebrowserUploadUrl: "../controller/blog/upload_images.php",
        // filebrowserUploadMethod : "form"
    });
    CKFinder.setupCKEditor(editor);

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
                getPostsList(this.desde, this.hasta);
                this.mi_pagina_actual();
            }
        },
        anterior: function(){
            if(this.pagina_actual  > 1){
                this.pagina_actual -= 1; 
                this.desde -= (this.mostrado );
                this.hasta -= ( this.mostrado ); 
                // this.valores();
                getPostsList(this.desde, this.hasta);
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
    cargarGeneral();
    getPostsCategoryList();
    getPostsList();
});