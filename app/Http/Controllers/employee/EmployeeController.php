<?php

namespace App\Http\Controllers\employee;
use App\Repositories\Employee\EmployeeInterface as EmployeeInterface;
use App\Repositories\Company\CompanyInterface as CompanyInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(EmployeeInterface $employeeRepository, CompanyInterface $companyRepository)
    {
        $this->employeeRepo = $employeeRepository;
        $this->companyRepo  = $companyRepository;
    }

    public function index()
    {
        $this->data['employees'] = $this->employeeRepo->getDataPaginate();
        $this->data['companies'] = $this->companyRepo->getAllIdName();

        return view('employees.index', $this->data);
    }

    public function store(EmployeeRequest $request)
    {
        $saveEmployee = $this->employeeRepo->saveEmployee($request);

        if($saveEmployee == TRUE) {
            return back()->with('success','Employee created successfully!');
        }else {
            return back()->with('error','Employee created failed!');
        }
    }

    public function show(Request $request)
    {
        $employee = $this->employeeRepo->findById($request->employee_id);
        if ( $employee != false ) {
            return $employee;
        }else {
            return false;
        }
    }

    public function update(EmployeeRequest $request)
    {
        $updateEmployee = $this->employeeRepo->updateEmployee($request);

        if ( $updateEmployee != false ) {
            return back()->with('success','Employee updated successfully!');
        }else {
            return back()->with('error','Employee updated error!');
        }

    }

    public function destroy($id)
    {
        $deleteEmployee = $this->employeeRepo->deleteEmployee($id);
        if ( $deleteEmployee != false ) {
            return back()->with('success','Employee deleted successfully!');
        }else {
            return back()->with('error','Employee deleted error!');
        }
    }

}
