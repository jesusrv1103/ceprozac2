<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Recepción_Compra</title>
    <link rel="stylesheet" href="css/styleetiqueta.css" media="all" />
  </head>
  <body>
      <div style="border-width: 2px; border-style: dashed; border-color: black; ">
      <table>

        <thead >
          <tr>
            <th class="nombre">Nombre de la Materia Prima</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($material as $item)
            <td>
     <h1> {{ $item->nombre }}</h1> </td>



          </tr>
        </tbody>
      </table>

        @endforeach


      <table> 
      <thead> 
      <tr>

      <td> <?php $var=$item->id.$item->nombre; echo DNS1D::getBarcodeHTML("$item->codigo", "C128",1,40);?>
    <div style="text-align:center;">
    <font size=12 class="codigo ">{{$item->codigo}}
     </font>
     </div>
   </td>
   </tr>
   </thead>
   </table>
    <div><?php echo DNS2D::getBarcodeHTML('{$material->codigo}', "QRCODE",3,3);?></div> 


      </div>
  </body>

  
</html>