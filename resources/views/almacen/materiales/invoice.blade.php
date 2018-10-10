<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>CBAMATERIALES</title>
    <link rel="stylesheet" href="css/stylepdf.css" media="all" />
  </head>
  <body>
      <div style="border-width: 2px; border-style: dashed; border-color: black; "> 
    <main>
      <table>
        <thead >
          <tr>
            <th class="nombre">Nombre</th>
            <th class="codigo">Codigo de Barras</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($material as $item)
    <td class="nombre">{{ $item->nombre }}<br /></td>
     <td> <?php echo DNS1D::getBarcodeHTML("$item->codigo", "C128",2,40);?>
    <div style="text-align:center;">
    <font size=18 class="codigo	">{{$item->codigo}} 
     </font>
   </td>

        @endforeach

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