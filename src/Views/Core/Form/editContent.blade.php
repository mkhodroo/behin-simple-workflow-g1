@extends('behin-layouts.app')

@section('title', $form->name)

@php
    $index = 0;
    $rawContent = json_decode($form->content);
    $rawContent = is_array($rawContent) ? $rawContent : [];
    $content = collect($rawContent)->sortBy('order')->toArray();
@endphp

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.13.1/ace.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/mode-php.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.23.0/theme-monokai.js"></script>
    <style>
        .edit-content-rtl { direction: rtl; text-align: right; font-family: Tahoma, 'IranSans', 'Vazirmatn', 'Segoe UI', Arial, sans-serif; }
        .edit-content-rtl table { text-align: right; }
        .edit-content-rtl th, .edit-content-rtl td { text-align: right; vertical-align: middle; }
        .edit-content-rtl .text-center { text-align: center !important; }
        .edit-content-rtl .field-key { direction: ltr; unicode-bidi: isolate; text-align: left; display: inline-block; font-family: Consolas, 'Courier New', monospace; }
        .edit-content-rtl .form-control { text-align: right; }
    </style>
    <div class="container edit-content-rtl">
        <div class="card shadow-sm p-3 mb-3">
            <div class="d-flex justify-content-between">
                <a href="{{ route('simpleWorkflow.form.index') }}" class="btn btn-outline-primary">
                    <i class="fa fa-arrow-left mr-2"></i> {{ trans('Back To Forms') }}
                </a>
                <a href="{{ route('simpleWorkflow.form.edit', ['id' => $form->id]) }}" class="btn btn-primary">
                    <i class="fa fa-edit mr-2"></i> {{ trans('Edit Content') }}
                </a>
                <a href="{{ route('simpleWorkflow.form.editScript', ['id' => $form->id]) }}" class="btn btn-primary">
                    <i class="fa fa-edit mr-2"></i> {{ trans('Edit Script') }}
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                {{ trans('Form Content') }} — {{ $form->name }}
            </div>
            <div class="card-body">
                <form action="{{ route('simpleWorkflow.form.updateContent') }}" method="POST" class="m-1">
                    @csrf
                    <input type="hidden" name="formId" value="{{ $form->id }}">

                    <div class="form-group row mb-3">
                        <label for="form-name" class="col-sm-2 col-form-label">{{ trans('Form Name') }}:</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $form->name }}" class="form-control" id="form-name">
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive mb-3">
                        <table class="table table-bordered table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:5%;">#</th>
                                    <th style="text-align:right;">{{ trans('Field Label') }}</th>
                                    <th>{{ trans('Field Name') }}</th>
                                    <th>{{ trans('Type') }}</th>
                                    <th style="width:10%;">{{ trans('Order') }}</th>
                                    <th style="width:10%;">{{ trans('Required') }}</th>
                                    <th style="width:12%;">{{ trans('Read Only') }}</th>
                                    <th>{{ trans('Class') }}</th>
                                    <th style="width:8%;" class="text-center">{{ trans('Note') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($content as $field)
                                    @php
                                        $fieldDetails = getFieldDetailsByName($field->fieldName);
                                        $transKey = 'SimpleWorkflowLang::fields.' . $field->fieldName;
                                        $translated = trans($transKey);
                                        $fieldLabel = ($translated === $transKey) ? $field->fieldName : $translated;
                                        $fieldType = $fieldDetails ? $fieldDetails->type : 'sub-form';
                                        $isRequired = isset($field->required) && $field->required == 'on';
                                        $isReadOnly = isset($field->readOnly) && $field->readOnly == 'on';
                                        $fieldClass = $field->class ?? '';
                                        $note = '';
                                        if (!$fieldDetails) {
                                            $note = trans('Sub-form reference');
                                        } elseif ($fieldDetails->type == 'title') {
                                            $note = trans('Title');
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="text-align:right;">{{ $fieldLabel }}</td>
                                        <td><span class="field-key">{{ $field->fieldName }}</span></td>
                                        <td><span class="badge badge-info">{{ $fieldType }}</span></td>
                                        <td>{{ $field->order ?? ($loop->iteration) }}</td>
                                        <td class="text-center"><span class="badge {{ $isRequired ? 'badge-success' : 'badge-secondary' }}">{{ $isRequired ? trans('Yes') : trans('No') }}</span></td>
                                        <td class="text-center"><span class="badge {{ $isReadOnly ? 'badge-warning' : 'badge-secondary' }}">{{ $isReadOnly ? trans('Yes') : trans('No') }}</span></td>
                                        <td>{{ $fieldClass }}</td>
                                        <td class="text-center"><span class="badge badge-{{ $note ? 'danger' : 'secondary' }}">{{ $note ?: trans('None') }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" class="text-center">{{ trans('No fields added yet') }}</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="alert alert-info mt-3 mb-3">
                        {{ trans('Hint') }}: {{ trans('Persian field labels are loaded from language files. Order, required, read-only and class are managed from the form builder.') }}
                    </div>

                    <hr>

                    <div class="card mt-3">
                        <div class="card-header">
                            <button type="button" class="btn btn-link btn-sm p-0" data-toggle="collapse" data-target="#rawJsonEditor" aria-expanded="false" aria-controls="rawJsonEditor">
                                {{ trans('Edit Raw Content (JSON)') }}
                            </button>
                        </div>
                        <div class="collapse" id="rawJsonEditor">
                            <div class="card-body p-2">
                                <label>{{ trans('Form Content') }}:</label>
                                <div dir="ltr" id="form-content" style="height: 400px; width: 100%;">{{ old('content', $form->content) }}</div>
                                <textarea name="content" class="form-control d-none" dir="ltr" id="content" cols="30" rows="30">{{ old('content', $form->content) }}</textarea>
                                <button type="submit" class="btn btn-primary mt-2">{{ trans('Update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-12 mt-3">
            @include('SimpleWorkflowView::Core.Form.preview', ['form' => $form])
        </div>

    </div>
@endsection

@section('script')
    <script>
        initial_view();

        function deleteField(index) {
            $('#tr_' + index).remove();
        }

        const formContentEditor = ace.edit("form-content");
        formContentEditor.setTheme("ace/theme/monokai");
        formContentEditor.session.setMode("ace/mode/javascript");
        formContentEditor.setOption("wrap", true);
        formContentEditor.setOption("font-size", '16px');
        formContentEditor.session.on('change', function() {
            $('#content').val(formContentEditor.getValue());
        });
    </script>
    <script>
        const editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/javascript");
        editor.getSession().setUseWorker(false);
        editor.setOption("wrap", true);
        editor.session.on('change', function() {
            $('#scripts').val(editor.getValue());
        });
    </script>
@endsection
