<?php
session_start();

define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Catalogo Textura - Manager Norton</title>
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
                                <h4>Generador de Texturas</h4>
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
                                    <!-- <div id="situacion_sku" class="mb-4 p-1"></div> -->
                                    <div class="p-1 mb-4 text-center">
                                        <div id="img_crop_editar">
                                            <img src="" id="cropbox" alt="" title="Imagen" />
                                        </div>
                                    </div>
                                    <form id="form_pro_textura" name="form_pro_textura" autocomplete="off" method="post" class="text-center">
                                        <input type="hidden" id="imgentidad" name="imgentidad" value="0" />
                                        <input type="hidden" id="x" name="x" value="0" />
                                        <input type="hidden" id="y" name="y" value="0" />
                                        <input type="hidden" id="w" name="w" value="0" />
                                        <input type="hidden" id="h" name="h" value="0" />
                                        <button class="btn btn-sm btn-theme" type="submit" value="" class="btn btn-large btn-inverse">Recortar Imagen</button>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>



        <?php include BASE . 'commons/footer.php'; ?>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/jcrop/jquery.Jcrop.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/js/adm_textura.js?v=<?= time(); ?>"></script>

    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>