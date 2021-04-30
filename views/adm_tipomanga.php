<?php
session_start();

define("BASE", "../");

if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Catalogo Tipo de Manga - Manager Norton</title>
    </head>

    <body>
        <?php include BASE . 'commons/header.php'; ?>
        <div class="d-flex" id="wrapper">
            <?php include BASE . 'commons/sliderbar.php'; ?>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <main class="p-1 p-md-3">
                        <section class="m-2">
                            <div class="text-left">
                                <h4>Gestor de Tipos de Manga</h4>
                            </div>
                            <hr>
                            <div class="container-center">
                                <div class="accordion">
                                    <div class="card">
                                        <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                            Registro de Tipo de Manga
                                        </button>

                                        <div id="collapseOne" class="collapse">
                                            <form id="producto_gruardar" name="producto_gruardar" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                                <div class="row collapse-body">
                                                    <input type="hidden" id="pro_producto" name="pro_producto" value="0" style="display:none" class="d-none" />
                                                    <div class="col-12 mb-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Nombre del Tipo de Manga</span>
                                                            </div>
                                                            <input type="text" id="pro_nombre" name="pro_nombre" class="form-control" placeholder="MANGA" minlength="3" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 pb-4 text-center btns-actions-form">
                                                        <button type="button" id="btn_producto_nuevo" class="btn btn-sm btn-theme" title="Nuevo"><i class="fas fa-plus"></i> Nuevo</button>
                                                        <button type="submit" id="btn_producto_guardar" class="btn btn-sm btn-theme" title="Guardar" disabled><i class="fas fa-save"></i> Guardar</button>
                                                        <button type="reset" id="btn_producto_cancelar" class="btn btn-sm btn-theme-3" title="Cancelar" disabled><i class="fas fa-window-close"></i> Cancelar</button>
                                                        <button type="reset" id="btn_producto_exportar" class="btn btn-sm btn-theme-2" title="Exportar"><i class="fas fa-file-download"></i> Exportar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- <div class="card">
                                        <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                            Filtrar resultados
                                        </button>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </section>
                        <section class="m-2">
                            <div class="container-center">
                                <nav class="mt-4">
                                    <ul class="pagination pagination justify-content-end">
                                        <li class="page-item"><a id="mi_btn_anterior" class="page-link bg-black">Anterior</a></li>
                                        <li class="page-item"><a id="mi_pagina_actual" class="page-link bg-black">1 / 1</a></li>
                                        <li class="page-item"><a id="mi_btn_siguiente" class="page-link bg-black">Siguiente</a></li>
                                    </ul>
                                </nav>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Acciones</th>
                                                <th>Tipo de Manga</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_cargar" class="text-center">
                                        </tbody>
                                    </table>
                                    <div id="my_capa_negra_tabla" class="my_capa_negra" style="display: none;">
                                        <div class="my_contenido_cargando">
                                            <div class="spinner-border text-theme"></div>
                                            <p class="my_texto_cargando">Cargando...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>

        <?php// include BASE . 'commons/files/importFiles.php'; ?>
        <?php include BASE . 'commons/footer.php'; ?>

        <div class="modal fade" id="mi_modal_importar_productos" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title">Importar Productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="col-12 pro_mensaje_importacion" id="pro_mensaje_importacion">
                    </div>
                    <div class="modal-body p-0">
                        <div class="col-12 p-1">
                            <form action="s" method="post" class="dropzone dropzone-docs p-1" enctype="multipart/form-data" id="upload-image">
                                <div class="fallback">
                                    <input name="file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" id="file" multiple="true" /> <br>
                                    <div class="dz-message needsclick">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" id="btn_producto_importar_excel" class="btn btn-sm btn-theme" title="Importar">Importar</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= BASE ?>assets/js/adm_tipomanga.js?v=<?= time(); ?>" type="text/javascript"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>