<?php
session_start();
define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Catalogo Imagen - Manager Norton</title>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/adm_imagen.css?v=<?= time(); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>assets/css/adm_complemento.css?v=<?= time(); ?>">
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
                                <h4>Gestor de Imagenes</h4>
                            </div>
                            <hr>
                            <div class="container-center">
                                <form id="form_u_imagen" class="mb-4" name="form_u_imagen" autocomplete="off" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="x_sku_x">Busca el SKU:</label>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="input-group input-group-sm">
                                                <input type="number" class="form-control form-control-sm" id="x_sku_x" name="x_sku_x" placeholder="5000000000" required />
                                                <div class="input-group-append">
                                                    <input type="hidden" class="d-none" id="x_current_sku_x" name="x_current_sku_x" style="display: none;" readonly />
                                                    <button class="btn btn-sm btn-theme" id="x_buscar_x" name="x_buscar_x" type="submit">Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php include BASE . 'commons/files/importFiles.php'; ?>



                                <form action="s" method="post" class="dropzone p-1 mb-4" enctype="multipart/form-data" id="upload-image">
                                    <div class="fallback">
                                        <input name="file" type="file" accept="image/png, .jpeg, .jpg, image/gif" id="file" multiple="true" /> <br>
                                        <div class="dz-message needsclick">
                                        </div>
                                    </div>
                                </form>
                                <div id="situacion_sku" class="mb-4 text-center">

                                </div>
                                <div class="table-responsive">
                                    <table id="tabla_img_orden" class="table table-sm table-hover">
                                        <thead>
                                            <tr class="my-t-header">
                                                <td class="text-center my-colum-desing"></td>
                                                <td class="text-center my-colum-desing">Imagen</td>
                                                <td class="text-center my-colum-desing">Sku</td>
                                                <td class="text-center my-colum-desing">Orden</td>
                                                <td class="text-center my-colum-desing"></td>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla_img_body" class="my-t-body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>


        <div id="mi_visor_img_repo" class="mi_visor_img_repo">
            <div class="mi_visor_contenedor">
                <img id="mi_img_seleccionada" class="mi_img_seleccionada" src="" alt="Imagen Seleccionada">
                <div id="mi_visor_img_close" class="mi_visor_img_close btn-danger">
                    <div class="mi_visor_img_close_hijo">X</div>
                </div>
            </div>
        </div>
        <?php include BASE . 'commons/footer.php'; ?>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/rowsorter/RowSorter.js"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/adm_imagen.js?v=<?= time(); ?>"></script>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>