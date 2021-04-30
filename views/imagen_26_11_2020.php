<?php
session_start();

define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Imagen</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/dropzone/dropzone.css?v=<?= time(); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/img_imagen.css?v=<?= time(); ?>" />
    </head>

    <body>
        <?php include BASE . 'commons/header.php'; ?>
        <div class="d-flex" id="wrapper">
            <?php include BASE . 'commons/sliderbar.php'; ?>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <main>
                        <section class="m-3">
                            <div class="text-left">
                                <h3 class="pull-left">Gestionar Imagen</h3>
                            </div>
                            <hr>
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <input class="form-control" type="text" name="txtsku" id="txtSku" placeholder="Buscar por sku" />
                                    <div class="input-group-append">
                                        <button class="btn btn-theme py-0" title="Buscar Imagen" id="btnSearch">Buscar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-inline pb-1">
                                            <label class="control-label label-fixed col-4">Codigo SKU: </label>
                                            <label class="form-control col-8" id="codigo_sku"></label>
                                        </div>
                                        <div class="form-inline pb-1">
                                            <label class="control-label label-fixed col-4">Nombre SKU: </label>
                                            <label class="form-control col-8" id="nombre_sku"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-inline pb-1">
                                            <label class="control-label label-fixed col-4">Nombre Color: </label>
                                            <label class="form-control col-8" id="nombre_color"></label>
                                        </div>
                                        <div class="form-inline pb-1">
                                            <label class="control-label label-fixed col-4">Color Hexadecimal: </label>
                                            <label class="form-control col-8" id="color_hexadecimal"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="preview-template" style="display: none;">
                                <div class="dz-preview dz-file-preview">
                                    <div class="dz-image"><img data-dz-thumbnail="" /></div>
                                    <div class="dz-details">
                                        <div class="dz-size"><span data-dz-size=""></span></div>
                                        <div class="dz-filename"><span data-dz-name=""></span></div>
                                    </div>
                                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="dsad"></span></div>
                                    <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                                    <div class="dz-success-mark">
                                        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                            <title>Check</title>
                                            <desc>Created with Sketch.</desc>
                                            <defs></defs>
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dz-error-mark">
                                        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                            <title>error</title>
                                            <desc>Created with Sketch.</desc>
                                            <defs></defs>
                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                                    <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="dz-remove" id="remove-image" title="Eliminar Imagen" data-dz-remove>
                                        <label>Eliminar</label>
                                    </div>
                                </div>
                            </div>

                            <form action="s" method="post" class="dropzone" enctype="multipart/form-data" class="row" id="upload-image">
                                <div class="fallback">
                                    <input name="file" type="file" accept="image/png, .jpeg, .jpg, image/gif" id="file" multiple="true" /> <br>
                                    <div class="dz-message needsclick">
                                    </div>
                                </div>
                            </form>
                            <div class="content-btn-upload">
                                <button class="btn btn-sm btn-theme" id="btn-guardar-images" type="button"> Guardar </button>
                            </div>

                            <article>
                                <div class="lista-imagen" id="_AJAX_LISTA_IMAGEN_">
                                </div>
                            </article>
                        </section>
                    </main>
                </div>
            </div>
        </div>
        <?php include BASE . 'commons/footer.php'; ?>


        <script type="text/javascript" src="<?php echo BASE; ?>assets/jquery-img/jquery-2.2.4.min.js?v=<?= time(); ?>"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/jqueryui/jquery-ui-1.9.2.custom.min.js?v=<?= time(); ?>"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/jquery-migrate/jquery-migrate-1.2.1.min.js?v=<?= time(); ?>"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/dropzone/dropzone.js?v=<?= time(); ?>"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/img_imagen.js?v=<?= time(); ?>"></script>
        <script>
            //MAX IS HERE
            Dropzone.autoDiscover = false;

            $(function() {
                soltar();
                $('.input-file').change(function(event) {
                    var file = $(this)[0].files[0];
                    var idImagen = parseInt($(this).context.parentElement.offsetParent.id);
                    var n_orden = parseInt($(this).context.parentElement.offsetParent.firstChild.innerHTML);
                    ajax_remplazar_imagen(file, idImagen, n_orden);
                });
            });

            function soltar() {
                $("#content-full-image").sortable({
                    revert: true,
                    delay: 150,
                    distance: 0,
                    forceHelperSize: true,
                    forcePlaceholderSize: true,
                    helper: "clone",
                    opacity: 0.5,
                    scroll: true,
                    scrollSensitivity: 0,
                    tolerance: "pointer",
                    update: function(event, ui) {
                        var orden_item = document.getElementById("content-full-image").childNodes;
                        console.log(orden_item);
                        var orden_eviar = "";
                        for (var i = 0; i < orden_item.length; i++) {
                            if ((orden_item.length - 1) == i) {
                                orden_eviar += orden_item[i].id;
                            } else {
                                orden_eviar += orden_item[i].id + ',';
                            }
                        }
                        console.log(orden_eviar);
                        ajax_actualizar_orden(orden_eviar);
                    }
                });

                $("div, .content-image").disableSelection();
            }

            function refrescar() {
                var sku = $.trim($('#codigo_sku').html());
                if (sku != "" && sku.lenght != 10) {
                    ajax_cargar_imagenes(sku);
                } else {
                    toastr.error("Sku '" + sku + "' detectado erroneo, solo números y 10 dígitos.");
                }
            }

            $('.input-file').change(function(event) {
                var file = $(this)[0].files[0];
                var idImagen = parseInt($(this).context.parentElement.offsetParent.id);
                var n_orden = parseInt($(this).context.parentElement.offsetParent.firstChild.innerHTML);
                ajax_remplazar_imagen(file, idImagen, n_orden);
            });
        </script>
    </body>

    </html>
<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>