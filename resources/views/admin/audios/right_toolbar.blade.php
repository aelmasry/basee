<div class="ml-auto d-inline-flex">
    <li class="nav-item">
        <a class="nav-link pt-1" id="refreshDatatable" href="#"><i class="fa fa-refresh"></i> {{trans('lang.refresh')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link pt-1" id="resetDatatable" href="#"><i class="fa fa-undo"></i> {{trans('lang.reset')}}</a>
    </li>
    <li id="colVisDatatable" class="nav-item dropdown keepopen">
        <a class="nav-link dropdown-toggle pt-1" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-eye"></i> {{trans('lang.columns')}}
        </a>
        <div class="dropdown-menu">
            @foreach($dataTable->collection as $key => $item)
                <a class="dropdown-item text-bold" href="#" data-column="{{$key}}"> <i class="fa fa-check mr-2"></i>{{$item->title}}</a>
            @endforeach
        </div>
    </li>
</div>

@push('scripts_lib')

    <script type="text/javascript">
        /**
         * load media when select collection changed
         */
        var params = [];
        var objParams = {};

        /**
         * initialise objParams with existing parameters in the url
         * @type {string}
         */
        objParams = $.extend({}, params);
        objParams = $.param(objParams);

        $('#filter #selectFilter').on('select2:select', function (e) {
            $(e.params.data.element).parent('optgroup').children().each(function (element) {
                $(this)[0].selected = false;
            });
            $(e.params.data.element)[0].selected = true;

            $(this).trigger('change');
            params[$(e.params.data.element).data('key')] = $(e.params.data.element).attr('value');
            objParams = $.extend({}, params);
            objParams = $.param(objParams);
        });

        $('#filter #selectFilter').on('select2:unselect', function (e) {
            params[$(e.params.data.element).data('key')] = undefined;
            objParams = $.extend({}, params);
            objParams = $.param(objParams);
        });

        $('#filter #selectFilter').on("select2:closing", function (e) {
            window.location.href = window.location.href.split('?')[0] + "?" + objParams;
        });


</script>
@endpush
