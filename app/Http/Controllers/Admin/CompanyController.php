<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $companies = Company::paginate(1);
            return view('admin.companies.index', compact('companies'));
        }catch(Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('admin.companies.create');
        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $companyCreateRequest)
    {
        $validatedCompany = $companyCreateRequest->validated();
        try{
            $validatedCompany['logo'] = storeImage($validatedCompany['logo'], COMPANY_LOGO_URL);
            Company::create($validatedCompany);
            return redirect()->route('companies.index')->with('success', 'Company created successfully.');
        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        try{
            return view('admin.companies.show', compact('company'));
        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        try{
            return view('admin.companies.edit', compact('company'));
        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $companyUpdateRequest, Company $company)
    {
        $validatedCompany = $companyUpdateRequest->validated();
        try {

            if(isset($validatedCompany['logo'])){

                $validatedCompany['logo'] = storeImage($validatedCompany['logo'], COMPANY_LOGO_URL);
                //Delete Existing File
                deleteImage($company->logo, COMPANY_LOGO_URL);

            }
            $company->update($validatedCompany);
            return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
        }catch(Exception $exception){

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        try{
            deleteImage($company->logo, COMPANY_LOGO_URL);
            $company->delete();
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');

        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }
}
