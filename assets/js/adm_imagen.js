const IMG_RUTA_P01 = `../../../../assets/upload/producto/`;

$("#form_u_imagen").submit(function (event) {
    event.preventDefault();
    let parametros = $(this).serialize();
    buscarSku(parametros);
});

function imprimirBosonsitos(estado, sku = "" ){
    if (estado == 2){
        document.getElementById("situacion_sku").innerHTML = `<span class="x_span_badge_x x_primary_x">No existe el sku</span>`;
        //activarFunciones();
    }else if(estado == 1){
        document.getElementById("situacion_sku").innerHTML = `<button type="button" id="x_sku_activo_x" class="x_span_badge_x x_success_x_2" disabled>Sku ` + sku + `</button>` +
        ` <button type="button" id="x_sku_imagen_x" onclick="guardarImagenes();" class="x_span_badge_x x_info_x">Guardar Imagen</button>`;
        document.getElementById("x_current_sku_x").value =  sku;
        obtenerListaImagenes(sku);
    }
}

function buscarSku(parametros){
    $.ajax({
        type: "POST",
        url: "../controller/img/getSku.php",
        data: parametros,
        beforeSend: function () {
        },
        success: function (info) {
            //console.log(info);
            if(testJSON(info)){
                let mi_json = JSON.parse(info);
                console.log(mi_json);
                imprimirBosonsitos(mi_json.estado,(mi_json.lista == null ? "" : mi_json.lista.codigoERP));
            }
        },
        error: function () {
            //console.log("Error");
            alertify.error("Error");
        }
    });
}

function errorCargarItemMenu(){
    //console.log("error");
    alertify.error("Error");
}

function activarFunciones(){
    document.getElementById("x_nuevo_sku_x").onclick = function(event){
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: "../controller/img/createSku.php",
            data: { x_sku_x: document.getElementById("x_sku_x").value },
            beforeSend: function () {
            },
            success: function (info) {
                console.log(info);
                let mi_json = JSON.parse(info);
                //imprimirBosonsitos(mi_json.estado,(mi_json.lista == null ? "" : mi_json.lista.sku));
                imprimirBosonsitos(mi_json.estado,document.getElementById("x_sku_x").value);
            },
            error: function () {
                //console.log("Error");
                alertify.error("Error");
            }
        });
    }
}

function obtenerListaImagenes(parametro){
    $.ajax({
        type: "POST",
        url: "../controller/img/getListImg.php",
        data: {x_sku_x: parametro},
        beforeSend: function () {
        },
        success: function (info) {
            console.log(info);
            let mi_json = JSON.parse(info);
            if(mi_json.estado == 1 ){
                let tabla_body = document.getElementById("tabla_img_body");
                tabla_body.innerHTML = ``;
                mi_json.lista.forEach(mi_skyu => {
                    //console.log(mi_skyu);
                    tabla_body.innerHTML += `<tr id="img_identity_` + mi_skyu.IDimg + `">
                        <td class="text-center mi_center_mi"><button class="btn btn-sm btn-primary" onclick="verMiImagen(this);">Ver</button></td>
                        <td class="text-center mi_center_mi"><img class="x_mi_img_x" src="..` + IMG_RUTA_P01 +  mi_skyu.img  +`" width="120" alt=""/></td>
                        <td class="text-center mi_center_mi">` + mi_skyu.codigoERP + `</td>
                        <td class="text-center mi_center_mi">` + mi_skyu.orden + `</td>
                        <td class="text-center mi_center_mi"><button class="btn btn-sm btn-danger mi_boton_eli_img" onclick="deletearImagen(this);">x</button></td>
                    </tr>`;
                });
            }else if(mi_json.estado == 2 ){
                document.getElementById("tabla_img_body").innerHTML = ``;
            }
        },
        error: function () {
            //console.log("Error");
            alertify.error("Error");
        }
    });
}

function guardarImagenes(){
    let archivos = dropzone.files.length;
    if(archivos > 0 ){
       
        let mi_form_data = new FormData();
        mi_form_data.append('sku', document.getElementById("x_current_sku_x").value);
        
        for (let i = 0; i < archivos; i++) {
            mi_form_data.append('files[]', dropzone.files[i]);
        }

        $.ajax({
            type: "POST",
            url: "../controller/img/saveImage.php",
            contentType: false,
            processData: false,
            data: mi_form_data,
            beforeSend: function () {
            },
            success: function (info) {

                console.log(info);
                console.log(1);

                if(info != null){
                    console.log(2);
                    let mi_json = JSON.parse(info);
                    if(mi_json.estado != null){
                        console.log(3);
                        alertify.success(mi_json.mensaje);
                        obtenerListaImagenes(document.getElementById("x_current_sku_x").value);
                        dropzone.removeAllFiles();
                    }
                }
            },
            error: function () {
                //console.log("Error");
                alertify.error("Error");
            }
        });
    }else{
        alertify.error("No contiene archivos");
        //console.log("no contiene archivos");
    }
}

function verMiImagen(objeto){
    let img_objeto = $(objeto).parent().parent().find(".x_mi_img_x")[0];
    document.getElementById("mi_img_seleccionada").src = img_objeto.src;
    document.getElementById("mi_visor_img_repo").style.display = "block";
    //console.log(img_objeto.src);
}

document.getElementById("mi_visor_img_close").onclick = function (event){
    event.preventDefault();
    document.getElementById("mi_visor_img_repo").style.display = "none";
}

function deletearImagen(objeto){
    alertify.confirm("¿Desea eliminar la imagen?", function (param1) {
        console.log("si");
        let img_objeto =  $(objeto).parent().parent().attr('id');
    
        if(img_objeto != undefined && img_objeto != ""){
            $.ajax({
                type: "POST",
                url: "../controller/img/deleteImage.php",
                data: {x_entidad_x: img_objeto},
                beforeSend: function () {
                },
                success: function (info) {
                    console.log(info);
                    console.log(1);
                    if(info != null){
                        console.log(2);
                        let mi_json = JSON.parse(info);
                        if(mi_json.estado != null){
                            console.log(3);
                            alertify.success(mi_json.mensaje);
                            obtenerListaImagenes(document.getElementById("x_current_sku_x").value);
                            $(img_objeto).remove();
                        }
                    }
                },
                error: function () {
                    console.log("Error");
                    alertify.error("Error");
                    
                }
            });
        }else{
            alertify.error("No contiene una entidad la imagen");
            //console.log("no contiene una entidad la imagen");
        }
    },function(param2){
        console.log("no");
    }).set({title:"Imagen"}).set({labels:{ok:'SI', cancel: 'NO'}});

    // if(confirm("¿Desea eliminar la imagen?")){
        
    // }
}

 //MAX IS HERE
 Dropzone.autoDiscover = false;

 function log(text)
 {
     console.log(text);
 }

 function completeOrderImageAr(){
    let m_objeto_body = document.getElementById("tabla_img_body").childNodes;
    
    if(m_objeto_body == null && m_objeto_body.length == 0) return "";

    let nro_filas = m_objeto_body.length;
    let re_orden = 1;
    let resultado = "";
    for(var i = 0; nro_filas > i; i++){
        resultado += re_orden + "-" + m_objeto_body[i].id + "|";
        re_orden += 1; 
    }
    return resultado;
 }

 var sorter = $('#tabla_img_orden').rowSorter({
     onDragStart: function(tbody, row, index)
     {
         //log('index: ' + index);
         //log('onDragStart: active row\'s index is ' + index);
         //log(row);
         //log(1);
     },
     onDrop: function(tbody, row, new_index, old_index)
     {
         //log('old_index: ' + old_index + ', new_index: ' + new_index);
         //log('onDrop: row moved from ' + old_index + ' to ' + new_index);
         //log(2);
         //log(completeOrderImageAr());
         $.ajax({
            type: "POST",
            url: "../controller/img/updateOrder.php",
            data: {x_entidad_x: completeOrderImageAr()},
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
     }
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

 /* SCRIPT NEW */
 var dropzone = new Dropzone('#upload-image', {
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    dictDefaultMessage: '<div class="select-image">Arrastre y suelte las im&aacute;genes aquí </br> <i class="fa fa-upload" aria-hidden="true"></i></div>',
    acceptedFiles: 'image/png, .jpeg, .jpg, image/gif',
    url: "../controller/img/saveImage.php",
    autoProcessQueue: false,
    thumbnail: function(file, dataUrl) {
    if (file.previewElement) {
        file.previewElement.classList.remove("dz-file-preview");
        var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
        for (var i = 0; i < images.length; i++) {
        var thumbnailElement = images[i];
        thumbnailElement.alt = file.name;
        thumbnailElement.src = dataUrl;
        }
        setTimeout(function() { file.previewElement.classList.add("dz-image-preview"); }, 1);
    }
    
    }
});

// Now fake the file upload, since GitHub does not handle file uploads
// and returns a 404
var minSteps = 6,
    maxSteps = 60,
    timeBetweenSteps = 100,
    bytesPerStep = 100000;

dropzone.uploadFiles = function(files) {
    var self = this;
    for (var i = 0; i < files.length; i++) {

    var file = files[i];
    totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

    for (var step = 0; step < totalSteps; step++) {
        var duration = timeBetweenSteps * (step + 1);
        setTimeout(function(file, totalSteps, step) {
        return function() {
            file.upload = {
            progress: 100 * (step + 1) / totalSteps,
            total: file.size,
            bytesSent: (step + 1) * file.size / totalSteps
            };

            self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
            if (file.upload.progress == 100) {
            file.status = Dropzone.SUCCESS;
            self.emit("success", file, 'success', null);
            self.emit("complete", file);
            /*$('#btn-guardar').on('click', function(event) {
                
                if(self.processQueue()){
                console.log("fdsfd");
                }
            });*/
            }
        };
        }(file, totalSteps, step), duration);
    }
    }
}
$('#remove-image').on('click',function(file) {
    dropzone.removeFile(file);
});

$(document).ready(function () {
    window.ns_imagen ={ 
        estado : 0,
    }
});