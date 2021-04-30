<?php
session_start();

define("BASE", "../");

if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Catalogo Categoria - Manager Norton</title>
        <!-- <link rel="stylesheet" href="<?php echo BASE; ?>assets/normalize/normalize.css"> -->
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/dropzone/dropzone.css"> -->
        <!-- <link rel="stylesheet" href="<?php echo BASE; ?>assets/alertifyjs/css/alertify.min.css">
        <link rel="stylesheet" href="<?php echo BASE; ?>assets/alertifyjs/css/themes/default.min.css"> -->
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
                                <h4>Gestor de Categorias</h4>
                            </div>
                            <hr>
                            <div class="container-center">
                                <div class="accordion">
                                    <div class="card">
                                        <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                            Registro de Categoria
                                        </button>
                                        <div id="collapseOne" class="collapse">
                                            <form id="producto_gruardar" name="producto_gruardar" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                                <input type="hidden" id="pro_producto" name="pro_producto" value="0" style="display:none" class="d-none" />
                                                <div class="row collapse-body">
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Categoria</span>
                                                            </div>
                                                            <input type="text" id="pro_categoria" name="pro_categoria" class="form-control" placeholder="BILLETERA" minlength="3" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Orden</span>
                                                            </div>
                                                            <input type="number" id="pro_orden" name="pro_orden" class="form-control form-control-md" min="0" value="0" required>
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
                                    <div class="card">
                                        <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                            Filtrar Resultados
                                        </button>
                                        <div id="collapseTwo" class="collapse">
                                            <div class="row collapse-body">
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">SKU del Producto</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fil_sku_producto" name="fil_sku_producto">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Nombre del Producto</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fil_nombre_producto" name="fil_nombre_producto">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Estado del Producto</span>
                                                        </div>
                                                        <select class="form-control" id="fil_estado_producto" name="fil_estado_producto">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 pb-4 text-center btns-actions-form">
                                                    <button type="submit" class="btn btn-sm btn-theme">Buscar por Filtrado</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="m-2">
                            <div class="container-center">
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
                                                <th>Orden</th>
                                                <th>Fecha Registro</th>
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
        
        <?php include BASE . 'commons/footer.php'; ?>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?= BASE ?>assets/js/adm_categoria.js?v=<?= time(); ?>" type="text/javascript"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>