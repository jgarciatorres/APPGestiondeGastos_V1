<?php
session_start();
ob_start();
define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include BASE . 'commons/head.php'; ?>
        <title>Inventario - Manager Norton</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/bootstrap-select.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" integrity="sha256-7stu7f6AB+1rx5IqD8I+XuIcK4gSnpeGeSjqsODU+Rk=" crossorigin="anonymous" />
    </head>

    <body>
        <?php include BASE . 'commons/header.php'; ?>
        <div class="d-flex" id="wrapper">
            <?php include BASE . 'commons/sliderbar.php'; ?>
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <main id="appStock" class="p-1 p-md-3">
                        <section class="m-2">
                            <div class="text-left">
                                <h4>Gestor de Inventario</h4>
                            </div>
                            <hr>
                            <form id="form-search-inventario">
                                <div class="card">
                                    <div class="row collapse-body">
                                        <div class="col-12 mb-3">
                                            <small>Utilice los siguientes filtros para encontrar su(s) producto(s):</small>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Filtrar por SubCategor&iacute;a</span>
                                                </div>
                                                <select id="product-subcategoria" name="product-subcategoria" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" data-actions-box="true" multiple>
                                                    <option value="0" selected>-- Cargando --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Filtrar por Nombre</span>
                                                </div>
                                                <input id="product-nombre" name="product-nombre" type="text" placeholder="" class="form-control form-control-sm" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Filtrar por SKU</span>
                                                </div>
                                                <input id="product-sku" name="product-sku" type="number" placeholder="" class="form-control form-control-sm" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Filtrar por Almacen</span>
                                                </div>
                                                <input id="product-almacen" name="product-almacen" type="text" placeholder="" class="form-control form-control-sm" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center btns-actions-form">
                                            <button type="submit" id="submit-filtrar" class="btn btn-sm btn-theme mb-4">Buscar Productos</button>
                                            <button type="button" id="export-stock" class="btn btn-sm btn-theme-2 mb-4"><i class="fas fa-file-download"></i> Exportar Stock</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </section>
                        <section class="m-2">
                            <nav class="mt-4">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item"><a id="mi_btn_anterior" class="page-link">Anterior</a></li>
                                    <li class="page-item"><a id="mi_pagina_actual" class="page-link">1 / 1</a></li>
                                    <li class="page-item"><a id="mi_btn_siguiente" class="page-link">Siguiente</a></li>
                                </ul>
                            </nav>
                            <div class="row-fluid table-responsive">
                                <table class="table table-striped table-hover table-sticky">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Producto</th>
                                            <th class="sticky-table-column">SKU</th>
                                            <th>Almacen</th>
                                            <th>Talla</th>
                                            <th>Stock Total</th>
                                            <th>Stock Reservado (NC)</th>
                                            <th>Stock Disponible</th>
                                            <th>Actualizar Stock</th>
                                            <th>Fecha Actualizacion</th>
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
        <?php include BASE . 'commons/footer.php'; ?>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/doubleScroll/doubleScroll.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js" integrity="sha256-qoj3D1oB1r2TAdqKTYuWObh01rIVC1Gmw9vWp1+q5xw=" crossorigin="anonymous"></script>
        <script src="<?= BASE ?>assets/js/adm_stock.js?v=<?= time(); ?>" type="text/javascript"></script>
    </body>

    </html>
<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>