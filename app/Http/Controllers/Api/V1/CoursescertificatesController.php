<?php

namespace App\Http\Controllers\Api\V1;

use App\Coursescertificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCoursescertificatesRequest;
use App\Http\Requests\Admin\UpdateCoursescertificatesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CoursescertificatesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Coursescertificate::all();
    }

    public function show($id)
    {
        return Coursescertificate::findOrFail($id);
    }

    public function update(UpdateCoursescertificatesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $coursescertificate = Coursescertificate::findOrFail($id);
        $coursescertificate->update($request->all());
        

        return $coursescertificate;
    }

    public function store(StoreCoursescertificatesRequest $request)
    {
        $request = $this->saveFiles($request);
        $coursescertificate = Coursescertificate::create($request->all());
        

        return $coursescertificate;
    }

    public function destroy($id)
    {
        $coursescertificate = Coursescertificate::findOrFail($id);
        $coursescertificate->delete();
        return '';
    }
}
