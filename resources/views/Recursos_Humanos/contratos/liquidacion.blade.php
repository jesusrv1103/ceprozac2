
@inject('metodo','CEPROZAC\Http\Controllers\ContratosController')
<!DOCTYPE html>
<html>
<head>
  <title>Formato de Liquidacion</title>
</head>

<style type="text/css">
  #pesos {

    padding-left: 40px;
  }

  div {
    margin: 60px;
  }

</style>
<body>
  <div>
    <h4 align="left">{{$empresa->nombre}}</h4>
    <p align="right">{{$empresa->direcionFacturacion}}</p>
    <p align="right"> <strong>A {{substr($fecha,0,2)}} DE {{substr($empleado->fecha,6,7)}}<!--{{$mes =substr($fecha,3,2)}}--> {{ $metodo->calcularMes($mes)}} DEL {{substr($fecha,6,7)}}</strong></p>
    <p align="justify">RECIBI   DEL    C. {{$empresa->representanteLegal}} LA CANTIDAD DE <strong>{{ $sueldoNeto=$metodo->calcularMontoLiquidacion($empleado->sueldo_Fijo,$contrato->duracionContrato)}}</strong> (SON: {{ $metodo->calcularPesos($sueldoNeto)}}) POR CONCEPTO DE LIQUIDACION AL PUESTO QUE VENIA DESEMPEÑANDO DICHA CANTIDAD SE DETALLA A CONTINUACION:  </p>
    <table >
      <tr>
        <td>PARTE PROPORCIONAL DE AGUINALDO</td>
        <td id="pesos" >$</td>
        <td id="cantidad">{{$ppAguinaldo=round(15/360*$empleado->sueldo_Fijo*$contrato->duracionContrato,2)}}</td>
      </tr>
      <tr>
        <td>PARTE PROPORCIONAL DE VACACIONES</td>
        <td id="pesos" >$</td>
        <td id="cantidad">{{$ppVacasiones=round(6/365*$empleado->sueldo_Fijo*$contrato->duracionContrato,2)}}</td>
      </tr>

      <tr>
        <td>PARTE PROPORCIONAL DE PRIMA VAC.</td>
        <td id="pesos" >$</td>
        <td id="cantidad">{{$ppPrima_Vacasiones=round($ppVacasiones*($contrato->duracionContrato/100),2)}}</td>
      </tr>

      <tr>
        <td>PRIMA DE ANTIGÜEDAD</td>
        <td id="pesos">$</td>
        <td id="cantidad">{{$primaAntiguedad=round(12/365*$empleado->sueldo_Fijo*$contrato->duracionContrato,2)}}</td>
      </tr>

      <tr>
        <td align="right"> <strong>TOTAL</strong></td>
        <td id="pesos">$</td>
        <td id="cantidad">{{$sueldoNeto}}</td>
      </tr>


    </table>


    <br><br>
    <br><br>
    <center><p>RECIBI</p></center>
    <center><p><center><strong>{{$empleado->nombre}} {{$empleado->apellidos}}</strong></p></center>
    <br><br>
    <center><p>______________________________________</p></center>

  </div>

</body>
</html>
