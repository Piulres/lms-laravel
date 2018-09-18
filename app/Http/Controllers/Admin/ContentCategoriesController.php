<?php

namespace App\Http\Controllers\Admin;

use App\ContentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContentCategoriesRequest;
use App\Http\Requests\Admin\UpdateContentCategoriesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ContentCategoriesController extends Controller
{
    /**
     * Display a listing of ContentCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('content_category_access')) {
            return abort(401);
        }


                $content_categories = ContentCategory::all();

        return view('admin.content_categories.index', compact('content_categories'));
    }

    /**
     * Show the form for creating new ContentCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('content_category_create')) {
            return abort(401);
        }
        return view('admin.content_categories.create');
    }

    /**
     * Store a newly created ContentCategory in storage.
     *
     * @param  \App\Http\Requests\StoreContentCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentCategoriesRequest $request)
    {
        if (! Gate::allows('content_category_create')) {
            return abort(401);
        }
        $content_category = ContentCategory::create($request->all());



        return redirect()->route('admin.content_categories.index');
    }


    /**
     * Show the form for editing ContentCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('content_category_edit')) {
            return abort(401);
        }
        $content_category = ContentCategory::findOrFail($id);

        return view('admin.content_categories.edit', compact('content_category'));
    }

    /**
     * Update ContentCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateContentCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContentCategoriesRequest $request, $id)
    {
        if (! Gate::allows('content_category_edit')) {
            return abort(401);
        }
        $content_category = ContentCategory::findOrFail($id);
        $content_category->update($request->all());



        return redirect()->route('admin.content_categories.index');
    }


    /**
     * Display ContentCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('content_category_view')) {
            return abort(401);
        }
        $content_pages = \App\ContentPage::whereHas('category_id',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $content_category = ContentCategory::findOrFail($id);

        return view('admin.content_categories.show', compact('content_category', 'content_pages'));
    }


    /**
     * Remove ContentCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('content_category_delete')) {
            return abort(401);
        }
        $content_category = ContentCategory::findOrFail($id);
        $content_category->delete();

        return redirect()->route('admin.content_categories.index');
    }

    /**
     * Delete all selected ContentCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('content_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ContentCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
