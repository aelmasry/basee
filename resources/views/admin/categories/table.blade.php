@push('css_lib')
    @include('admin.layouts.datatables_css')
@endpush

{!! $dataTable->table(['width' => '100%']) !!}

@push('scripts_lib')
    @include('admin.layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endpush
