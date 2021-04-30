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
            <div id="msg-alert" style="top: -80px;display:none;">
                <div class="alert alert-success"><span>gfhfghfgh</span></div>
            </div>
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
                                    <input id="product-sku" name="product-sku" type="number" placeholder="SKU del producto" class="form-control form-control-sm" autocomplete="off" >
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
            <!-- <div class="progress" style="height:30px;">
                <div id="bar" class="progress-bar progress-bar-striped progress-bar-animated bg-warning text-dark" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" >
                    <span id="span-bar"></span>
                </div>
            </div> -->
            <div class="row mt-5 mb-5">
                <div class="col-12 text-center mb-2">
                    <div class="spinner-border text-warning"></div>
                </div>
                <div class="col-12 text-center">Cargando...</div>
			</div>
        </section>
        <section class="m-3 mt-5 d-none">
            <table class="table table-striped table-hover">
                <caption><span>Lista de Productos y sus SKUs</span></caption>
                <thead class="">
                    <tr>
                        <th class="text-center"><span>Imagen</span></th>
                        <th><span>Nombre</span></th>
                        <th><span>Skus</span></th>
                        <th><span>Status</span></th>
                        <th><span>Fecha de Actualizaci&oacute;n</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="image" style="text-align: center">
                            <img class="img-polaroid" height="100" width="100" alt="ZAPATILLA SWEET SCAPE Zapatilla pionier sweet scape white-32-5100702940" title="ZAPATILLA SWEET SCAPE Zapatilla pionier sweet scape white-32-5100702940" src="<?= BASE ?>assets/img/config/no-imagen.jpg">
                        </td>
                        <td class="product">
                            ZAPATILLA SWEET SCAPE
                            <br>
                            <a id="" href="/zapatilla-sweet-scape-PDEV-96-01426/p" target="_blank"><span>Ver en el sitio</span></a>
                        </td>
                        <td class="sku">
                            <ul class="pl-0">
                                <li>
                                    <a href="" title="Edit SKU (Zapatilla pionier sweet scape black-32-5100702939)">Zapatilla pionier sweet scape black-32-5100702939 (8097)</a>
                                </li>
                                <li>
                                    <a href="" title="Edit SKU (Zapatilla pionier sweet scape black-32-5100702939)">Zapatilla pionier sweet scape black-32-5100702939 (8097)</a>
                                </li>
                            </ul>
                        </td>
                        <td class="status"><span>Activo</span></td>
                        <td id="" class="">
                            <span>19/10/2020 18:00:26</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section id="sec-table-result" class="m-3 mt-5">
            <form id="form-table-stock">
                <div class="row mb-2 pl-2 pr-2">
                    <div class="col-md-6">
                        <button id="edit-select-stock" type="submit" class="btn btn-warning">Editar Seleccionados</button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a id="export-result-stock" href="#">Exportar Resultado</a>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover table-sticky">
                    <thead class="text-center">
                        <tr>
                            <th><span>Seleccionar</span></th>
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
                                <input type="checkbox" class="form-control my-auto bg-warning" id="stock-check-product" name="stock-check-product">
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
    </main>
    <style>
        .sku ul li {
            list-style: none;
        }
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