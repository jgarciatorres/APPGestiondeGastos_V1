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
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" integrity="sha256-7stu7f6AB+1rx5IqD8I+XuIcK4gSnpeGeSjqsODU+Rk=" crossorigin="anonymous" /> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.19.1/dist/editor.min.js"></script> -->
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
                                <h4>Gestor de Posts</h4>
                            </div>
                            <hr>
                            <div class="accordion">
                                <div class="card">
                                    <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                        Blog Categorias
                                    </button>
                                    <div id="collapseOne" class="collapse">
                                        <div class="container-center">
                                            <form id="form-blog-categorias" action="#" method="post" autocomplete="off" enctype="multipart/form-data">
                                                <div class="collapse-body">
                                                    <input type="hidden" id="cat-id" name="cat-id" value="0" style="display:none" class="d-none" />
                                                    <input type="hidden" id="cat-ant-img" name="cat-ant-img" style="display:none" class="d-none" />
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Categoria</span>
                                                        </div>
                                                        <input type="text" id="cat-nombre" name="cat-nombre" class="form-control form-control-sm" placeholder="" minlength="5" required>
                                                    </div>
                                                    <div class="input-img-file" id="cat-img">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Imagen Preview</span>
                                                            </div>
                                                            <input type="text" id="cat-img-nombre" name="cat-img-nombre" class="form-control form-control-sm" placeholder='Seleccione una imagen...' required>
                                                        </div>
                                                        <div class="text-center img-thumbnail_container">
                                                            <img src="../../assets/upload/blog/categories/default.png" width="300px" alt="" class="img-thumbnail">
                                                            <button type="button" class="bg-theme btn-delete-float btn-reset-file">&times;</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 pb-4 text-center btns-actions-form">
                                                        <button type="button" id="btn-cat-nuevo" class="btn btn-sm btn-theme" title="Nuevo"><i class="fas fa-plus"></i> Nuevo</button>
                                                        <button type="submit" id="btn-cat-guardar" class="btn btn-sm btn-theme" title="Guardar" disabled><i class="fas fa-save"></i> Guardar</button>
                                                        <button type="reset" id="btn-cat-cancelar" class="btn btn-sm btn-theme-3" title="Cancelar" disabled><i class="fas fa-window-close"></i> Cancelar</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row-fluid table-responsive mt-3">
                                                <table class="table table-striped table-hover table-sticky">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Nombre de la Categoria</th>
                                                            <th>Imagen</th>
                                                            <th>Url</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-cargar-categorias" class="text-center">
                                                    </tbody>
                                                </table>
                                                <div id="my_carga_posts_category" class="my_capa_negra" style="display: none;">
                                                    <div class="my_contenido_cargando">
                                                        <div class="spinner-border text-theme"></div>
                                                        <p class="my_texto_cargando">Cargando...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <button class="btn btn-block btn-block-collapse text-left" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                        Blog Post
                                    </button>
                                    <div id="collapseTwo" class="collapse">
                                        <form id="form-blogpost" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <div class="row collapse-body mb-2">
                                                <input type="hidden" id="post-id" name="post-id" value="0" style="display:none" class="d-none" />
                                                <input type="hidden" id="post-ant-img" name="post-ant-img" style="display:none" class="d-none" />
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Categoria</span>
                                                        </div>
                                                        <select id="post-cat" name="post-cat" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" required>
                                                            <option value="0" disabled>-- Cargando --</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Titulo</span>
                                                        </div>
                                                        <input type="text" id="post-title" name="post-title" class="form-control form-control-sm" placeholder="" minlength="5" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-img-file" id="post-previewimg">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">Imagen Preview</span>
                                                            </div>
                                                            <input type="text" id="post-previewimg-nombre" name="post-previewimg-nombre" class="form-control form-control-sm" placeholder='Seleccione una imagen...' required>
                                                        </div>
                                                        <div class="text-center img-thumbnail_container">
                                                            <img src="../../assets/upload/blog/post/default.png" width="300px" alt="" class="img-thumbnail">
                                                            <button type="button" class="bg-theme btn-delete-float btn-reset-file">&times;</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Contenido Preview</span>
                                                        </div>
                                                        <textarea name="post-previewbody" id="post-previewbody" rows="11" class="w-100 form-control form-control-sm" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <textarea name="post-body" id="post-body" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 pb-4 text-center btns-actions-form">
                                                    <button type="button" id="btn-post-nuevo" class="btn btn-sm btn-theme" title="Nuevo"><i class="fas fa-plus"></i> Nuevo</button>
                                                    <button type="submit" id="btn-post-guardar" class="btn btn-sm btn-theme" title="Guardar" disabled><i class="fas fa-save"></i> Guardar</button>
                                                    <button type="reset" id="btn-post-cancelar" class="btn btn-sm btn-theme-3" title="Cancelar" disabled><i class="fas fa-window-close"></i> Cancelar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form id="form-search-post" class="mt-3">
                                <div class="card">
                                    <div class="row collapse-body">
                                        <div class="col-12 mb-3">
                                            <small>Utilice los siguientes filtros para encontrar su(s) post(s):</small>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Filtrar por Categor&iacute;a</span>
                                                </div>
                                                <select id="filter-post-cat" name="filter-post-cat" class="form-control form-control-sm selectpicker" data-container="body" data-size="10" data-live-search="true" data-style="border" data-actions-box="true" multiple>
                                                    <option value="0" disabled>-- Cargando --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Filtrar por Titulo</span>
                                                </div>
                                                <input id="filter-post-title" name="filter-post-title" type="text" placeholder="" class="form-control form-control-sm" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center btns-actions-form">
                                            <button type="submit" id="submit-filtrar" class="btn btn-sm btn-theme mb-4">Buscar Posts</button>
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
                                            <th>Acciones</th>
                                            <th>Categoria</th>
                                            <th>Titulo</th>
                                            <th>Preview Contenido</th>
                                            <th>Url</th>
                                            <th>Fecha Actualizacion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-cargar-posts" class="text-center">
                                    </tbody>
                                </table>
                                <div id="my_carga_posts" class="my_capa_negra" style="display: none;">
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
        <script type="text/javascript" src="<?php echo BASE; ?>assets/ckeditor/ckeditor.js?v=<?= time(); ?>"></script>
        <script type="text/javascript" src="<?php echo BASE; ?>assets/ckfinder/ckfinder.js?v=<?= time(); ?>"></script>
        <script src="<?= BASE ?>assets/js/adm_blogposts.js?v=<?= time(); ?>" type="text/javascript"></script>
        <style>
            .cke_button__emojione_icon {
                background: url('http://localhost/norton.pe/Manager/assets/ckeditor/plugins/icons_hidpi.png?t=L0QD') no-repeat 0 -3128px !important;
                background-size: 60px !important;
            }
            .cke_bottom {
                background: var(--themecolor)!important;
            }
            .cke_chrome {
                border-color: var(--themecolor)!important;
            }
            a.cke_path_item , span.cke_path_empty{
                color: #ffffff !important; 
                text-shadow: 0 1px 0 #191919 !important;
            }
            .cke_resizer {
                border-color: transparent #fff transparent transparent!important;
            }
        </style>
    </body>

    </html>
<?php
} else {
    header('Location: ' . BASE . 'index.php');
}
?>