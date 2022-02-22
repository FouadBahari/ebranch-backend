<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;

class OrderController extends Controller
{
    use GeneralTrait;

    public function __construct() {
        $this->middleware('auth:api', ['except' => ['signup']]);
    }
}
