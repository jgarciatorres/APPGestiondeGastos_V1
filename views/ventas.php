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
    <title>Ventas - Manager Norton</title>
    <!-- <style type="text/css">
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
    </style> -->
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
                <h4>Gestor de Ventas</h4>
              </div>
              <hr>
              <div id="appProductos">
                <div class="row mb-4">
                  <!-- <div class="col text-center">
                    <button @click="tableToExcel('Table', 'pionierstore')"class="btn p-1 pl-3 pr-3 btn-theme" ><span>Exportar</span></button>
                  </div> -->
                  <div class="col-12 mb-3">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Buscar Nro de Orden</span>
                      </div>
                      <input type="text" v-model="search_tracking" placeholder="Ingresa Tracking" class="form-control form-control-sm" />
                    </div>
                  </div>
                  <!-- <div class="col text-center"> -->
                    <!-- <h5>Total Ventas: <span class="badge badge-warning">{{totalProductos}}</span></h5> -->
                  <!-- </div> -->
                </div>
                <div class="table-responsive">
                  <table ref="tables" id="tabla" class="table table-striped table-hover table-sticky">
                    <thead>
                      <tr>
                        <th>N_orden</th>
                        <th>Nombre y Apellidos</th>
                        <th>Email</th>
                        <th>Direccion Entrega</th>
                        <th>Tipo Despacho</th>
                        <th>Monto Total</th>
                        <th>Fecha</th>
                        <th>Status</th>
                        <th>Pedido</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="venta of filteredVenta">
                        <td>{{venta.n_orden}}</td>
                        <td>{{venta.nombres+' '+venta.apellidos}}</td>
                        <td>{{venta.email}}</td>
                        <td>{{venta.direccion_entrega}}</td>
                        <td>{{venta.tipo_despacho}}</td>
                        <td>{{venta.monto_total}}</td>
                        <td>{{venta.fproceso}}</td>
                        <td>{{venta.estado}}</td>
                        <th><a :href="'https://www.pionierstore.com/views/tracking.php?orden='+venta.n_orden">Ver Pedido</a></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- pagination -->
                <!-- <nav aria-label="Page navigation example" class="text-center">
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
                </nav> -->
                <!-- fin pagination -->
              </div>
            </section>
            <section>

              <!--               <div id="app">
                <div ref="target" id="target" class="hover">
                  <table>
                    <tr v-for="data in tableData">
                      <td v-for="row in data">{{row}}</td>
                    </tr>
                    <button @click="updateIDsubmenu(tableData)">export</button>
                  </table>
                </div>
              </div> -->
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