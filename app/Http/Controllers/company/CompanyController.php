<?php

namespace App\Http\Controllers\company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Repositories\Company\CompanyInterface as CompanyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct(CompanyInterface $companyRepository)
    {
        $this->companyRepo = $companyRepository;
    }

    public function index()
    {
        $this->data['companies'] = $this->companyRepo->getDataPaginate();

        return view('companies.index', $this->data);
    }

    public function store(CompanyRequest $request)
    {

        if ($request->hasFile('logo') ) {
            $uploadFile = $this->uploadFile($request->file('logo'));
            if($uploadFile != FALSE ) {
                $request->logo = $uploadFile;
                // return $request->logo;
                $saveCompany = $this->companyRepo->saveCompany($request);
                if($saveCompany == TRUE) {
                    return back()->with('success','Item created successfully!');
                }else {
                    return back()->with('error','Item created failed!');
                }
            }else{
                return back()->with('error','File cannot uploaded!');
            }
        }

    }

    public function uploadFile($file)
    {
        $extension = $file->extension();
        $imageName = date('dmyHis'). '.' .$extension;
        $path      = Storage::disk('logo')->putFileAs('/', $file, $imageName);

        if($path == TRUE) {
            return $imageName;
        }else {
            return false;
        }
    }

    public function deleteFile($file)
    {
        $exists = Storage::disk('logo')->exists('/', $file);

        if ($exists == TRUE) {
            $path = Storage::disk('logo')->delete('/', $file);
            if($path == TRUE) {
                return true;
            }else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function show(Request $request)
    {
        $company = $this->companyRepo->findById($request->company_id);
        if ( $company != false ) {
            return $company;
        }else {
            return false;
        }
    }

    public function update(CompanyRequest $request)
    {
        $findCompany = $this->companyRepo->findById($request->companyId);

        if($findCompany != null ) {
            if ($request->hasFile('logo') ) {
                $deleteFile = $this->deleteFile($findCompany->logo);

                $uploadFile = $this->uploadFile($request->file('logo'));
            }else{
                $uploadFile = '';
            }

            $updateCompany = $this->companyRepo->updateCompany($request, $uploadFile);

            if ( $updateCompany != false ) {
                return back()->with('success','Company updated successfully!');
            }else {
                return back()->with('error','Company updated error!');
            }
        }else {
            return back()->with('error','Company Not Found!');
        }


    }

    public function destroy($id)
    {
        $findCompany = $this->companyRepo->findById($id);
        if ($findCompany != null ) {
            $this->deleteFile($findCompany->logo);
            $deleteCompany = $this->companyRepo->deleteCompany($id);
            if ( $deleteCompany != false ) {
                return back()->with('success','Company deleted successfully!');
            }else {
                return back()->with('error','Company deleted error!');
            }
        }else {
            return back()->with('error','Company Not Found!');
        }
    }

    public function getAllIdName()
    {
        $getCompany = $this->companyRepo->getAllIdName();
        if($getCompany != null) {
            return $getCompany;
        }else {
            return false;
        }
    }

}
