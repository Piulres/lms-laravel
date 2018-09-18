<?php

namespace App\Http\Controllers\Api\V1;

use App\Trailscertificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailscertificatesRequest;
use App\Http\Requests\Admin\UpdateTrailscertificatesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailscertificatesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Trailscertificate::all();
    }

    public function show($id)
    {
        return Trailscertificate::findOrFail($id);
    }

    public function update(UpdateTrailscertificatesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $trailscertificate = Trailscertificate::findOrFail($id);
        $trailscertificate->update($request->all());
        

        return $trailscertificate;
    }

    public function store(StoreTrailscertificatesRequest $request)
    {
        $request = $this->saveFiles($request);
        $trailscertificate = Trailscertificate::create($request->all());
        

        return $trailscertificate;
    }

    public function destroy($id)
    {
        $trailscertificate = Trailscertificate::findOrFail($id);
        $trailscertificate->delete();
        return '';
    }
}
