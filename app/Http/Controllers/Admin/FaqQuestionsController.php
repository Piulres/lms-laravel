<?php

namespace App\Http\Controllers\Admin;

use App\FaqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqQuestionsRequest;
use App\Http\Requests\Admin\UpdateFaqQuestionsRequest;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class FaqQuestionsController extends Controller
{
    /**
     * Display a listing of FaqQuestion.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('faq_question_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = FaqQuestion::query();
            $query->with("category");
            $template = 'actionsTemplate';
            
            $query->select([
                'faq_questions.id',
                'faq_questions.category_id',
                'faq_questions.question_text',
                'faq_questions.answer_text',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'faq_question_';
                $routeKey = 'admin.faq_questions';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('category.title', function ($row) {
                return $row->category ? $row->category->title : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.faq_questions.index');
    }

    /**
     * Show the form for creating new FaqQuestion.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('faq_question_create')) {
            return abort(401);
        }
        
        $categories = \App\FaqCategory::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.faq_questions.create', compact('categories'));
    }

    /**
     * Store a newly created FaqQuestion in storage.
     *
     * @param  \App\Http\Requests\StoreFaqQuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqQuestionsRequest $request)
    {
        if (! Gate::allows('faq_question_create')) {
            return abort(401);
        }
        $faq_question = FaqQuestion::create($request->all());



        return redirect()->route('admin.faq_questions.index');
    }


    /**
     * Show the form for editing FaqQuestion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('faq_question_edit')) {
            return abort(401);
        }
        
        $categories = \App\FaqCategory::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');

        $faq_question = FaqQuestion::findOrFail($id);

        return view('admin.faq_questions.edit', compact('faq_question', 'categories'));
    }

    /**
     * Update FaqQuestion in storage.
     *
     * @param  \App\Http\Requests\UpdateFaqQuestionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFaqQuestionsRequest $request, $id)
    {
        if (! Gate::allows('faq_question_edit')) {
            return abort(401);
        }
        $faq_question = FaqQuestion::findOrFail($id);
        $faq_question->update($request->all());



        return redirect()->route('admin.faq_questions.index');
    }


    /**
     * Display FaqQuestion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('faq_question_view')) {
            return abort(401);
        }
        $faq_question = FaqQuestion::findOrFail($id);

        return view('admin.faq_questions.show', compact('faq_question'));
    }


    /**
     * Remove FaqQuestion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('faq_question_delete')) {
            return abort(401);
        }
        $faq_question = FaqQuestion::findOrFail($id);
        $faq_question->delete();

        return redirect()->route('admin.faq_questions.index');
    }

    /**
     * Delete all selected FaqQuestion at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('faq_question_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = FaqQuestion::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
