<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\Api\CompanyResource;
use App\Http\Resources\Api\PostResource;
use App\Models\Company;
use App\Models\Post;
use Str;

class CompanyService
{
    public function createCompany(string $name, bool $isVerified): Company
    {
        return Company::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'deleted_at' => $isVerified ? NULL : now()
        ]);
    }

    public function getCompanyId(array $data): int
    {
        if(!isset($data['company_id'])){

            $companyName = $data['company_name'];
            $company = $this->createCompany($companyName, false);
            $companyId = $company->id;
        }else{

            $companyId = $data['company_id'];
        }

        return $companyId;
    }

        public function getAllCompanies():AnonymousResourceCollection
    {
        $companies = Company::all();
        return CompanyResource::collection($companies);
    }

    public function getCompanyReviews($companyId)
    {
        try {
            $company = Company::findOrFail($companyId);
            $reviews = PostResource::collection(Post::where('company_id', $company->id)->get());
            return $reviews;
        } catch (\Exception $ex) {
            throw new \Exception('Failed to retrieve company reviews');
        }
    }
}
