{{-- regular object attribute --}}
@php
$value = data_get($entry, $column['name']);
$value = is_array($value) ? json_encode($value) : $value;

// $column['escaped'] = $column['escaped'] ?? true;
$column['limit'] = $column['limit'] ?? 40;
$column['prefix'] = $column['prefix'] ?? '';
$column['suffix'] = $column['suffix'] ?? '';
// $column['text'] = $column['prefix'].Str::limit($value, $column['limit'], '[...]').$column['suffix'];
$column['path'] = $column['path']($entry);
@endphp

<span>

    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start')
    <a href='#' data-toggle='modal' data-target='#asset-video'>
        {{$entry->title}}
    </a>
    @includeWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end')
</span>

@include('components.video',['path' => $column['path']])