
$(function () {
    comproCartFunctions();
});

function comproCartFunctions(){
  var comproCart = setInterval(ComproCargaCart, 1000);

  function ComproCargaCart() {
    if ($(".FreeShipping").length > 0) {
      setMsjPromoProvincia();
      //StopComproCargaCartFunction();
    }
  }
  
  function StopComproCargaCartFunction() {
    clearInterval(comproCart);
  }
}




function setMsjPromoProvincia(){
  if ($('.FreeShipping').length>0) {
    var total_cart = $(".Total div:last-child").html();
    var array_total = total_cart.split(" ");
    var amount_left = (199 - parseFloat(array_total[1])).toFixed(2);
    
    if(amount_left>0){
      if (!$('#FreeShippingProv').length) {
          $( ".FreeShipping" ).after( '<div class="FreeShipping"><div id="FreeShippingProv">Faltan <span>S/'+ amount_left+'</span> para que tu envio sea gratis. Valido para todas las Provincias.</div></div>' );
      }else{
        $("#FreeShippingProv").html('Faltan <span>S/'+ amount_left+'</span> para que tu envio sea gratis. Valido para todas las Provincias.');
        
      }
    }else{
      if (!$('#FreeShippingProv').length) {
          $( ".FreeShipping" ).after( '<div class="FreeShipping"><div id="FreeShippingProv">Tienes el envio GRATIS!. Valido para todas las Provincias.</div></div>' );
      }else{
        $("#FreeShippingProv").html('Tienes el envio GRATIS!. Valido para todas las Provincias.');
        
      }
    }
    
    /*console.log($("#FreeShippingProv").html());*/
  }
  /*$('.sumar').click(function(){  
    comproCartFunctions();
  });
  $('.restar').click(function(){ comproCartFunctions(); });*/
}







var place = document.getElementById("select-place-wsp");
var result_place_lima = ` <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Huaral</div><div class="div-address-place-wsp">Cc Mega Plaza Huaral</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997515458"><i class="fab fa-whatsapp"></i> 997 515 458 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Centro C&iacute;vico</div><div class="div-address-place-wsp">Cc Real Plaza Centro C&iacute;vico 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51967302682"><i class="fab fa-whatsapp"></i> 967 302 682 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Beverly Hills # 1 (Jir&oacute;n 1)</div><div class="div-address-place-wsp">Jr. de La Union 466 - Lima</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997570100"><i class="fab fa-whatsapp"></i> 997 570 100 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Conaco I</div><div class="div-address-place-wsp">Av. Abancay  200  - Lima</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51922670714"><i class="fab fa-whatsapp"></i> 922 670 714 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier El Firme Nro I</div><div class="div-address-place-wsp">Av Abancay 748 - 750 - Lima</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997518956"><i class="fab fa-whatsapp"></i>  997 518 956 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Jean - Mega Plaza</div><div class="div-address-place-wsp">Cc Mega Plaza Independencia 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997571014"><i class="fab fa-whatsapp"></i>  997 571 014 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Barranca</div><div class="div-address-place-wsp">Cc Mega Plaza Barranca 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51941523697"><i class="fab fa-whatsapp"></i>  941 523 697 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier San Miguel II</div><div class="div-address-place-wsp">Cc Plaza San Miguel 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51983323886"><i class="fab fa-whatsapp"></i>  983 323 886 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Tienda Planta</div><div class="div-address-place-wsp">Av. Lurigancho 1335 - San Juan De Lurigancho</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989065114"><i class="fab fa-whatsapp"></i>  989 065 114 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Pro</div><div class="div-address-place-wsp">Cc Real Plaza Pro - San Martin De Porres</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51994838031"><i class="fab fa-whatsapp"></i>  994 838 031 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Los Cedros</div><div class="div-address-place-wsp">Cc Mega Plaza Cedros De Villa 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989063515"><i class="fab fa-whatsapp"></i>  989 063 515 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Sta. Anita</div><div class="div-address-place-wsp">Cc Mall Aventura Santa Anita 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989063507"><i class="fab fa-whatsapp"></i>  989 063 507 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Ca&ntilde;ete</div><div class="div-address-place-wsp">Cc Mega Plaza Ca&ntilde;ete</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989308866"><i class="fab fa-whatsapp"></i>  989 308 866 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Chorrillos</div><div class="div-address-place-wsp">Cc Plaza Lima Sur Chorrillos</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989063512"><i class="fab fa-whatsapp"></i>  989 063 512 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Huacho</div><div class="div-address-place-wsp">Cc Plaza Del Sol Huacho 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51958792697"><i class="fab fa-whatsapp"></i>  958 792 697 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier La Molina</div><div class="div-address-place-wsp">Cal. Los Higos 164 Urb. Ampliacion Res. Monterrico - La Molina</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51934030925"><i class="fab fa-whatsapp"></i>  934 030 925 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia La Rambla Brasil</div><div class="div-address-place-wsp">Cc La Rambla Brasil 2do Nivel - Bre&ntilde;a</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51940174335"><i class="fab fa-whatsapp"></i>  940 174 335 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Lomas</div><div class="div-address-place-wsp">Av. Las Lomas 888 Urb. Zarate - San Juan Lurigancho</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51959152756"><i class="fab fa-whatsapp"></i>  959 152 756 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Huacho</div><div class="div-address-place-wsp">Av. 28 De Julio 349 - 353 - Huacho - Huaura</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51967302681"><i class="fab fa-whatsapp"></i>  967 302 681 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Santa Clara</div><div class="div-address-place-wsp">Cc Real Plaza Santa Clara</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997518938"><i class="fab fa-whatsapp"></i>  997 518 938 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Kids Aeropuerto</div><div class="div-address-place-wsp">Cc Inoutlet Faucett 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51948337146"><i class="fab fa-whatsapp"></i>  948 337 146 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Lurin</div><div class="div-address-place-wsp">Cc Inoutlet Lur&iacute;n</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51987328919"><i class="fab fa-whatsapp"></i>  987 328 919 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Jockey Plaza</div><div class="div-address-place-wsp">Cc Jockey Plaza Nuevo Hall 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51959328842"><i class="fab fa-whatsapp"></i>  959 328 842 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Lima Norte</div><div class="div-address-place-wsp">Cc Plaza Norte 1er Nivel - Independencia</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989067280"><i class="fab fa-whatsapp"></i>  989 067 280 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Jiron II</div><div class="div-address-place-wsp">Jr. De La Union 668 - Lima</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51983703606"><i class="fab fa-whatsapp"></i>  983 703 606 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Store Bellavista</div><div class="div-address-place-wsp">Cc Mall Plaza Bellavista 1er Nivel - Callao</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997571019"><i class="fab fa-whatsapp"></i>  997 571 019 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Portales Aeropuerto</div><div class="div-address-place-wsp">Cc Inoutlet Faucett 1er Nivel - Callao</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51962382109"><i class="fab fa-whatsapp"></i>  962 382 109 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Mall Del Sur</div><div class="div-address-place-wsp">Cc Mall Del Sur 1er Nivel - San Juan De Miraflores</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51986834185"><i class="fab fa-whatsapp"></i>  986 834 185 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier V. Salvador Mega Express</div><div class="div-address-place-wsp">Cc Mega Plaza Villa 1er Nivel - El Salvador</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51966426386"><i class="fab fa-whatsapp"></i>  966 426 386 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Oferta Mega Plaza</div><div class="div-address-place-wsp">Urb. Panamericana Norte Industrial Mz. A Lote. 2 - Independencia</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51987938471"><i class="fab fa-whatsapp"></i>  987 938 471 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Villa Maria Del Triunfo</div><div class="div-address-place-wsp">Cc Real Plaza Villa Mar&iacute;a 3er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51959328720"><i class="fab fa-whatsapp"></i>  959 328 720 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Minka</div><div class="div-address-place-wsp">Cc Minka Calle Fashion - Callao</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51987504173"><i class="fab fa-whatsapp"></i>  987 504 173 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Chosica</div><div class="div-address-place-wsp">Av 28 De Julio 329 Chosica (Altura Del Paradero Callao A Una Cuadra De La Estaci&oacute;n De Bomberos)</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51922666080"><i class="fab fa-whatsapp"></i>  922 666 080 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Puruchuco</div><div class="div-address-place-wsp">Cc Real Plaza Puruchuco</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51987328883"><i class="fab fa-whatsapp"></i>  987 328 883 </a></div></div>`;


var result_place_lima_2 = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Huacho</div><div class="div-address-place-wsp">Av. 28 De Julio 349 - 353 - Huacho - Huaura</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51967302681"><i class="fab fa-whatsapp"></i>  967 302 681 </a></div></div>`;

// var chimbooo = '<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Chimbote</div><div class="div-address-place-wsp">Cc Mega Plaza Chimbote</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997505292"><i class="fab fa-whatsapp"></i>  997 505 292 </a></div></div>';

var result_place_ancash2 = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Chimbote</div><div class="div-address-place-wsp">Cc Mega Plaza Chimbote</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997505292"><i class="fab fa-whatsapp"></i>  997 505 292 </a></div></div>
                         <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Huaraz</div><div class="div-address-place-wsp">Urb. Cercado De Huaraz Av. Mariscal Toribio Luzuriaga Nro. 533 - Huaraz</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989335810"><i class="fab fa-whatsapp"></i>  989 335 810 </a></div></div>`;

var result_place_ancash = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Huaraz</div><div class="div-address-place-wsp">Urb. Cercado De Huaraz Av. Mariscal Toribio Luzuriaga Nro. 533 - Huaraz</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989335810"><i class="fab fa-whatsapp"></i>  989 335 810 </a></div></div>`;

var result_place_apurimac = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Apurimac</div><div class="div-address-place-wsp">Jr. Arequipa 902 - Abancay - Abancay - Apurimac</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51980783428"><i class="fab fa-whatsapp"></i>  980 783 428 </a></div></div>`;


var result_place_arequipa = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Store Aventura</div><div class="div-address-place-wsp">Cc Mall Aventura Arequipa 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51993502140"><i class="fab fa-whatsapp"></i>  993 502 140 </a></div></div>
                           <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Gzuck Lambramani</div><div class="div-address-place-wsp">Cc Parque Lambramani 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51994626438"><i class="fab fa-whatsapp"></i>  994 626 438 </a></div></div>
                           <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Cayma</div><div class="div-address-place-wsp">Cc Mall Plaza Cayma</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989773132"><i class="fab fa-whatsapp"></i>  989 773 132 </a></div></div>
                           <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Mercaderes</div><div class="div-address-place-wsp">Cal. Mercaderes 401 - Arequipa - Arequipa - Arequipa</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51986843781"><i class="fab fa-whatsapp"></i>  986 843 781 </a></div></div>`;


var result_place_cajamarca = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Cajamarca</div><div class="div-address-place-wsp">Jr. Amazonas 531 Cajamarca - Cajamarca - Cajamarca</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997518934"><i class="fab fa-whatsapp"></i>  997 518 934 </a></div></div>
                            <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier C.C. Real Plaza</div><div class="div-address-place-wsp">Cc Real Plaza Cajamarca</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51983746209"><i class="fab fa-whatsapp"></i>  983 746 209 </a></div></div>
                            <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Chota</div><div class="div-address-place-wsp">Jr. Cajamarca 466 - 470 - Chota - Chota - Cajamarca</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51965779247"><i class="fab fa-whatsapp"></i>  965 779 247 </a></div></div>
                            <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Quinde Cajamarca</div><div class="div-address-place-wsp">Cc El Quinde Cajamarca</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51993502139"><i class="fab fa-whatsapp"></i>  993 502 139 </a></div></div>
                            <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Cutervo</div><div class="div-address-place-wsp">Jr. La Merced 740 - Cutervo - Cutervo - Cajamarca</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51974699185"><i class="fab fa-whatsapp"></i>  974 699 185 </a></div></div>
                            <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier San Ignacio</div><div class="div-address-place-wsp">Pionier San Ignacio Cajamarca</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997590904"><i class="fab fa-whatsapp"></i>  997 590 904 </a></div></div>`;

var result_place_chanchamayo = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier La Merced</div><div class="div-address-place-wsp">Jr. Tarma 264  Junin - Chanchamayo - Chanchamayo</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51993538800"><i class="fab fa-whatsapp"></i>  993 538 800 </a></div></div>`;

var result_place_cusco = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Cusco</div><div class="div-address-place-wsp">Cc Real Plaza Cusco 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989163984"><i class="fab fa-whatsapp"></i>  989 163 984 </a></div></div>`;

var result_place_huanuco2 = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Huanuco</div><div class="div-address-place-wsp">Cc Real Plaza Hu&aacute;nuco 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997571015"><i class="fab fa-whatsapp"></i>  997 571 015 </a></div></div>
                          <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Huanuco</div><div class="div-address-place-wsp">Cc Real Plaza Hu&aacute;nuco 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989163976"><i class="fab fa-whatsapp"></i>  989 163 976 </a></div></div>
                          <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Open Huanuco</div><div class="div-address-place-wsp">Cc Open Plaza Hu&aacute;nuco 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51974634821"><i class="fab fa-whatsapp"></i>  974 634 821 </a></div></div>
                          <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Tingo Maria</div><div class="div-address-place-wsp">Av. Tito Jaime F 465 Tingo Maria - Huanuco - Leoncio Prado - Rupa Rupa</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997569303"><i class="fab fa-whatsapp"></i>  997 569 303  </a></div></div>
                          <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Tingo Maria</div><div class="div-address-place-wsp">Av. Raymondi 676 , Tingo Mar&iacute;a, Departamento De Huanuco - Pronvincia Leoncio Prado - Distrito Rupa Rupa</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997518950"><i class="fab fa-whatsapp"></i>  997 518 950 </a></div></div>`;

var result_place_huanuco = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Tingo Maria</div><div class="div-address-place-wsp">Av. Raymondi 676 , Tingo Mar&iacute;a, Departamento De Huanuco - Pronvincia Leoncio Prado - Distrito Rupa Rupa</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997518950"><i class="fab fa-whatsapp"></i>  997 518 950 </a></div></div>`;

var result_place_ica = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Ica CC. El Quinde</div><div class="div-address-place-wsp">Pionier Ica CC. El Quinde</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997586016"><i class="fab fa-whatsapp"></i>  997 586 016 </a></div></div>
                      <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Chincha - C.C. Strip Center</div><div class="div-address-place-wsp">Cc Mega Plaza Chincha</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51983746175"><i class="fab fa-whatsapp"></i>  983 746 175 </a></div></div>
                      <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Pisco - Mega Plaza</div><div class="div-address-place-wsp">Cc Mega Plaza Pisco</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51982781203"><i class="fab fa-whatsapp"></i>  982 781 203 </a></div></div>
                      <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Ica - Plaza Del Sol</div><div class="div-address-place-wsp">Cc Plaza Del Sol Ica 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989018089"><i class="fab fa-whatsapp"></i>  989 018 089 </a></div></div>`;

var result_place_junin = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Tienda Huancayo - 2</div><div class="div-address-place-wsp">Calle Real 673-677 - Huancayo - Huancayo - Junin</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997508849"><i class="fab fa-whatsapp"></i>  997 508 849 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier C.C. Real Plaza Huancayo</div><div class="div-address-place-wsp">Cc Real Plaza Huancayo 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989018090"><i class="fab fa-whatsapp"></i>  989 018 090 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Tarma</div><div class="div-address-place-wsp">Jr. Lima 439 - Tarma - Tarma - Junin</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997269955"><i class="fab fa-whatsapp"></i>  997 269 955 </a></div></div>`;

                        var result_place_libertad = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Trujillo</div><div class="div-address-place-wsp">Jr. Francisco Pizarro 748 - Trujillo - Trujillo - La Libertad</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997568997"><i class="fab fa-whatsapp"></i>  997 568 997 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Store Mall Trujillo</div><div class="div-address-place-wsp">Cc Mall Plaza Trujillo</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989046011"><i class="fab fa-whatsapp"></i>  989 046 011 </a></div></div>`;

var result_place_lambayeque = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Store I I Chiclay</div><div class="div-address-place-wsp">Calle San Jos&eacute; 501 - Chiclayo - Chiclayo - Lambayeque</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51993510713"><i class="fab fa-whatsapp"></i>  993 510 713 </a></div></div>
                             <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Chiclayo</div><div class="div-address-place-wsp">Cal. San Jose 563 - Chiclayo - Chiclayo - Lambayeque</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997505293"><i class="fab fa-whatsapp"></i>  997 505 293 </a></div></div>
                             <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Balta Chiclayo</div><div class="div-address-place-wsp">Av. Jose Balta 1163 - Chiclayo - Chiclayo - Lambayeque</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997518936"><i class="fab fa-whatsapp"></i>  997 518 936 </a></div></div>
                             <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia - Real Plaza Chiclayo</div><div class="div-address-place-wsp">Cc Real Plaza Chiclayo</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51966426234"><i class="fab fa-whatsapp"></i>  966 426 234 </a></div></div>
                             <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia - Mall Aventura Chiclayo</div><div class="div-address-place-wsp">Cc Mall Aventura Chiclayo</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51922657025"><i class="fab fa-whatsapp"></i>  922 657 025 </a></div></div>`;

var result_place_loreto = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Iquitos</div><div class="div-address-place-wsp">Cal. Prospero 513 - Iquitos - Maynas - Loreto</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989079802"><i class="fab fa-whatsapp"></i>  989 079 802 </a></div></div>
                         <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Iquitos 2</div><div class="div-address-place-wsp">Cal. Prospero 888 - Iquitos - Maynas - Loreto</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51922670382"><i class="fab fa-whatsapp"></i>  922 670 382 </a></div></div>`;

var result_place_MadredeDios = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Madre De Dios</div><div class="div-address-place-wsp">Av. Leon Velarde 381-387 - Puerto Maldonado - Tambopata - Madre De Dios</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51997269966"><i class="fab fa-whatsapp"></i>  997 269 966 </a></div></div>`;

var result_place_Moquegua = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Moquegua</div><div class="div-address-place-wsp">Av. Circunvalacion Mza. S/N Lote 1B Int. 107 Fnd. El Gramadal - Moquegua - Mariscal Nieto - Moquegua</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51987937720"><i class="fab fa-whatsapp"></i>  987 937 720 </a></div></div>`;

var result_place_Piura = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Open Plaza Piura</div><div class="div-address-place-wsp">Cc Open Plaza Piura 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51994608848"><i class="fab fa-whatsapp"></i>  994 608 848 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Sullana</div><div class="div-address-place-wsp">Cal. San Martin 870-876-884 Sullana - Sullana - Piura</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51987328936"><i class="fab fa-whatsapp"></i>  987 328 936 </a></div></div>
                        <div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Piura II</div><div class="div-address-place-wsp">Av. Grau 330 - Piura</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51957317913"><i class="fab fa-whatsapp"></i>  957 317 913 </a></div></div>`;

var result_place_Puno = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Juliaca</div><div class="div-address-place-wsp">Cc Real Plaza Jualica 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51989046012"><i class="fab fa-whatsapp"></i>  989 046 012 </a></div></div>`;

var result_place_SanMartin = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Tarapoto</div><div class="div-address-place-wsp">Jr. Augusto B. Leguia 121 - Tarapoto - San Martin</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51940174334"><i class="fab fa-whatsapp"></i>  940 174 334 </a></div></div>
                            <div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Moyobamba</div><div class="div-address-place-wsp">Jr. Jose De San Martin S/N (Cdra.5 Esq. Jr. Serafin Filomeno) - San Martin</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51940174334"><i class="fab fa-whatsapp"></i>  940 174 334 </a></div></div>`;

var result_place_Tacna = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Diverxia Tacna</div><div class="div-address-place-wsp">Cal. San Martin 832 - Tacna - Tacna - Tacna</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51959328834"><i class="fab fa-whatsapp"></i>  959 328 834 </a></div></div>`;

var result_place_Tumbes = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Tumbes</div><div class="div-address-place-wsp">Cc Costa Mar Tumbes 2do Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51962297834"><i class="fab fa-whatsapp"></i>  962 297 834 </a></div></div>`;

var result_place_Ucayali = `<div class="div-link-place-wsp"><div class="div-title-place-wsp">Pionier Pucallpa</div><div class="div-address-place-wsp">Cc Open Plaza Pucallpa 1er Nivel</div><div class="div-number-place-wsp"><a  target="_blank"  href="https://api.whatsapp.com/send?phone=51944570328"><i class="fab fa-whatsapp"></i>  944 570 328 </a></div></div>`;

place.onchange = function() {
  var place_selected = document.getElementById("select-place-wsp").value;

  switch (place_selected) {
    case "Lima":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_lima_2;
      break;
    case "Ancash":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_ancash;
      break;
    case "Apurimac":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_apurimac;
      break;
    case "Arequipa":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_arequipa;
      break;
    case "Cajamarca":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_cajamarca;
      break;
    case "Chanchamayo":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_chanchamayo;
      break;
    case "Cusco":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_cusco;
      break;
    case "Huanuco":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_huanuco;
      break;
    case "Ica":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_ica;
      break;
    case "Junin":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_junin;
      break;
    case "La Libertad":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_libertad;
      break;
    case "Lambayeque":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_lambayeque;
      break;
    case "Loreto":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_loreto;
      break;
    case "Madre de Dios":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_MadredeDios;
      break;
    case "Moquegua":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_Moquegua;
      break;
    case "Piura":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_Piura;
      break;
    case "Puno":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_Puno;
      break;
    case "San Martin":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_SanMartin;
      break;
    case "Tacna":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_Tacna;
      break;
    case "Tumbes":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_Tumbes;
      break;
    case "Ucayali":
      document.getElementById("div-show-place-wsp").innerHTML = result_place_Ucayali;
      break;
    default:
      document.getElementById("div-show-place-wsp").innerHTML = result_place_lima_2;
      break;
  }
}


$(function() {
  document.getElementById("div-show-place-wsp").innerHTML = result_place_lima_2;
  //modal_index.style.display = "block";
});

var modal = document.getElementById("Modal-wsp");
var btn = document.getElementById("div-wsp");
var span = document.getElementsByClassName("close-wsp")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



//mensaje pionier
/*var modal_index = document.getElementById("Modal-index");
var close_index = document.getElementsByClassName("close-index")[0];
close_index.onclick = function() {
  modal_index.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal_index) {
    modal_index.style.display = "none";
  }
}*/



