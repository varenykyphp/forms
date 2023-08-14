@extends('varenykyAdmin::app')

@section('title', __('VarenykyForm::admin.forms.edit.title'))

@section('content_header')
    <strong>{{ __('VarenykyForm::admin.forms.edit.title') }}</strong>
@stop

@section('save-btn', route('admin.forms.update', $form))
@section('back-btn', route('admin.forms.index'))

@section('content')

        <form action="{{ route('admin.forms.update', $form) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')            
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card border p-3">
                        <div class="form-group mb-3">
                            <label for="name"
                                class="@if ($errors->has('name')) text-danger @endif">{{ __('VarenykyForm::labels.name') }}</label>
                            <input id="name" type="text" placeholder="{{ __('VarenykyForm::labels.name') }}..."
                                name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                                value="{{ old('name', $form->name) }}">
                        </div>
        
                        @foreach ($form->formFields as $field)
                            <div class="form-group mb-3">
                                <input type="hidden" name="field_id[]" value="{{ $field->id }}"> 
                                <label class="">{{ __('VarenykyForm::labels.field_name') }}</label>
                                <input type="text" name="field_name[]" class="form-control" value="{{ $field->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="">{{ __('VarenykyForm::labels.type') }}</label>
                                <select name="type[]" class="form-control">
                                    <option value="text" {{ $field->type === 'text' ? 'selected' : '' }}>Text</option>
                                    <option value="textarea" {{ $field->type === 'textarea' ? 'selected' : '' }}>Textarea</option>
                                    <option value="select" {{ $field->type === 'select' ? 'selected' : '' }}>Select</option>
                                    <option value="check" {{ $field->type === 'check' ? 'selected' : '' }}>Checkbox</option>
                                    <option value="recaptcha" {{ $field->type === 'recaptcha' ? 'selected' : '' }}>reCAPTCHA</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="">{{ __('VarenykyForm::labels.sort_order') }}</label>
                                <input type="number" name="sort_order[]" class="form-control" value="{{ $field->sort_order }}" min="0">
                            </div>
                            <hr>
                        @endforeach
        
                        <button type="button" id="addFieldButton" class="btn btn-primary">Add Field</button>
        
                        {{-- form_fields template --}}
                        <div id="fieldTemplate" class="mt-4" style="display: none;">
                            <div class="form-group mb-3">
                                <label for="new_field_name"
                                    class="@if ($errors->has('new_field_name')) text-danger @endif">{{ __('VarenykyForm::labels.field_name') }}</label>
                                <input type="text" placeholder="{{ __('VarenykyForm::labels.field_name') }}..."
                                    name="new_field_name[]" class="form-control @if ($errors->has('new_field_name')) is-invalid @endif">
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="new_type"
                                    class="@if ($errors->has('new_type')) text-danger @endif">{{ __('VarenykyForm::labels.type') }}</label>
                                <select name="new_type[]" class="form-control @if ($errors->has('new_type')) is-invalid @endif">
                                    <option value="text">Text</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="select">Select</option>
                                    <option value="check">Checkbox</option>
                                    <option value="recaptcha">reCAPTCHA</option>
                                </select>
                            </div>
                        
                            <div class="form-group mb-3">
                                <label for="new_sort_order"
                                    class="@if ($errors->has('new_sort_order')) text-danger @endif">{{ __('VarenykyForm::labels.sort_order') }}</label>
                                <input type="number" placeholder="{{ __('VarenykyForm::labels.sort_order') }}..."
                                    name="new_sort_order[]" class="form-control @if ($errors->has('new_sort_order')) is-invalid @endif" min="0">
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            
            <script>
                document.getElementById('addFieldButton').addEventListener('click', function () {
                    const template = document.getElementById('fieldTemplate');
                    const clonedTemplate = template.cloneNode(true);
                    clonedTemplate.style.display = 'block';
                    clonedTemplate.id = '';
                    document.querySelector('.card').appendChild(clonedTemplate);
                });
            </script>
            
            
        </form>
@endsection
