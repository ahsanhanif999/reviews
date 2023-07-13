<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Company;
use App\Http\Resources\Api\PostResource;
use App\Services\CompanyService;

use Auth;

class CompanyController extends Controller
{
    private $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    
    public function index(Request $request): Response
    {
        $companies = $this->companyService->getAllCompanies();

        return response(['companies' => $companies, 'success' => true], 200);
    }

    public function show($id)
    {
        try {
            $reviews = $this->companyService->getCompanyReviews($id);
            return response(['reviews' => $reviews, 'success' => true], 200);
        } catch (\Exception $ex) {
            return response(['message' => $ex->getMessage()], 500);
        }
    }
}
