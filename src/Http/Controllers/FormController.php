<?php

namespace VarenykyForm\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Varenyky\Http\Controllers\BaseController;
use VarenykyForm\Models\Form;
use VarenykyForm\Repositories\FormRepository;
use VarenykyForm\Repositories\FormFieldRepository;

class FormController extends BaseController
{
    public function __construct(FormRepository $repository, FormFieldRepository $formFieldRepository)
    {
        $this->repository = $repository;
        $this->formFieldRepository = $formFieldRepository;
    }

    public function index(): View
    {
        $forms = $this->repository->getAll();
        return view('VarenykyForm::forms.index', compact('forms'));
    }

    public function show(Form $form): View
    {
        return view('VarenykyForm::forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($form->id, $update);

        return redirect()->route('admin.forms.edit', $form->id)->with('success', __('varenyky::labels.updated'));
    }

    public function destroy(Form $form): RedirectResponse
    {
        
        $form->delete();

        return redirect()->route('admin.forms.index')->with('error', __('varenyky::labels.deleted'));
    }
}
