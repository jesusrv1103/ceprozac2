<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CBAMATERIALES</title>
    <link rel="stylesheet" href="css/fumigacion.css" media="all" />
  </head>
  <body>
      <div style="border-width: 0px; "> 
    <header class="clearfix">
      <div id="logo">

      </div>
      <table> <td> <?php echo DNS2D::getBarcodeHTML("$fumigaciones->codigo", "QRCODE",3,3);?></table>
         


      <h1>Reporte de Compra {{$fumigaciones->destino}} </h1>
      <div id="project" >
        <div><span>Nombre de Lote: {{$fumigaciones->agroquimicos}}</div></span>
        <div><span>Fecha de Compra:  {{$fumigaciones->cantidad_aplicada}}</div> </span>
        <div><span>Proveedor:       {{$fumigaciones->fechai}}</div></span>
        <div><span>HORA DE INICIO: {{$fumigaciones->horai}}</div></span>
        <div><span>FECHA DE TERMINO: {{$fumigaciones->fechaf}}</div></span>
        <div><span>HORA DE TERMINO:  {{$fumigaciones->horaf}}</div></span>
      </div>
    </header>
    <main>
      <table>
        <thead >
          <tr>
            <th class="codigo">Codigo de Barras</th>
          </tr>
        </thead>
        <tbody>
          <tr>

     <td> <?php echo DNS1D::getBarcodeHTML("$fumigaciones->codigo", "C128",1,40);?>
    <div style="text-align:left;">
    <font size=18 class="codigo	">{{$fumigaciones->codigo}} 
     </font>
   </td>


          </tr>
        </tbody>
      </table>
      </div>
    </main>
    <footer>
    </footer>
    </div>
  </body>

</html>