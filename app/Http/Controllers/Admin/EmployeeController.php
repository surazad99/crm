<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Company;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        try{
            $employees = $company->employees()->paginate(PAGINATE);
            return view('admin.employees.index', compact('company', 'employees'));

        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        try{
            return view('admin.employees.create', compact('company'));
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
    public function store(EmployeeCreateRequest $employeeCreateRequest, Company $company)
    {
        $validatedEmployee = $employeeCreateRequest->validated();
        try{
            $company->employees()->create($validatedEmployee);
            return redirect()->route('companies.employees.index', $company)->with('success', 'Employee created successfully.');

        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, Employee $employee)
    {
        try{
            return view('admin.employees.show', compact('company', 'employee'));
            
        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Employee $employee)
    {
        try{
            return view('admin.employees.edit', compact('company', 'employee'));

        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $employeeUpdateRequest, Company $company, Employee $employee)
    {
        $validatedEmployee = $employeeUpdateRequest->validated();
        try{
            $employee->update($validatedEmployee);
            return redirect()->route('companies.employees.index', [$company, $employee])->with('success', 'Employee updated successfully.');

        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, Employee $employee)
    {
        try{
            $employee->delete();
            return redirect()->route('companies.employees.index', [$company, $employee])->with('success', 'Employee deleted successfully.');

        }catch(Exception $exception){
            return redirect()->back()->with('exception', $exception->getMessage());

        }
    }
}
