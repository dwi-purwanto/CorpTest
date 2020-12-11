<?php
namespace App\Repositories\Company;

interface CompanyInterface {
    public function getDataPaginate();
    public function saveCompany($request);
    public function findById($id);
    public function updateCompany($request, $uploadFile);
    public function deleteCompany($id);
    public function getAllIdName();
}
