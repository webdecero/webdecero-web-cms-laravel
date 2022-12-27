<?php

namespace Webdecero\CMS\Controllers;

use Exception;
use Validator;
use Webdecero\CMS\Models\Contact;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Webdecero\CMS\Mail\ContactNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    use ResponseApi;

    public function sendNotificationContact(Request $request) {
        try {
            
            $input = $request->all();
            
            $rules = [
                'name' => 'required|string',
                'last_name' => 'string|sometimes',
                'phone' => 'sometimes',
                'email' => 'required|string',
                'message' => 'required|string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Validation error', $validator->errors()->all(), 422);

            $dataEmail = [];

            // dd($input['phone']);

            if ($input['name'] != null) {
                $dataEmail['name'] = $input['name'];
            }
            if ($input['last_name'] != null) {
                $dataEmail['last_name'] = $input['last_name'];
            }
            if ($input['email'] != null) {
                $dataEmail['email'] = $input['email'];
            }
            if ($input['message'] != null) {
                $dataEmail['message'] = $input['message'];
            }
            
            Mail::to('programacion@webdecero.com')->send(new ContactNotification($dataEmail, $input['phone']));
            
            return $this->sendResponse(true,'Correo enviado');
        } catch (\Exception $th) {
            return $this->sendError('MailController Error', $th->getMessage(), $th->getCode());
        }
    }

}