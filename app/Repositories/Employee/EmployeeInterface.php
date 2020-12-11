<?php
namespace App\Repositories\Employee;

interface EmployeeInterface {
    public function getDataPaginate();
    public function saveEmployee($request);
    public function findById($id);
    public function updateEmployee($request);
    public function deleteEmployee($id);
}
