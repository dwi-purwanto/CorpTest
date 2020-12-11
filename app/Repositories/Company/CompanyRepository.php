<?php
namespace App\Repositories\Company;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyRepository implements CompanyInterface
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getDataPaginate()
    {
        return $this->company->orderBy('id', 'DESC')->paginate(5);
    }

    public function saveCompany($request)
    {
        DB::beginTransaction();
        try {
            $saveCompany = $this->company->create([
                'name'     =>  $request->name,
                'email'    =>  $request->email,
                'website'  =>  $request->website,
                'logo'     =>  $request->logo,
            ]);
            DB::commit();
            return $saveCompany;
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
    }

    public function findById($id)
    {
        $company = $this->company->where('id',$id)->first();

        if( $company != null ) {
            return $company;
        }else {
            return false;
        }
    }

    public function updateCompany($request, $uploadFile)
    {
        $findCompany = self::findById($request->companyId);
        DB::beginTransaction();

        if ($findCompany != null) {
            try {
                $findCompany->name    = $request->name;
                $findCompany->website = $request->website;
                $findCompany->email   = $request->email;
                if ($uploadFile != null) {
                    $findCompany->logo = $uploadFile;
                }
                $findCompany->update();
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

    public function deleteCompany($id)
    {
        $findCompany = self::findById($id);
        DB::beginTransaction();

        if ($findCompany != null) {
            try {
                $findCompany->delete();
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

    public function getAllIdName()
    {
        return $this->company->select('id', 'name')->orderBy('id', 'DESC')->get();
    }
}
