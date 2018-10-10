<?php

namespace CEPROZAC\Http\Controllers;
use Illuminate\Http\Request;
use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\Empleado;
use CEPROZAC\RolEmpleado;
use CEPROZAC\EmpleadoRoles;
use DB;
use Maatwebsite\Excel\Facades\Excel;


class EmpleadoController extends Controller
{


 public function __construct()
 {
  $this->middleware('guest', ['except' => 'getLogout']);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $empleados= DB::table('empleados')
      ->select('empleados.*')
      ->where('empleados.tipo','=','NORMAL')
      ->where('empleados.estado','Activo')->get();
      return view('Recursos_Humanos.empleados.index', ['empleados' => $empleados]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response

     */
    public function create()
    {
      $empleado= Empleado::all();

      $roles=DB::table('rol_empleados')->where('estado','=' ,'Activo')->get();
      return view("Recursos_Humanos.empleados.create",["roles"=>$roles,'empleado'=>$empleado]);


    }

    
    public function verInformacion($id)
    {
      $empleado=Empleado::findOrFail($id);
      $roles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('rol_empleados.rol_Empleado')
      ->where('idEmpleado','=',$id)
      ->get();
      return view("Recursos_Humanos.empleados.informacionEmpleado",["empleado"=>$empleado,'roles'=>$roles]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     DB::beginTransaction();
     $empleado= new Empleado;
     $empleado->nombre=$request->get('nombre');
     $empleado->apellidos=$request->get('apellidos');
     $empleado->fecha_Ingreso=$request->get('fecha_Ingreso');
     $empleado->fecha_Alta_Seguro=$request->get('fecha_Alta_Seguro');
     $empleado->numero_Seguro_Social=$request->get('numero_Seguro_Social');
     $empleado->fecha_Nacimiento=$request->get('fecha_Nacimiento');
     $empleado->curp=$request->get('curp');
     $empleado->email=$request->get('email');
     $empleado->telefono=$request->get('telefono');
     $empleado->sueldo_Fijo=$request->get('sueldo_Fijo');
     $empleado->domicilio=$request->get('domicilio');
     $empleado->estado='Activo';
     $empleado->tipo='NORMAL';
     substr($_REQUEST['curp'], 10,1) == "H"?$empleado->sexo="Hombre":$empleado->sexo="Mujer";
     $empleado->save();
     $idEmpleado=$empleado->id;


     $idRol= $request->get('idRol');

     $cont = 0;
     while($cont < count($idRol))
     {
      $roles= new EmpleadoRoles;
      $roles->idEmpleado=$idEmpleado;
      $roles->idRol=$idRol[$cont];
      $cont = $cont+1;
      $roles->save();
    }

    DB::commit();
    return Redirect::to('empleados');
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $empleado=Empleado::findOrFail($id);
      $roles=DB::table('rol_empleados')->where('estado',"=","Activo")->get();
      $listadoRoles= EmpleadoRoles::join('empleados','empleados.id','=','empleado_roles.idEmpleado')
      ->join('rol_empleados','rol_empleados.id','=','empleado_roles.idRol')
      ->select('empleado_roles.id','rol_empleados.rol_Empleado')
      ->where('idEmpleado','=',$id)
      ->get();
      return view("Recursos_Humanos.empleados.edit",["empleado"=>$empleado,"roles"=>$roles,"listadoRoles"=>$listadoRoles]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      DB::beginTransaction();
      $empleado=Empleado::findOrFail($id);
      $empleado->nombre=$request->get('nombre');
      $empleado->apellidos=$request->get('apellidos');
      $empleado->fecha_Ingreso=$request->get('fecha_Ingreso');
      $empleado->fecha_Alta_Seguro=$request->get('fecha_Alta_Seguro');
      $empleado->numero_Seguro_Social=$request->get('numero_Seguro_Social');
      $empleado->fecha_Nacimiento=$request->get('fecha_Nacimiento');
      $empleado->curp=$request->get('curp');
      $empleado->email=$request->get('email');
      $empleado->telefono=$request->get('telefono');
      $empleado->sueldo_Fijo=$request->get('sueldo_Fijo');
      $empleado->estado='Activo';
      substr($_REQUEST['curp'], 10,1) == "H"?$empleado->sexo="Hombre":$empleado->sexo="Mujer";
      $empleado->update();      

      DB::commit();
      return Redirect::to('empleados');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $empleado=Empleado::findOrFail($id);
      $empleado->estado="Inactivo";
      $empleado->update();
      return Redirect::to('empleados');
    }


    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Lista empleados', function($excel) {
          $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

            $empleado = Empleado::select('empleados.nombre', 'empleados.apellidos', 'empleados.fecha_Ingreso', 'empleados.fecha_Alta_Seguro','empleados.numero_Seguro_Social','empleados.fecha_Nacimiento','empleados.curp','empleados.email','empleados.telefono','empleados.sexo','empleados.sueldo_Fijo')
            ->where('empleados.estado', 'Activo')
            ->get();       
            $sheet->fromArray($empleado);
            $sheet->row(1,['Nombre ','Apellido','Fecha Ingreso','Fecha Alta Seguro','Numero seguro Social','Fecha Nacimiento','CURP','Correo','Telefono','Sexo','Sueldo']);

            $sheet->setOrientation('landscape');
          });
        })->export('xls');
      }


      public function listaCuentasEmpresa(){


        return view('Provedores.empresas.listacuentas');

      }



      public function validarCURP($curp_or_ssn)
      {

        $empleado= Empleado::
        select('nombre','apellidos','estado','id','tipo','curp','numero_Seguro_Social')
        ->where('curp','=',$curp_or_ssn)
        ->orwhere('numero_Seguro_Social','=',$curp_or_ssn)
        ->get();
        return response()->json(
          $empleado->toArray());

      }


      public function activar(Request $request)
      { 
        $id =  $request->get('idEmpleado');
        $empleados=Empleado::findOrFail($id);
        $empleados->estado="Activo";
        $empleados->update();
        return Redirect::to('empleados');
      }

    }
