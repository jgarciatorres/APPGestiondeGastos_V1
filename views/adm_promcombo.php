<?php
session_start();
define("BASE", "../");
if (isset($_SESSION['session_admin'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include(BASE . 'commons/head.php'); ?>
        <title>Promociones Combo - Manager Norton</title>
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
                                <h4>Gestor de Combos</h4>
                            </div>
                            <hr>
                        </section>
                        <section class="m-2">
                        </section>
                    </main>
                </div>
            </div>
        </div>
        <?php include BASE . 'commons/footer.php'; ?>
    </body>

    </html>

<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>