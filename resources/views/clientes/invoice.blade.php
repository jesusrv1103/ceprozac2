<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="css/stylepdf.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="images/logoCeprozac.png"  width="100" height="100"/>
      </div>
      <h1>Listado de Clientes CEPROZAC</h1>
      <div id="company" class="clearfix">
        <div>Company Name</div>
        <div>455 Foggy Heights,<br /> AZ 85004, US</div>
        <div>(602) 519-0450</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>
      <div id="project">
        <div><span>EMPRESA</span> CEPROZAC</div>
        <div><span>DOMICILIO</span> KM 18 Carretera Santa Monica Pozo Gamboa</div>
        <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
        <div><span>DATE</span> August 17, 2015</div>
        <div><span>DUE DATE</span> September 17, 2015</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="nombre">Nombre</th>
            <th class="rfc">RFC</th>
            <th class="fiscal">Fiscal</th>
            <th class="telefono">Teléfono</th>
            <th class="email">Email</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            @foreach ($datas as $item)
    <td class="nombre">{{ $item->nombre }}<br /></td>
    <td class="rfc">{{ $item->rfc }}<br /></td>
    <td class="fiscal">{{ $item->fiscal }}<br /></td>
    <td class="telefono">{{ $item->telefono }}<br /></td>
    <td class="email">{{ $item->email }}<br /></td>
        @endforeach

          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>Nota::</div>
        <div class="notice">Listado de Clientes  CEPROZAC.</div>
      </div>
    </main>
    <footer>
    </footer>
  </body>
</html>