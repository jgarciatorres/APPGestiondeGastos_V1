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
    <title> Gestor de Productos </title>
    <style type="text/css">
      #target {
        height: 400px;
        width: 700px;
        background-color: #f8f8f8;
        margin: 200px auto;
        overflow: hidden;
        border-radius: 5px;
        box-shadow: 2px 2px 5px #888;
      }

      .hover::before {
        content: 'Arrastre el excel aqui.';
        width: 100%;
        height: 100%;
        display: block;
        text-align: center;
        line-height: 400px;
        font-size: 24px;
      }

      #target>table {
        height: 250px;
        width: 400px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin: 75px auto;
      }

      #target>table td {
        text-align: center;
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
      }

      #target>table tr:first-child>td {
        border-top: 0px solid #ccc;
      }

      #target>table tr>td:first-child {
        border-left: 0px solid #ccc;
      }
    </style>
  </head>

  <body>
    <?php include BASE . 'commons/header.php'; ?>
    <div class="d-flex" id="wrapper">
      <?php include BASE . 'commons/sliderbar.php'; ?>
      <div id="page-content-wrapper">
        <div class="container-fluid">
          <main>
            <section class="m-3">
              <div class="text-left">
                <h3>Gestionar Productos</h3>
              </div>
              <hr>
              <div id="appProductos">
                <div class="row">
                  <div class="col text-center">
                    <button @click="tableToExcel('Table', 'pionierstore')"class="btn p-1 pl-3 pr-3 btn-theme" ><span>Exportar</span></button>
                  </div>
                  <div class="col text-center">
                      <label>Search SKU:</label>
                      <input type="text" v-model="search" placeholder="Ingresa SKU" class="form-control form-control-sm"/>
                  </div>
                  <div class="col text-center">
                    <h5>Total Productos: <span class="badge badge-warning">{{totalProductos}}</span></h5>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <table ref="tables" id="tabla" class="table table-bordered table-striped table-hover table-sticky">
                        <thead>
                          <tr>
                            <th><span>IDproducto</span></th>
                            <th><span>Sku</span></th>
                            <th><span>Nombre</span></th>
                            <th><span>IDsubmenu</span></th>
                            <th><span>Editar Categorizacion</span></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(producto,index) of filteredProductos" v-show="(pag-1) * num_results <= index && pag * num_results > index">
                            <td><span>{{producto.IDproducto}}</span></td>
                            <td><span>{{producto.codigoERP}}</span></td>
                            <td><span>{{producto.nombre}}</span></td>
                            <td v-if="producto.IDsubmenu==0">Sin Categoria</td>
                            <td v-else><span>Categorizado</span></td>
                            <td style="width: 30%">
                              <select v-bind:id="'selectcli'+producto.IDproducto" v-model="select" v-on:change="fetchsubmenu(producto.IDproducto)" class="custom-select custom-select-sm" required="required">
                                <option disabled v-bind:value="'0-'+producto.IDproducto"><span>[SELECCIONE MENU]</span></option>
                                <option v-for="men in menu" v-bind:value="men.IDmenu+'-'+producto.IDproducto"><span>{{ men.nombre }}</span></option>
                              </select>
                              <select v-bind:id="'selectsub'+producto.IDproducto" v-if="selecUnique===producto.IDproducto" v-on:change="submenuSave(producto.codigoERP)" v-model="selecta" class="custom-select custom-select-sm" required="required">
                                <option v-bind:value="'0-'+producto.IDproducto"><span>[SELECCIONE SUBMENU]</span></option>
                                <option v-for="menuArra in submenuArray[selectComo]" v-bind:value="menuArra.IDsubmenu"><span>{{ menuArra.nombre }}</span></option>
                              </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <table ref="table" id="tabla" class="table table-striped" v-show="false">
                      <thead>
                        <tr class="bg-primary text-light">
                          <th>IDproducto</th>
                          <th>codigoERP</th>
                          <th>nombre</th>
                          <th>IDsubmenu</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="producto of filteredProductos">
                          <td>{{producto.IDproducto}}</td>
                          <td>{{producto.codigoERP}}</td>
                          <td>{{producto.nombre}}</td>
                          <td>{{producto.IDsubmenu}}</td>
                        </tr>
                      </tbody>
                    </table>

                  </div>
                </div>

                <!-- pagination -->
                <nav aria-label="Page navigation example" class="text-center">
                  <ul class="pagination text-center">
                    <li class="page-item">
                      <a class="page-link" href="" aria-label="Previous" v-show="pag != 1" @click.prevent="pag -= 1">Anterior</a>
                    </li>
                    {{paginationProductos}}
                    <li class="page-item" v-for="page of pageCount">
                      <a class="page-link" @click.prevent="pag = page" v-show="pag == page && pag!=pageCount && pag!=pageCount-1">{{page}}</a>
                      <a class="page-link" @click.prevent="pag = page" v-show="pag+1 == page && pag!=pageCount-1 && pag!=pageCount-2">{{page}}</a>
                      <a class="page-link" @click.prevent="pag = page" v-show="page == pageCount-1">{{page}}</a>
                      <a class="page-link" @click.prevent="pag = page" v-show="page == pageCount">{{page}}</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="" aria-label="Next" v-show="pag * num_results / filteredProductos.length < 1" @click.prevent="pag += 1">Siguiente</a>
                    </li>
                  </ul>
                </nav>
                <!-- fin pagination -->
              </div>
            </section>
            <section>

              <div id="app">
                <div ref="target" id="target" class="hover">
                  <table>
                    <tr v-for="data in tableData">
                      <td v-for="row in data">{{row}}</td>
                    </tr>
                    <button @click="updateIDsubmenu(tableData)">export</button>
                  </table>
                </div>
              </div>
            </section>
          </main>
        </div>
      </div>
    </div>
    <?php include BASE . 'commons/footer.php'; ?>
    <script src="../assets/bootstrap/popper.min.js"></script>
    <script src="../assets/bootstrap/bootstrap.min.js"></script>
    <!--Vue.JS -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!--Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.15.2/axios.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.5/xlsx.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.js"></script> -->
    <script src="../assets/js/function_productos.js"></script>
  </body>

  </html>
<?php
} else {
  header('Location: ' . BASE . 'index.php');
}
?>