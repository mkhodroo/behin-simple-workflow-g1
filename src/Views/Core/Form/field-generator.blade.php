@php
    $fieldLabel = trans('SimpleWorkflowLang::fields.' . $fieldName);
    $fieldDetails = getFieldDetailsByName($fieldName);
    if ($fieldDetails) {
        $fieldAttributes = json_decode($fieldDetails->attributes);
    }
    $fieldType = isset($fieldDetails->type) ? $fieldDetails->type : null;
    $fieldStyle = isset($fieldAttributes->style) ? $fieldAttributes->style : null;
    $fieldScript = isset($fieldAttributes->script) ? $fieldAttributes->script : null;
    $fieldPlaceholder = isset($fieldAttributes->placeholder) ? $fieldAttributes->placeholder : null;
    $fieldOptions = isset($fieldAttributes->options) ? $fieldAttributes->options : null;
    $fieldQuery = isset($fieldAttributes->query) ? $fieldAttributes->query : null;
    $fieldDatalist = isset($fieldAttributes->datalist_from_database) ? $fieldAttributes->datalist_from_database : null;
    $fieldClass = isset($fieldAttributes->class) ? $fieldAttributes->class : 'form-control';
@endphp
@if ($fieldDetails->type == 'title')
    {!! Form::title($fieldId, [
        'value' => $fieldValue,
        'class' => '',
        'id' => $fieldId,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'hidden')
    {!! Form::hidden($fieldId, [
        'value' => $fieldValue,
        'class' => '',
        'id' => $fieldId,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'help')
    {!! Form::help($fieldId, [
        'options' => isset($fieldAttributes?->options) ? $fieldAttributes?->options : null,
        'class' => '',
        'id' => $fieldDetails->id ?? $fieldId,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'location')
    @php
        $defaultLat = isset($variables) ? $variables->where('key', $field->fieldName . '_lat')->first()?->value : null;
        $defaultLng = isset($variables) ? $variables->where('key', $field->fieldName . '_lng')->first()?->value : null;
    @endphp
    {!! Form::location($fieldId, [
        'value' => $fieldValue,
        'class' => '',
        'id' => $fieldId,
        'required' => $required,
        'readonly' => $readOnly,
        'defaultZoom' => 13,
        'defaultLat' => $defaultLat,
        'defaultLng' => $defaultLng,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'string')
    {!! Form::text($fieldId, [
        'value' => $fieldValue,
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
        'datalist_from_database' => isset($fieldAttributes?->datalist_from_database)
            ? $fieldAttributes?->datalist_from_database
            : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'checkbox')
    {!! Form::checkbox($fieldId, [
        'value' => $fieldValue,
        'class' => '',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'text')
    {!! Form::textarea($fieldId, [
        'value' => $fieldValue,
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'date')
    {!! Form::date($fieldName, [
        'id' => $fieldId,
        'value' => $fieldValue,
        'altValue' => $fieldValueAlt ?? '',
        'class' => 'form-control',
        'id' => $fieldId,
        'showLabel' => isset($showLabel) ? $showLabel : true,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'time')
    {!! Form::time($fieldId, [
        'value' => $fieldValue,
        'class' => 'form-control timepicker',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'datetime')
    {!! Form::datetime($fieldId, [
        'value' => $fieldValue,
        'valueAlt' => $fieldValueAlt ?? '',
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'select')
    {!! Form::select($fieldId, is_string($fieldAttributes?->options) ? $fieldAttributes?->options : null, [
        'value' => $fieldValue,
        'query' => is_string($fieldAttributes?->query) ? $fieldAttributes?->query : null,
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'select-simple')
    {!! Form::selectSimple($fieldId, is_string($fieldAttributes?->options) ? $fieldAttributes?->options : null, [
        'value' => $fieldValue,
        'query' => is_string($fieldAttributes?->query) ? $fieldAttributes?->query : null,
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'select-multiple')
    {!! Form::selectMultiple($fieldId, is_string($fieldAttributes?->options) ? $fieldAttributes?->options : null, [
        'value' => json_decode($fieldValue),
        'query' => is_string($fieldAttributes?->query) ? $fieldAttributes?->query : null,
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type === 'searchable-input')
    {!! Form::searchableInput($fieldId, [
        'value' => $fieldValue,
        'endpoint' => isset($fieldAttributes->endpoint) && is_string($fieldAttributes->endpoint)
            ? $fieldAttributes->endpoint
            : null,
        'minChars' => isset($fieldAttributes->minChars) ? $fieldAttributes->minChars : null,
        'limit' => isset($fieldAttributes->limit) ? $fieldAttributes->limit : null,
        'initial_label' => $fieldAttributes->initial_label ?? ($fieldAttributes->initialLabel ?? null),
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldPlaceholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => $fieldStyle,
        'script' => $fieldScript,
    ]) !!}
@endif
@if ($fieldDetails->type == 'file')
    {{-- @php
        $fieldValues = isset($variables) ? $variables->where('key', $field->fieldName)->pluck('value') : [];
    @endphp --}}
    {!! Form::file($fieldId, [
        'value' => $fieldValue ?? [],
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif

@if ($fieldDetails->type == 'file-uploader')
    <link href="{{ asset('vendor/form-builder/css/file-uploader-field.css') }}" rel="stylesheet">
    <div class="file-uploader-field" id="{{ $fieldId }}_wrapper" style="{{ isset($fieldAttributes?->style) ? $fieldAttributes?->style : null }}">
        @if (!empty($fieldValue))
            <input type="hidden" name="{{ $fieldId }}" value="{{ $fieldValue }}">
            <div class="file-uploader-existing mb-2">
                <span class="file-uploader-name">{{ $fieldValue }}</span>
                @if (!$readOnly)
                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeFileUploader('{{ $fieldId }}')">حذف فایل</button>
                @endif
            </div>
        @else
            <input type="hidden" name="{{ $fieldId }}" value="">
        @endif

        @if (!$readOnly)
            <div class="file-uploader-input-area mb-2">
                <input type="file" id="{{ $fieldId }}_input" accept="{{ isset($fieldAttributes->accepted_files) ? $fieldAttributes->accepted_files : '*' }}" class="form-control {{ $required ? 'is-required' : '' }}" {{ $required ? 'required' : '' }}>
                <button type="button" class="btn btn-primary ms-2 mt-2" onclick="startFileUpload('{{ $fieldId }}')">بارگذاری فایل</button>
            </div>
        @endif

        <div id="{{ $fieldId }}_progress" class="progress" style="display:none; height: 6px; margin-top: 8px;">
            <div id="{{ $fieldId }}_bar" class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
        </div>
        <div id="{{ $fieldId }}_msg" class="mt-2"></div>
    </div>

    <script>
    function startFileUpload(fieldId) {
        var input = document.getElementById(fieldId + '_input');
        var progress = document.getElementById(fieldId + '_progress');
        var bar = document.getElementById(fieldId + '_bar');
        var msg = document.getElementById(fieldId + '_msg');

        if (!input || !input.files.length) {
            msg.innerHTML = '<span class="text-danger">لطفاً فایلی انتخاب کنید.</span>';
            return;
        }

        var formData = new FormData();
        formData.append('file', input.files[0]);

        progress.style.display = 'block';
        bar.style.width = '0%';
        msg.innerHTML = '';

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '{{ route('simpleWorkflow.file-uploader.upload') }}', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                var pct = Math.round((e.loaded / e.total) * 100);
                bar.style.width = pct + '%';
            }
        };

        xhr.onload = function() {
            progress.style.display = 'none';
            if (xhr.status === 200) {
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.url) {
                        var hidden = document.querySelector('input[name="' + fieldId + '"]');
                        if (hidden) hidden.value = res.url;
                        var wrapper = document.getElementById(fieldId + '_wrapper');
                        var existing = wrapper.querySelector('.file-uploader-existing');
                        if (existing) existing.remove();
                        var html = '<div class="file-uploader-existing mb-2">' +
                            '<span class="file-uploader-name">' + res.url + '</span>' +
                            '<button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="removeFileUploader(\'' + fieldId + '\')">حذف فایل</button>' +
                            '</div>';
                        wrapper.insertAdjacentHTML('afterbegin', html);
                        input.style.display = 'none';
                        msg.innerHTML = '<span class="text-success">فایل با موفقیت بارگذاری شد.</span>';
                    } else {
                        msg.innerHTML = '<span class="text-danger">خطا در بارگذاری فایل.</span>';
                    }
                } catch (e) {
                    msg.innerHTML = '<span class="text-danger">پاسخ نامعتبر از سرور.</span>';
                }
            } else {
                msg.innerHTML = '<span class="text-danger">خطا در بارگذاری فایل (کد ' + xhr.status + ').</span>';
            }
        };

        xhr.onerror = function() {
            progress.style.display = 'none';
            msg.innerHTML = '<span class="text-danger">خطا در برقراری اتصال با سرور.</span>';
        };

        xhr.send(formData);
    }

    function removeFileUploader(fieldId) {
        var hidden = document.querySelector('input[name="' + fieldId + '"]');
        if (hidden) hidden.value = '';
        var existing = document.querySelector('#' + fieldId + '_wrapper .file-uploader-existing');
        if (existing) existing.remove();
        var input = document.getElementById(fieldId + '_input');
        if (input) {
            input.style.display = 'block';
            input.value = '';
        }
        var msg = document.getElementById(fieldId + '_msg');
        if (msg) msg.innerHTML = '';
    }
    </script>
@endif
@if ($fieldDetails->type == 'signature')
    {!! Form::signature($fieldId, [
        'value' => $fieldValue,
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
        'datalist_from_database' => isset($fieldAttributes?->datalist_from_database)
            ? $fieldAttributes?->datalist_from_database
            : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'entity')
    {!! Form::entity($fieldId, [
        'columns' => is_string($fieldAttributes?->columns) ? $fieldAttributes?->columns : null,
        'query' => is_string($fieldAttributes?->query) ? $fieldAttributes?->query : null,
        'class' => 'form-control',
        'id' => $fieldAttributes?->id,
        'required' => $required,
        'readonly' => $readOnly,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'button')
    {!! Form::button($fieldName, [
        'class' => $fieldClass,
        'id' => $fieldAttributes?->id ?? $fieldName,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif
@if ($fieldDetails->type == 'view-model')
    {!! Form::viewModel($fieldId, [
        'class' => $fieldClass,
        'id' => $fieldId,
        'view_model_id' => $fieldAttributes?->view_model_id,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
    ]) !!}
@endif

@if ($fieldDetails->type == 'formatted-digit')
    {!! Form::formattedDigit($fieldId, [
        'value' => $fieldValue,
        'class' => 'form-control',
        'id' => $fieldId,
        'placeholder' => $fieldAttributes?->placeholder,
        'required' => $required,
        'readonly' => $readOnly,
        'showLabel' => isset($showLabel) ? $showLabel : false,
        'style' => isset($fieldAttributes?->style) ? $fieldAttributes?->style : null,
        'script' => isset($fieldAttributes?->script) ? $fieldAttributes?->script : null,
        'datalist_from_database' => isset($fieldAttributes?->datalist_from_database)
            ? $fieldAttributes?->datalist_from_database
            : null,
    ]) !!}
@endif
