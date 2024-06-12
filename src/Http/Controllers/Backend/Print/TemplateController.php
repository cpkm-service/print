<?php

namespace Cpkm\Print\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TemplateController extends Controller
{
    protected $form = [
        
    ];

    protected $TemplateService;

    public function __construct() {
        $this->TemplateService = app(config('print.template.service'));
        $this->form = config('print.template');
        $this->fields = config('print.template.fields');
        $this->form['back'] =   route('backend.print.template.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->expectsJson()) {
            return response()->json([
                "data"  =>  $this->TemplateService->index(request()->extraParam??[]),
            ]);
        }
        return view('backend.print.template.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['detail'] = $this->TemplateService->getPrintTemplate($id);
        $this->form['title']    =   '編輯模板';
        $this->form['action']   =   route('backend.print.template.update',['template'=>$id]);
        $this->form['method']   =   "PUT";
        foreach($data['detail']->toArray() as $field => $detail) {
            if(isset($this->fields[$field])) {
                $this->fields[$field]['value']  =   $detail;
            }
        }
        $data['form']   =   $this->form;
        \View::share('fields',$this->fields);
        return view('backend.print.template.form',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->TemplateService->update($request->all(),$id);
        return redirect()->route('backend.print.template.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
