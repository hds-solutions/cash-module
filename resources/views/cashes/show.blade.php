@extends('backend::layouts.master')

@section('page-name', __('cash::cashes.title'))
@section('description', __('cash::cashes.description'))

@section('content')

<div class="card mb-3">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <i class="fas fa-user-plus"></i>
                @lang('cash::cashes.show')
            </div>
            <div class="col-6 d-flex justify-content-end">
                @if (!$resource->isCompleted())
                <a href="{{ route('backend.cashes.edit', $resource) }}"
                    class="btn btn-sm ml-2 btn-info">@lang('cash::cashes.edit')</a>
                @endif
                <a href="{{ route('backend.cashes.create') }}"
                    class="btn btn-sm ml-2 btn-primary">@lang('cash::cashes.add')</a>
            </div>
        </div>
    </div>
    <div class="card-body">

        @include('backend::components.errors')

        <div class="row">
            <div class="col">
                <h2>@lang('cash::cash.details.0')</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash.cash_book_id.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ $resource->cashBook->name }}</div>
                </div>

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash.currency_id.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ $resource->cashBook->currency->name }}</div>
                </div>

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash.start_balance.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ amount($resource->start_balance, $resource->cashBook->currency) }}</div>
                </div>

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash.end_balance.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ amount($resource->end_balance, $resource->cashBook->currency) }}</div>
                </div>

                <div class="row">
                    <div class="col-4 col-lg-4">@lang('cash::cash.document_status.0'):</div>
                    <div class="col-8 col-lg-6 h4">{{ Document::__($resource->document_status) }}</div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <h2>@lang('cash::cash.lines.0')</h2>
            </div>
        </div>

        <div class="row">
            <div class="col">

                <div class="table-responsive">
                    <table class="table table-sm table-striped table-borderless table-hover" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>@lang('cash::cash.lines.created_at.0')</th>
                                <th>@lang('cash::cash.lines.cash_type_id.0')</th>
                                <th>@lang('cash::cash.lines.description.0')</th>
                                <th>@lang('cash::cash.lines.amount.0')</th>
                                <th>@lang('cash::cash.lines.new_amount.0')</th>
                                <th>@lang('cash::cash.end_balance.0')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $end_balance = $resource->start_balance; @endphp
                            @foreach ($resource->lines as $line)
                                <tr>
                                    <td class="align-middle pl-3">{{ pretty_date($line->created_at, true) }}</td>
                                    <td class="align-middle pl-3">{{ $line->cash_type }}</td>
                                    <td class="align-middle pl-3">{{ $line->description }}</td>
                                    <td class="align-middle pl-3">{{ amount($line->amount, $line->currency) }}</td>
                                    <td class="align-middle pl-3">{{ amount($line->net_amount, $resource->cashBook->currency) }}</td>
                                    <td class="align-middle pl-3">{{ amount($end_balance += $line->net_amount, $resource->cashBook->currency) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        @include('backend::components.document-actions', [
            'route'     => 'backend.cashes.process',
            'resource'  => $resource,
        ])

    </div>
</div>

@endsection
