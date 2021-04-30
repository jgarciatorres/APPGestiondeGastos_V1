<?php
session_start();
ob_start();
define("BASE", "../");
// if(isset($_SESSION['session_admin'])){
?>
<html lang="en">

<head>
    <?php include BASE . 'commons/head.php'; ?>
    <title> STOCK </title>
</head>

<body>
    <a href="menu.php">Volver</a>
    <main class="w-100 h-100">
        <section class=" m-3">
            <div>
                <div class="text-center">
                    <h3 class="pull-left">Gestionar inventario</h3>
                </div>
                <hr>
                <div class="text-left mb-3 mt-4">
                    <span>Utilice los siguientes filtros para encontrar su(s) producto(s)</span>
                </div>
                <form id="form-search-inventario">
                    <div class="card">
                        <div class="card-body bg-secondary">
                            <div id="form-msj" class="alert alert-dismissible fade show p-2">
                                <button id="close-alert" type="button" class="close p-1 pr-2">&times;</button>
                                <i class="fas fa-exclamation-circle"></i>
                                <span id="form-msj-text"></span>
                            </div>
                            <div class="form-group row m-1">
                                <div class="col-md-3 my-auto">
                                    <label for="product-sku" class="m-1">Filtrar por SKU:</label>
                                </div>
                                <div class="col-md-9 my-auto">
                                    <input id="product-sku" name="product-sku" type="number" placeholder="SKU del producto" class="form-control form-control-sm" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row m-1">
                                <div class="col-md-3 my-auto">
                                    <label for="product-nombre" class="m-1">Filtrar por Nombre:</label>
                                </div>
                                <div class="col-md-9 my-auto">
                                    <input id="product-nombre" name="product-nombre" type="text" placeholder="Nombre del producto" class="form-control form-control-sm" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row m-1">
                                <div class="col-md-3 my-auto">
                                    <label for="product-categoria" class="m-1">Filtrar por Categor&iacute;a:</label>
                                </div>
                                <div class="col-md-9 my-auto">
                                    <select id="product-categoria" name="product-categoria" class="custom-select custom-select-sm">
                                        <option value="0" selected>-- Seleccionar --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn p-1 pl-3 pr-3 btn-warning w-20"><span>Filtrar Productos</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section id="sec-progress">
            <div class="row mt-5 mb-5">
                <div class="col-12 text-center mb-2">
                    <div class="spinner-border text-warning"></div>
                </div>
                <div class="col-12 text-center">Cargando...</div>
            </div>
        </section>
        <section id="sec-table-result" class="m-3 mt-5">
            <form id="form-table-stock">
                <div class="row mb-2 pl-2 pr-2">
                    <div class="col-sm-6 text-center text-sm-left">
                        <button id="edit-select-stock" type="submit" class="btn btn-warning p-1 pl-3 pr-3">Editar Seleccionados</button>
                    </div>
                    <div class="col-sm-6 text-center text-sm-right">
                        <a id="export-result-stock" href="#">Exportar Resultado</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sticky">
                        <thead class="text-center">
                            <tr>
                                <th><span>Seleccionar Todo</span></th>
                                <th class="text-left"><span>Producto</span></th>
                                <th><span>Stock Total</span></th>
                                <th><span>Stock Reservado</span></th>
                                <th><span>Stock Disponible</span></th>
                                <th><span>Status</span></th>
                                <th><span>Fecha de Actualizaci&oacute;n</span></th>
                                <th><span>Acciones</span></th>
                            </tr>
                        </thead>
                        <tbody id="tbody-stock-list-pro" class="text-center">
                            <tr>
                                <td>
                                    <input type="checkbox" name="stocks[]" value="0" class="check-select-edit form-control my-auto">
                                </td>
                                <td class="text-left">
                                    <span class="title-product">PRODUCTO DEFAULT</span>
                                    <br>
                                    <span class="small-text">
                                        ID del producto: 0 |
                                        SKU: 000000000
                                    </span>
                                    <br>
                                    <span class="small-text">
                                        Talla: 0
                                    </span>
                                </td>
                                <td><span>0</td>
                                <td><span>0</span></td>
                                <td><span>0</span></td>
                                <td><span>Activo</span></td>
                                <td><span>19/10/2020 18:00:26</span></td>
                                <td><a href="#"><span>Editar</span></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            <div class="d-none">
                <ul class="pagination float-right">
                    <li class="paginate_button page-item previous disabled" id="dtBasicExample_previous"><a href="#" aria-controls="dtBasicExample" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                    <li class="paginate_button page-item active"><a href="#" aria-controls="dtBasicExample" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dtBasicExample" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dtBasicExample" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dtBasicExample" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dtBasicExample" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dtBasicExample" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                    <li class="paginate_button page-item next" id="dtBasicExample_next"><a href="#" aria-controls="dtBasicExample" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                </ul>
            </div>
        </section>
        <section>
            <div class="modal fade" id="Modal-Actualizar-Stock">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div id="spinner-modal" class="row mt-5 mb-5">
                            <div class="col-12 text-center mb-2">
                                <div class="spinner-border text-warning"></div>
                            </div>
                            <div class="col-12 text-center">Cargando...</div>
                        </div>
                        <form id="form-actualizar-stock" class="m-0 p-0">
                            <div class="modal-header pt-2 pb-2">
                                <h5 class="modal-title">Actualizar Inventario</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div id="modal-body-stock" class="modal-body pb-0"></div>
                            <div class="modal-footer pt-0 pb-2 border-0">
                                <button type="button" class="btn btn-warning p-1 pl-3 pr-3 "><span>Guardar</span></button>
                                <button type="button" class="btn btn-secondary p-1 pl-3 pr-3 " data-dismiss="modal"><span>Cancelar</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <style>
        span,
        label {
            font-size: 14px;
        }

        .title-product {
            font-weight: 600;
        }

        .small-text {
            font-size: 12px;
        }
    </style>
    <script src="<?= BASE ?>assets/js/function_stock.js?v=<?= time(); ?>" type="text/javascript"></script>
</body>

</html>
<?php
// }else{
//     header('Location: '.BASE.'index.php');
// } 
?>