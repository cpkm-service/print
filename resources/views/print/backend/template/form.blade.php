@extends('backend.layouts.main')
@section('options')
    @if(($show??false))
    <div class="row mb-2">
        <div class="col-12">
            <button class="btn @if($detail->status?->id == 1) btn-warning @elseif($detail->status?->id == 2) btn-primary @else btn-danger @endif" type="button" id="close" data-id="{{$detail->id}}">{{$detail->status->name}}</button>
            @if($detail->status?->id == 1 && !$detail->contract_order)
                <a href="{{route('backend.lease.contract_order.create', ['sourceable_type' => \App\Models\LeaseQuoteOrder::class, 'sourceable_id' => $detail->id])}}" class="btn btn-success">轉租賃合約</a>
            @else
                @if($detail->contract_order)
                <a href="{{route('backend.lease.contract_order.show', ['contract_order' => $detail->contract_order->id])}}" class="btn btn-info" target="_blank">租賃合約單</a>
                @endif
            @endif
        </div>
    </div>
    @endif
@endsection
@section('content')
<main id="main-container">
<!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{$form['title']}}</h3>
            </div>
            <div class="block-content pb-4">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" id="btabs-static-home-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-home" role="tab" aria-controls="btabs-static-home" aria-selected="false" tabindex="-1">
                            {{ __('basic_data') }}
                        </button>
                    </li>
                    @if($show??false)
                    <li class="nav-item audit-tab" role="presentation">
                        <button type="button" class="nav-link" id="btabs-static-profile-tab" data-bs-toggle="tab" data-bs-target="#btabs-static-profile" role="tab" aria-controls="btabs-static-profile" aria-selected="false" tabindex="-1">
                            {{ __('audit') }}
                        </button>
                    </li>
                    @endif
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-static-home" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                        <x-backend::form :form="$form" :fields="$fields" />
                    </div>
                    @if($show??false)
                    <div class="tab-pane " id="btabs-static-profile" role="tabpanel" aria-labelledby="btabs-alt-static-home-tab">
                        @include('backend.layouts.audits', [ 'table' => $table, 'table_id' => $detail->id ])
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
<!-- END Page Content -->
</main>
@endsection
@push('style')
<link rel="stylesheet" href="/css/order.css">
<style>
    #btabs-static-home th,#btabs-static-home td {
        white-space:nowrap;
    }
    .accordion {
        --bs-accordion-bg: #ffffff;
    }
</style>
@endpush
@push('javascript')
<script src="{{asset(Universal::version('js/rate.js'))}}"></script>
@endpush