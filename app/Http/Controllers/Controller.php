<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



     /**
     * Return error response with specified messages.
     *
     * @param array $items
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function error($items = null, $status = 401)
    {
        $items=json_decode($items);
        $data = [ 'message' => []];

        if ($items) {
            foreach($items as $key => $item) {
                $data['message'][$key] = $item[0];
            }
        }

        return response()->json($data, $status);
    }
}
