<?php
	session_start();
	define("BASE", "../");
	include(BASE . 'util/cnx.php');
	include(BASE . "util/util.php");

	$mi_orden_ps = (array_key_exists("orden", $_GET) == true ? $_GET["orden"]  : "");

	if (isset($_SESSION["n_orden"])) {
		$mi_orden_ps = $_SESSION["n_orden"];
	}

?>
<html>
<head>
	<?php include(BASE . 'commons/head.php'); ?>
	<title>TRACKING - PIONIERSTORE</title>
	<style>

		nav{
			display: none !important;
		}

		.head_card{
			padding: 2rem;
			padding-left: 20px;
			font-weight: bold;
		}
		.dir_texto{
			font-size: 12px;
			padding: 0;
			display: block;
			margin: 0;
		}
		.table_estilo{
			width: 100%;
		}
		.dir_texto_td{
			font-size: 14px;
		}
		.ancho_td_soles{
			width: 10px;
		}
		.ancho_td_precio{
			width: 100px;
		}
		.head_td_oscurito{
			font-weight: bold;
		}
	</style>
	
</head>

<body>

<?php include(BASE . 'commons/header.php'); ?>

<main class="seccion-main">
	<div id="cuerpo-lista" class="p-3">
	<div class="container-fluid p-1"><div id="contenido_x_tracking" class="container-fluid p-1">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                    <div class="col mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Dirección</h5>
                                <p class="dir_texto">CALLE DON POMPEYO 119, DPTO 401 - LIMA - LIMA - SANTIAGO DE SURCO</p>
                                <p class="dir_texto">A 6 CUADRAS DEL CC REAL PLAZA DE GUARDIA CIVIL</p>
                                <p class="dir_texto">LIMA, LIMA, SANTIAGO DE SURCO</p>
                                <p class="dir_texto"><b>ENVIO A DOMICILIO</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Forma de Pago</h5>
                                <p class="dir_texto">MERCADO PAGO</p>
                                <p class="dir_texto"><b>TID: </b>12394697038</p>
                                <p class="dir_texto"><b>Estado: </b>APPROVED</p>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Resumen</h5>
                                <table class="table_estilo">
                                    <tbody><tr>
                                        <td class="dir_texto_td"><b>Subtotal</b></td>
                                        <td class="dir_texto_td text-right ancho_td_soles">S/.</td>
                                        <td class="dir_texto_td text-right ancho_td_precio">70.00</td>
                                    </tr>
                                    <tr>
                                        <td class="dir_texto_td"><b>Envio</b></td>
                                        <td class="dir_texto_td text-right ancho_td_soles">S/.</td>
                                        <td class="dir_texto_td text-right ancho_td_precio">8.00</td>
                                    </tr>
                                    <tr>
                                        <td class="dir_texto_td"><b>Total</b></td>
                                        <td class="dir_texto_td text-right ancho_td_soles">S/.</td>
                                        <td class="dir_texto_td text-right ancho_td_precio">78.00</td>
                                    </tr>
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                </div><table class="table table-sm table-hover" id="mi_tabla_tacking">
<thead class="">
    <tr>
        <th colspan="2" class="head_td_oscurito">Producto</th>
        <th class="text-center head_td_oscurito">Tienda</th>
        <th class="text-center head_td_oscurito">Precio</th>
        <th class="text-center head_td_oscurito">Descuento</th>
        <th class="text-center head_td_oscurito">Cantidad </th>
        <th class="text-center head_td_oscurito">Subtotal</th>
    </tr>
</thead>
<tbody class="" id="my_t_informe"><tr>
                        <td class="text-center">
                            <img src="../../assets/img/producto/5081131974_1.jpg" width="70" alt="5081131974_1.jpg" class="table_img_pro">
                        </td>
                        <td>PANT. TWILL ANIMAL PRINT. CNT-TBL SHAINY CHARCOAL TALLA 32</td>
                        <td class="text-center">PIONIER  CHORRILLOS</td>
                        <td class="text-center"><label class="mi_label_precio">S/.139.00</label></td>
                        <td class="text-center">50%</td>
                        <td class="text-center">1</td>
                        <td class="text-center">
                            <label class="mi_label_sub_total">S/.70.00</label>
                        </td>
                    </tr></tbody></table></div></div>

	<div id="contenido_x_tracking" class="container-fluid p-1">

	</div>
</div>
</main>
<?php include(BASE . 'commons/footer.php'); ?>
<script type="text/javascript" src="tracking.js"></script>
</body>
</html>