<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Support\UsesJsonResponse;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, SoftDeletes, UsesJsonResponse, ValidatesRequests;
}
