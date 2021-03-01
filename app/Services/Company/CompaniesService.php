<?php


namespace App\Services\Company;


use App\Models\Company;
use App\Models\User;

class CompaniesService
{
    public function create($companyData) {

        $company = Company::create($companyData);

        if (isset($companyData['users'])) {
            foreach ($companyData['users'] as $userData) {
                $user = User::firstOrCreate([
                    'id' => $userData['id'],
                    'name' => $userData['name'],
                    'age' => $userData['age']
                ]);

                $user->companies()->attach($company->id);

            }
        }

        return $company;
    }

    public function getCompanies($minAge = null, $maxAge = null)
    {
        return Company::with(['users' => function ($query) use ($minAge, $maxAge) {
            if($minAge) {
                $query->where('age', '>=', $minAge);
            }

            if ($maxAge) {
                $query->where('age', '<=', $maxAge);
            }

        }])->whereHas('users', function ($query) use ($minAge, $maxAge) {

            if($minAge) {
                $query->where('age', '>=', $minAge);
            }

            if ($maxAge) {
                $query->where('age', '<=', $maxAge);
            }

        })->get();
    }
}
