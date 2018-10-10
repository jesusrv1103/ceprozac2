<?php

namespace CEPROZAC\Http\Controllers;

use Illuminate\Http\Request;

use CEPROZAC\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use CEPROZAC\Http\Controllers\Controller;
use CEPROZAC\RolEmpleado;
use DB;
use Maatwebsite\Excel\Facades\Excel;

class RolEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles= DB::table('rol_empleados')->where('estado','Activo')->get();
        return view('Recursos_Humanos.rol.index',['roles' => $roles]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return  view('Recursos_Humanos.rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rol = new RolEmpleado;
        $rol->rol_Empleado=$request->get('rol');
        $rol->descripcion=$request->get('descripcion');
        $rol->estado='Activo';
        $rol->save();
        return Redirect::to('rol');
        
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
        $roles=RolEmpleado::findOrFail($id);
        return view("Recursos_Humanos.rol.edit",["roles"=>$roles]);
        
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
        $roles=RolEmpleado::findOrFail($id);
        $roles->rol_Empleado=$request->get('rol');
        $roles->descripcion=$request->get('descripcion');
        $roles->update();
        return Redirect::to('rol');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $rol=RolEmpleado::findOrFail($id);
      $rol->delete();
      return Redirect::to('rol');
  }


  public function excel()
  {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        Excel::create('Rol Empleados', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();

                $roles = RolEmpleado::select('rol_Empleado', 'descripcion')
                ->where('estado', 'Activo')
                ->get();       
                
                
                $sheet->fromArray($roles);
                $sheet->row(1,['Rol Empleado','Descripcion']);

                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

}
