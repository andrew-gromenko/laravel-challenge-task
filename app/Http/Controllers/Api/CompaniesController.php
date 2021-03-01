<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Services\Company\CompaniesService;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * @var CompaniesService
     */
    protected $companiesService;

    public function __construct(CompaniesService $companiesService)
    {
        $this->companiesService = $companiesService;
    }

    public function store(CompanyCreateRequest $request) {
        return $this->companiesService->create($request->all());
    }

    public function getCompanies(Request $request)
    {
        return response()->json([
            'companies' => $this->companiesService->getCompanies($request->min_age, $request->max_age)
        ]);
    }
}
