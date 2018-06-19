<?php
/**
 * Created by PhpStorm.
 * User: zippyttech
 * Date: 06/04/18
 * Time: 02:10 PM
 */

namespace App\Http\Controllers\Tatuco;

use App\Http\Services\Tatuco\ParamService;
use Illuminate\Http\Request;

class ParamController extends TatucoController
{
    public function __construct()
    {
        $this->service = new ParamService();
        $this->campo = 'par_id';
        $this->status = 'active';
    }

    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->service->update($this->campo,$id, $this->status, $request);
    }

}