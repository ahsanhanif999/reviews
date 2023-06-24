<?php

namespace App\Services;

use App\Models\Company;
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
}
