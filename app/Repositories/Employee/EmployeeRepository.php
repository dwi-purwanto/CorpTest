<?php
namespace App\Repositories\Employee;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeRepository implements EmployeeInterface
{
    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getDataPaginate()
    {
        return $this->employee->orderBy('id', 'DESC')->with('company')->paginate(5);
    }

    public function saveEmployee($request)
    {
        {
            DB::beginTransaction();
            try {
                $saveEmployee = $this->employee->create($request->all());
                DB::commit();
                return $saveEmployee;
            } catch (\Throwable $th) {
                throw $th;
                DB::rollback();
            }
        }
    }

    public function findById($id)
    {
        $employee = $this->employee->with('company')->where('id',$id)->first();

        if( $employee != null ) {
            return $employee;
        }else {
            return false;
        }
    }

    public function updateEmployee($request)
    {
        $findEmployee = self::findById($request->employeeId);

        DB::beginTransaction();
        if ($findEmployee != null) {
            try {
                $findEmployee->update($request->all());
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                throw $th;
                DB::rollback();
                return false;
            }
        }else{
            return false;
        }
    }

    public function deleteEmployee($id)
    {
        $findEmployee = self::findById($id);
        DB::beginTransaction();

        if ($findEmployee != null) {
            try {
                $findEmployee->delete();
                DB::commit();
                return true;
            } catch (\Throwable $th) {
                throw $th;
                DB::rollback();
                return false;
            }
        }else{
            return false;
        }

    }
}
