<?php

namespace App\Http\Controllers\Admin;

use App\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqCategoriesRequest;
use App\Http\Requests\Admin\UpdateFaqCategoriesRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class FaqCategoriesController extends Controller
{
    /**
     * Display a listing of FaqCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('faq_category_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = FaqCategory::query();
            $template = 'actionsTemplate';
            
            $query->select([
                'faq_categories.id',
                'faq_categories.title',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'faq_category_';
                $routeKey = 'admin.faq_categories';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        $generals = \App\General::get();

        return view('admin.faq_categories.index', compact('generals'));
    }

    /**
     * Show the form for creating new FaqCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('faq_category_create')) {
            return abort(401);
        }

        $generals = \App\General::get();

        return view('admin.faq_categories.create', compact('generals'));
    }

    /**
     * Store a newly created FaqCategory in storage.
     *
     * @param  \App\Http\Requests\StoreFaqCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqCategoriesRequest $request)
    {
        if (! Gate::allows('faq_category_create')) {
            return abort(401);
        }
        $faq_category = FaqCategory::create($request->all());



        return redirect()->route('admin.faq_categories.index');
    }


    /**
     * Show the form for editing FaqCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('faq_category_edit')) {
            return abort(401);
        }
        $faq_category = FaqCategory::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.faq_categories.edit', compact('faq_category', 'generals'));
    }

    /**
     * Update FaqCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateFaqCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqCategoriesRequest $request, $id)
    {
        if (! Gate::allows('faq_category_edit')) {
            return abort(401);
        }
        $faq_category = FaqCategory::findOrFail($id);
        $faq_category->update($request->all());



        return redirect()->route('admin.faq_categories.index');
    }


    /**
     * Display FaqCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('faq_category_view')) {
            return abort(401);
        }
        $faq_questions = \App\FaqQuestion::where('category_id', $id)->get();

        $faq_category = FaqCategory::findOrFail($id);

        $generals = \App\General::get();

        return view('admin.faq_categories.show', compact('faq_category', 'faq_questions', 'generals'));
    }


    /**
     * Remove FaqCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('faq_category_delete')) {
            return abort(401);
        }
        $faq_category = FaqCategory::findOrFail($id);
        $faq_category->delete();

        return redirect()->route('admin.faq_categories.index');
    }

    /**
     * Delete all selected FaqCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('faq_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = FaqCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
