<?php

namespace Webdecero\Webcms\Controllers\Manager;

use Carbon\Carbon;
use Webdecero\Webcms\Models\Contact;
use Illuminate\Http\Request;
use MongoDB\BSON\UTCDateTime;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Controllers\Controller;

class ContactController extends Controller
{
    use ResponseApi;

    /**
     * ContactStore a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        try {

            $paginate = (int)$request->get('item', 25);

            $query = $request->input('query', null);
            $initDate = $request->input('initDate', null);
            $endDate = $request->input('endDate', null);


            $queryMongo = [];


            if (!empty($query)) {

                $queryMongo['$or'] = [
                    [
                        "name" => ['$regex' => "$query", '$options' => 'i']
                    ],
                    [
                        "message" => ['$regex' => "$query", '$options' => 'i']
                    ],
                    [
                        "email" => ['$regex' => "$query", '$options' => 'i']
                    ]
                ];
            }
            if (!empty($initDate)) {


                $queryMongo['$and'][]
                    = [
                        'created_at' => [
                            '$gte' => new UTCDateTime(new Carbon($initDate)),
                        ]
                    ];
            }
            if (!empty($endDate)) {

                $queryMongo['$and'][]
                    = [
                        'created_at' => [
                            '$lt' => new UTCDateTime(Carbon::parse($endDate)->addHour(23)),
                        ]
                    ];
            }

            if (!empty($queryMongo)) {
                $contact = Contact::whereRaw($queryMongo)->orderBy('_id', 'desc')->paginate($paginate);
            } else {
                $contact = Contact::orderBy('_id', 'desc')->paginate($paginate);
            }


            return $this->sendResponse($contact, 'ContactController contact');
        } catch (\Throwable $th) {
            return $this->sendError('ContactController contact', $th->getMessage(), $th->getCode());
        }
    }
}