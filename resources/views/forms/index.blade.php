@extends('varenykyAdmin::app')

@section('title', __('VarenykyForm::admin.forms.index.title'))

@section('content_header')
    <strong>{{ __('VarenykyForm::admin.forms.index.title') }}</strong>
@stop

@section('create-btn', route('admin.forms.create'))

@section('content')
    <div class="card border p-3">
        <table class="table">
            <thead>
                <tr class="">
                    <th>{{ __('VarenykyForm::labels.name') }}</th>
                    <th>{{ __('VarenykyForm::labels.slug') }}</th>
                    {{-- <th>{{ __('VarenykyForm::labels.category') }}</th>
                    <th>{{ __('VarenykyForm::labels.user') }}</th>
                    <th>{{ __('VarenykyForm::labels.content') }}</th> --}}
                    <th width="350"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($forms as $form)
                    <tr>
                        <td>{{ $form->name }}</td>
                        <td>{{ $form->slug }}</td>
                        {{-- <td>{{ $form->categories->name }}</td>
                        <td>{{ $form->user->name }}</td>
                        <td>{{ implode(' ', array_slice(explode(' ', $form->content), 0, 3)) }}{{ str_word_count($form->content) > 3 ? '...' : '' }}</td> --}}
                        <td align="right">
                            @include('varenykyAdmin::actions', ['route' => 'admin.forms', 'entity' => $form])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">{{ __('varenyky::labels.empty') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
