<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company;

use Auth;

class CompanyController extends Controller
{
    public function index(Request $request): Response
    {
        $companies = Company::all();

        return Response(['companies' => $companies, 'success' => true], 200);
    }
}
