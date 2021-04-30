<?php
session_start();

define("BASE", "../");

if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

        <?php include(BASE . 'commons/head.php'); ?>
        <title>Categoria</title>
        <style>
            .texto_sobrecargado {
                white-space: nowrap;
                max-width: 250px;
                overflow: hidden;
            }

            .mi_contenedor {
                width: 100%;
                height: 50px;
                overflow: auto;
                padding: 0;
                margin: 0;
            }

            .mi_celda_boton {
                min-width: 100px;
            }

            .mi_celda_normal {
                min-width: 180px;
            }

            .mi_celda_nombre {
                min-width: 400px;
            }

            /*CAPA DE CARGANDO*/
            .my_capa_negra {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.2);
                color: white;
                z-index: 500;
            }

            .my_contenido_cargando {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .my_cargando {
                border: 8px solid #f3f3f3;
                border-radius: 50%;
                border-top: 8px solid #007bff;
                width: 60px;
                height: 60px;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }

            .my_texto_cargando {
                position: fixed;
                padding-top: 120px;
            }

            .pro_mensaje_importacion {
                line-height: 1;
                font-size: 11px;
            }

            .dropzone .dz-preview .dz-progress {
                background: none;
            }

            .dropzone .dz-preview .dz-image {
                width: 250px;
                height: 100px;
            }

            .dz-remove {
                background: #ff0000;
            }

            .dz-remove:hover,
            .dz-remove:active {
                background: #d20606;
                cursor: pointer;
            }

            .dz-remove>label {
                color: #ffffff;
                font-weight: 900;
                vertical-align: sub;
            }

            .dropzone {
                border: 1px solid rgba(0, 0, 0, 0.3);
            }

            .dropzone:hover,
            .dropzone:active {
                cursor: pointer;
                border: 0.5 solid red;
            }

            .dropzone .dz-preview.dz-file-preview .dz-image {
                border-radius: unset;
                border: 1px solid rgba(0, 0, 0, 0.3);
                background: white;
            }

            .dropzone .dz-preview .dz-details .dz-size {
                margin-bottom: 0;
            }

            .x_subir_arch_card:hover,
            .x_subir_arch_card:active {
                border: 0.5 solid brown;
            }

            .card-header {
                background: white;
                padding: 0;
                text-decoration: none;
            }

            @-webkit-keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                }

                100% {
                    -webkit-transform: rotate(360deg);
                }
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    </head>

    <body>
        <?php include BASE . 'commons/header.php'; ?>
        <div class="d-flex" id="wrapper">
            <?php include BASE . 'commons/sliderbar.php'; ?>
            <div id="page-content-wrapper">
                <div class="container-fluid p-0">
                    <main>

                        <section class="m-2">
                            <div class="text-left">
                                <h3>Categoria</h3>
                            </div>
                            <hr>

                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                Registro de Categoria
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <form class="m-1" id="producto_gruardar" name="producto_gruardar" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                                <input type="hidden" id="pro_producto" name="pro_producto" value="0" style="display:none" class="d-none" />

                                                <div class="col px-0 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <label for="pro_categoria" class="">Categoria</label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" id="pro_categoria" name="pro_categoria" class="form-control" placeholder="BILLETERA" minlength="3" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <label for="pro_categoria" class="col-md-2 col-lg-1 col-form-label col-form-label-md">Categoria</label>
                                                    <div class="col-md-10 col-lg-11">
                                                        <input type="text" id="pro_categoria" name="pro_categoria" class="form-control form-control-md" placeholder="BILLETERA" minlength="3" required>
                                                    </div>
                                                </div> -->

                                                <div class="col px-0 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <label for="pro_sku_1" class="">SKU 1</label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" id="pro_sku_1" name="pro_sku_1" class="form-control form-control-sm" min="0" value="0" readonly required>
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-sm btn-dark" v-on:click="toggleModal(1)">Buscar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- <div class="form-group row">
                                                    <label for="pro_sku_1" class="col-md-2 col-lg-1 col-form-label col-form-label-md">Sku 1</label>
                                                    <div class="col-md-10 col-lg-11">
                                                        <input type="number" id="pro_sku_1" name="pro_sku_1" class="form-control form-control-sm" min="0" value="0" readonly required>
                                                        <button type="button" class="btn btn-sm btn-primary btn-sm" v-on:click="toggleModal(1)">seleccionar sku</button>
                                                    </div>
                                                </div> -->

                                                <div class="col px-0 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <label for="pro_sku_2" class="">SKU 2</label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" id="pro_sku_2" name="pro_sku_2" class="form-control form-control-sm" min="0" value="0" readonly required>
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-sm btn-dark" v-on:click="toggleModal(2)">Buscar</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <label for="pro_sku_2" class="col-md-2 col-lg-1 col-form-label col-form-label-md">Sku 2</label>
                                                    <div class="col-md-10 col-lg-11">
                                                        <input type="number" id="pro_sku_2" name="pro_sku_2" class="form-control form-control-sm" min="0" value="0" readonly required>
                                                        <button type="button" class="btn btn-sm btn-primary btn-sm" v-on:click="toggleModal(2)">seleccionar sku</button>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-group row">
                                                    <label for="pro_orden" class="col-md-2 col-lg-1 col-form-label col-form-label-md">Orden</label>
                                                    <div class="col-md-10 col-lg-11">
                                                        <input type="number" id="pro_orden" name="pro_orden" class="form-control form-control-md" min="0" value="0" required>
                                                    </div>
                                                </div> -->

                                                <div class="col px-0 mb-4">
                                                    <div class="row">
                                                        <div class="col-md-1">
                                                            <label for="pro_orden" class="">Orden</label>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" id="pro_orden" name="pro_orden" class="form-control form-control-md" min="0" value="0" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" id="btn_producto_nuevo" class="btn btn-sm btn-dark" title="Nuevo"><i class="fas fa-plus"></i> Nuevo</button>
                                                <button type="submit" id="btn_producto_guardar" class="btn btn-sm btn-dark" title="Guardar" disabled><i class="fas fa-save"></i> Guardar</button>
                                                <button type="reset" id="btn_producto_cancelar" class="btn btn-sm btn-dark" title="Cancelar" disabled><i class="fas fa-window-close"></i> Cancelar</button>

                                                <button type="reset" id="btn_producto_exportar" class="btn btn-sm btn-dark" title="Exportar"><i class="fas fa-file-download"></i> Exportar</button>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Filtrar resultado
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="col px-0 mb-4">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="fil_sku_producto" class="">Escribir SKU del producto</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" class="form-control" id="fil_sku_producto" name="fil_sku_producto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col px-0 mb-4">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="fil_nombre_producto" class="">Escribir nombre del producto</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" class="form-control" id="fil_nombre_producto" name="fil_nombre_producto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col px-0 mb-4">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="fil_estado_producto" class="">Seleccionar estado producto</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group input-group-sm">
                                                            <select class="form-control" id="fil_estado_producto" name="fil_estado_producto">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col px-0 mb-4">
                                                <button type="submit" class="btn btn-sm btn-dark">Buscar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </section>
                        <section class="m-2">
                            <div class="col-lg-12 px-0 py-1 ">

                                <nav class="">
                                    <ul class="pagination pagination justify-content-end">
                                        <li class="page-item"><a id="mi_btn_anterior" class="page-link bg-black">Anterior</a></li>
                                        <li class="page-item"><a id="mi_pagina_actual" class="page-link bg-black">1 / 1</a></li>
                                        <li class="page-item"><a id="mi_btn_siguiente" class="page-link bg-black">Siguiente</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="text-center">
                                        <tr>
                                            <th><span></span></th>
                                            <th><span>Categoria</span></th>
                                            <th><span>Sku 1</span></th>
                                            <th><span>Sku 2</span></th>
                                            <th><span>Orden</span></th>
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


                <template>
                    <div>
                        <!-- <button type="button" class="btn btn-primary" >My Modal</button> -->
                        <div ref="modal" class="modal fade" :class="{show, 'd-block': active}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header py-1">
                                        <h5 class="modal-title">Buscar sku</h5>
                                        <button type="button" class="close py-2" data-dismiss="modal" aria-label="Close" v-on:click="toggleModal(0)">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form v-on:submit="formFindSkuByName($event)">

                                            <div class="col px-0 mb-4">
                                                <label for="pro_buscar_sku" class="">Escribir nombre del producto</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="pro_buscar_sku" name="pro_buscar_sku" v-on:keyup="findSkuByName()" v-model="findText">

                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-sm btn-dark">Buscar</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <li class="category-filter-item-content-list-item" v-for="producto in productos">
                                                    <div class="form-group form-check">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="radio" v-bind:id="`${invocarPrefijo()}` + producto.sku" v-bind:value="producto.IDproducto" v-on:change="seleccionSku()" v-model="checkedProductos" />{{producto.sku}}
                                                        </label>
                                                    </div>
                                                </li> -->

                                            <div class="table-responsive" style="height: 300px;">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><span>Nombre</span></th>
                                                            <th scope="col"><span>Img</span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="producto in listaProductos" v-on:click="seleccionarSku(`${producto.sku}`)" v-bind:title="producto.sku" style="cursor: pointer;">
                                                            <td>{{producto.sku + `-` + producto.nombre}}</td>
                                                            <td><img v-bind:src="`${invocarRutaImagen()}` + producto.imagen" width="50" /> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="active" class="modal-backdrop fade show"></div>
                    </div>
                </template>

            </div>
        </div>

        <?php include BASE . 'commons/footer.php'; ?>

        <script type="text/javascript" src="<?php echo BASE; ?>assets/alertifyjs/js/alertify.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/vue.js?v=<?= time(); ?>"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/axios.js?v=<?= time(); ?>"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?= BASE ?>assets/js/adm_v_categoria.js?v=<?= time(); ?>" type="text/javascript"></script>

    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>