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

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('VarenykyForm::forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {   
        $create = $request->except(['_token']);
        $create['slug'] = Str::slug($create['name']);

        $form = $this->repository->create($create);
        $formId = $form->id;

        // Store form fields
        $newFieldNames = $request->input('new_field_name', []);
        $newTypes = $request->input('new_type', []);
        $newSortOrders = $request->input('new_sort_order', []);

        for ($i = 1; $i < count($newFieldNames); $i++) {
            $fieldData = [
                'form_id' => $formId,
                'name' => $newFieldNames[$i],
                'slug' => Str::slug($newFieldNames[$i]),
                'type' => $newTypes[$i],
                'sort_order' => $newSortOrders[$i]
            ];

            $this->formFieldRepository->create($fieldData);
        }

        return redirect()->route('admin.forms.index')->with('success', __('VarenykyForm::labels.added'));
    }

    public function show(Form $form): View
    {
        //
    }

    public function edit(Form $form): View
    {
        return view('VarenykyForm::forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form): RedirectResponse
    {   
        // $update = array_filter($request->except(['_token', '_method', 'field_id', 'field_name', 'type', 'sort_order', 'new_field_name', 'new_type', 'new_sort_order']));
        $update = array_filter($request->only(['name']));
        $update['slug'] = Str::slug($update['name']);

        $this->repository->update($form->id, $update);
        $formId = $form->id;

        // Update form fields
        $fieldIds = $request->input('field_id', []);
        $fieldNames = $request->input('field_name', []);
        $types = $request->input('type', []);
        $sortOrders = $request->input('sort_order', []);

        for ($i = 0; $i < count($fieldIds); $i++) {
            $fieldData = [
                'name' => $fieldNames[$i],
                'slug' => Str::slug($fieldNames[$i]),
                'type' => $types[$i],
                'sort_order' => $sortOrders[$i]
            ];
            $this->formFieldRepository->update($fieldIds[$i], $fieldData);
        }

        // Store new form fields
        $newFieldNames = $request->input('new_field_name', []);
        if (!empty(array_filter($newFieldNames))) {
            $newTypes = $request->input('new_type', []);
            $newSortOrders = $request->input('new_sort_order', []);
        
            foreach ($newFieldNames as $i => $fieldName) {
                if ($fieldName === null) {
                    continue;
                }
        
                $fieldData = [
                    'form_id' => $formId,
                    'name' => $fieldName,
                    'slug' => Str::slug($fieldName),
                    'type' => $newTypes[$i],
                    'sort_order' => $newSortOrders[$i]
                ];
        
                $this->formFieldRepository->create($fieldData);
            }
        }

        return redirect()->route('admin.forms.edit', $form->id)->with('success', __('varenyky::labels.updated'));
    }

    public function destroy(Form $form): RedirectResponse
    {
        
        $form->delete();

        return redirect()->route('admin.forms.index')->with('success', __('varenyky::labels.deleted'));
    }
}
