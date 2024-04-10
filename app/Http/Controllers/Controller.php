<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $breadcrumbs = [];

    public function addBreadcrumb($name, $url, $state)
    {
        array_push($this->breadcrumbs, ['name' => $name, 'url' => $url, 'state' => $state]);
    }
}
