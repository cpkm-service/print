@extends('backend.layouts.main')
@section('content')
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">{{ __('list') }}</h3>
    </div>
    <div class="block-content block-content-full">
        <table class="table table-bordered table-striped table-vcenter js-dataTable-responsive" id="data-table">
            <thead></thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    var url = "{{route('backend.print.template.index',[],false)}}";
    var search = makeDataTable(
        "#data-table",
        url,
        "GET",
        function(d) {
            let temp = {};
            $('form[name="search"]').serialize().split('&').map((item) => {
                let data = item.split('=');
                if(data[1]) {
                    temp[data[0]] = data[1];
                }
            });
            d.extraParam = temp;
        },
        [
            {
                data: "id",
                className: "text-md-center",
                title: "#",
                render: (data, type, full, meta) => {
                    return meta.row + 1 + meta.settings._iDisplayStart;
                },
                searchable:false,
            },
            {
                data: "name",
                className: "text-md-center fw-semibold",
                title: "{{__('print::backend.print_templates.name')}}"
            },
            {
                data: "code",
                className: "text-md-center fw-semibold",
                title: "{{__('print::backend.print_templates.code')}}"
            },
            {
                data: "id",
                className: "text-md-center",
                title: '{{ __('option') }}',
                orderable:false,
                searchable:false,
                render: (data,type,row,meta) => {
                    return `<a class="read btn btn-sm btn-primary" href="${url}/${ data }">{{ __('read') }}</a>
                            <a class="edit btn btn-sm btn-warning ms-2" href="${url}/${ data }/edit">{{ __('edit') }}</a>`;
                }
            },
        ],
        function(){
        },
        {
            ordering:false,
            order:[[0,'asc']]
        }
    );
    $('form[name="search"]').submit(function(){
        Codebase.block('state_toggle','.block-rounded');
        search.ajax.reload(function(){
            Codebase.block('state_toggle','.block-rounded');
        });
        return false;
    })

    $(document).on('click','.delete',function(){
        let id = $(this).data('id');
        var deleteId = $(this).data('id');
        Swal.fire({
            title:'{{__('admin::Admin.common.confirmDelete')}}',
            icon:'warning',
            showCancelButton: true, 
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{__('admin::Admin.common.confirm')}}',
            cancelButtonText: '{{__('admin::Admin.common.cancel')}}',
        }).then(function(result){
            if(result.isConfirmed) {
                Codebase.block('state_toggle','.block-rounded');
                sendApi(`${url}/${deleteId}`,"DELETE",{}).then(function(){
                    search.ajax.reload(function(){
                        Codebase.block('state_toggle','.block-rounded');
                    });
                });
            }
        })
    });
</script>
@endpush