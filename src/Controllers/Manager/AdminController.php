<?php


namespace Webdecero\Webcms\Controllers\Manager;

// use Exception;

use Exception;
//Class
use Throwable;
use Webdecero\Webcms\Models\Admin;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends ManagerController
{
    use ResponseApi;

    public function getAuth()
    {
        try {
            $admin = Auth::user();
            if (empty($admin)) throw new Exception('Usario no encontrado');

            $admin = $this->_formatItem($admin);


            return $this->sendResponse($admin, 'Administrador encontrado');
        } catch (Exception $th) {
            return $this->sendError('Admin getAuth', $th->getMessage(), $th->getCode());
        }
    }

    public function show($id)
    {
        try {

            $admin = Admin::find($id);
            if (empty($admin)) throw new Exception('No se encontro ningun administrador');


            $admin = $this->_formatItem($admin);

            return $this->sendResponse($admin, 'Administrador encontrado');
        } catch (Exception $th) {
            return $this->sendError('Admin Info', $th->getMessage(), $th->getCode());
        }
    }

    public function listAdmin()
    {
        try {

            $admin = Admin::all();

            if (empty($admin)) throw new Exception('No hay administradores disponibles');

            return $this->sendResponse($admin, 'Lista de Administradores');
        } catch (Exception $th) {
            return $this->sendError('Admin listAdmin', $th->getMessage(), $th->getCode());
        }
    }


    public function store(Request $request)
    {
        try {

            $input = $request->all();
            $rules = [
                'name' => 'required',
                'email' => 'required|unique:admin,email',
                'password' => 'required|min:6|confirmed',
                'status' => 'string',
                'image' => 'sometimes',
                'description' => 'string',
            ];
            $validator = Validator::make($input, $rules);

            if ($validator->fails()) return $this->sendError('Error de validacion', $validator->errors()->all(), 422);

            $admin = new Admin();
            $admin->fill($input);
            $admin['status'] = Admin::STATUS_TRUE;
            $admin->save();

            return $this->sendResponse($admin, 'Ahora hay un nuevo administrador');
        } catch (Exception $th) {

            return $this->sendError('Admin Store', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $input = $request->all();
            $rules = [
                'name' => 'string',
                'email' => 'email', 'unique:admin,email,' . $id,
                'password' => 'sometimes|min:6|confirmed',
                'image' => 'sometimes',
                'description' => 'string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validacion', $validator->errors()->all(), 422);

            $admin = Admin::findOrFail($id);
            $admin->fill($input);
            $admin->save();

            return $this->sendResponse($admin, 'Se han actualizado los cambios');
        } catch (Exception $th) {

            return $this->sendError('Admin Update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {

            $adminAunth = $request->user();
            if (empty($adminAunth)) throw new Exception('No se encontro ningun administrador');

            $admin = Admin::findOrFail($id);
            if ($adminAunth->id === $admin->id) return $this->sendError('Error', 'No puede autoeliminarse', 404);

            $admin->delete();
            return $this->sendResponse(true, 'La eliminacion del administrador fue exitosa');
        } catch (Exception $th) {
            return $this->sendError('Admin Destroy', $th->getMessage(), $th->getCode());
        }
    }

    /**
     * _formatItem da formato al los compos y agrega la base uri a image
     *
     * @param  mixed $admin
     * @return void
     */
    private function _formatItem($admin)
    {

        if ($admin->image) {
            $admin->image = url($admin->image);
        }

        return $admin;
    }
}