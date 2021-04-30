<?php
session_start();

define("BASE", "../");

if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Catalogo SubCategoria - Manager Norton</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/bootstrap-select.min.css">
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
                                <h4>Gestor de SubCategorias</h4>
                            </div>
                            <hr>
                            <div class="accordion">
                                <div class="card">
                                    <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                        Registro de SubCategoria
                                    </button>
                                    <div id="collapseOne" class="collapse">
                                        <form id="producto_gruardar" name="producto_gruardar" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row collapse-body">
                                                <input type="hidden" id="pro_producto" name="pro_producto" value="0" style="display:none" class="d-none" />
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Categoria</span>
                                                        </div>
                                                        <select id="pro_categoria" name="pro_categoria" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0">-- Seleccione --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Nombre de Subcategoria</span>
                                                        </div>
                                                        <input type="text" id="pro_subcategoria" name="pro_subcategoria" class="form-control" placeholder="SUB BILLETERA" minlength="3" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">SKU 1</span>
                                                        </div>
                                                        <input type="number" id="pro_sku_1" name="pro_sku_1" class="form-control" min="0" value="0" readonly required>
                                                        <div class="input-group-append">
                                                            <button type="button" id="pro_buscar_1" class="btn btn-sm btn-theme-2-plane">Buscar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">SKU 2</span>
                                                        </div>
                                                        <input type="number" id="pro_sku_2" name="pro_sku_2" class="form-control" min="0" value="0" readonly required>
                                                        <div class="input-group-append">
                                                            <button type="button" id="pro_buscar_2" class="btn btn-sm btn-theme-2-plane">Buscar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Orden</span>
                                                        </div>
                                                        <input type="number" id="pro_orden" name="pro_orden" class="form-control" min="0" value="0" required>
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
                                        Filtrar Resultados
                                    </button>
                                    <div id="collapseTwo" class="collapse">
                                        <div class="collapse-body">
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </section>
                        <section class="m-2">
                            <nav class="mt-4">
                                <ul class="pagination justify-content-end">
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
                                            <th>Categoria</th>
                                            <th>Sub Categoria</th>
                                            <th>URL</th>
                                            <th>Orden</th>
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
                        </section>
                    </main>
                </div>
            </div>
        </div>
        <div id="pro_modal_busqueda" ref="modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header pt-2 pb-2">
                        <h5 class="modal-title">Buscar por SKU</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="toggleModal(0)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="pro_formulario_busqueda" name="pro_formulario_busqueda">
                            <input id="pro_indi_busqueda" type="hidden" class="d-none" style="display: none;">
                            <div class="col mb-4">
                                <label for="pro_buscar_sku" class="">Escribir nombre del producto</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="pro_buscar_sku" name="pro_buscar_sku">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-sm btn-theme-2-plane">Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="height: 300px;">
                                <table class="table table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sku</th>
                                            <th>Nombre</th>
                                            <th>Img</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pro_tabla_busqueda">
                                        <!-- <tr v-for="producto in listaProductos" v-on:click="seleccionarSku(`${producto.sku}`)" v-bind:title="producto.sku" style="cursor: pointer;">
                                            <td>{{producto.sku + `-` + producto.nombre}}</td>
                                            <td><img v-bind:src="`${invocarRutaImagen()}` + producto.imagen" width="50" /> </td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include BASE . 'commons/files/importFiles.php'; ?>
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
                        <div class="col-12  p-1">
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
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?= BASE ?>assets/js/adm_subcategoria.js?v=<?= time(); ?>" type="text/javascript"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>