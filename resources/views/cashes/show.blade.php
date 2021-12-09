@extends('cash::layouts.master')

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
                @if ($resource->isOpen())
                <a href="{{ route('backend.cash_lines.create', [ 'cash' => $resource ]) }}"
                    class="btn btn-sm ml-2 btn-outline-success">@lang('cash::cash_lines.create')</a>
                <a href="{{ route('backend.cashes.edit', $resource) }}"
                    class="btn btn-sm ml-2 btn-outline-info">@lang('cash::cashes.edit')</a>
                @endif
                <a href="{{ route('backend.cashes.create') }}"
                    class="btn btn-sm ml-2 btn-outline-primary">@lang('cash::cashes.create')</a>
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
            <div class="col-12 col-xl-6">

                <div class="row">
                    <div class="col">@lang('cash::cash.cash_book_id.0'):</div>
                    <div class="col h4">{{ $resource->cashBook->name }}</div>
                </div>

                <div class="row">
                    <div class="col">@lang('cash::cash.currency_id.0'):</div>
                    <div class="col h4">{{ currency($resource->cashBook->currency_id)->name }}</div>
                </div>

                <div class="row">
                    <div class="col">@lang('cash::cash.start_balance.0'):</div>
                    <div class="col h4">{{ amount($resource->start_balance, currency($resource->cashBook->currency_id)) }}</div>
                </div>

                <div class="row">
                    <div class="col">@lang('cash::cash.end_balance.0'):</div>
                    <div class="col h4">{{ currency($resource->currency_id)->code }} <b>{{ number($resource->end_balance, currency($resource->cashBook->currency_id)->decimals) }}</b></div>
                </div>

                <div class="row">
                    <div class="col">@lang('cash::cash.document_status.0'):</div>
                    <div class="col h4">{{ Document::__($resource->document_status) }}</div>
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
                                <th>@lang('cash::cash.lines.transacted_at.0')</th>
                                <th>@lang('cash::cash.lines.cash_type.0')</th>
                                <th colspan="2">@lang('cash::cash.lines.description.0')</th>
                                {{-- <th>@lang('cash::cash.lines.referable.0')</th> --}}
                                <th class="text-right">@lang('cash::cash.lines.amount.0')</th>
                                {{-- <th>@lang('cash::cash.lines.new_amount.0')</th> --}}
                                <th class="text-right">@lang('cash::cash.balance.0')</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $end_balance = $resource->end_balance; @endphp
                            @foreach ($resource->lines as $line)
                                <tr class="@if ($line->amount < 0) text-danger @endif">
                                    <td class="align-middle">{{ pretty_date($line->transacted_at, true) }}</td>
                                    <td class="align-middle">{{ __(CashLine::CASH_TYPES[$line->cash_type]) }}</td>
                                    <td class="align-middle">{{ $line->description }}</td>
                                    <td class="align-middle">
                                        <a href="{{ $line->referable ? match($line->cash_type) {
                                            CashLine::CASH_TYPE_TransferIn  => route('backend.cashes.show', $line->referable->cash_id),
                                            CashLine::CASH_TYPE_TransferOut => route('backend.cashes.show', $line->referable->cash_id),
                                            //CashLine::CASH_TYPE_Difference   => '#',
                                            CashLine::CASH_TYPE_CreditNote  => route('backend.credit_notes.show', $line->referable),
                                            //CashLine::CASH_TYPE_EmployeeSalary   => '--',
                                            CashLine::CASH_TYPE_EmployeeAnticipation    => route('backend.employees.show', $line->referable),
                                            //CashLine::CASH_TYPE_EmployeeDiscount   => '--',
                                            //CashLine::CASH_TYPE_GeneralExpense   => '--',
                                            CashLine::CASH_TYPE_Invoice     => route('backend.sales.invoices.show', $line->referable),
                                            CashLine::CASH_TYPE_Receipment  => route('backend.receipments.show', $line->referable),
                                            CashLine::CASH_TYPE_BankDeposit => route('backend.deposit_slips.show', $line->referable),
                                            default => null,
                                        } : '#' }}" class="text-decoration-none @if ($line->amount < 0) text-danger @else text-dark @endif"><b>{!! $line->referable ? match($line->cash_type) {
                                            CashLine::CASH_TYPE_TransferIn  => $line->referable->cash->cashBook->name,
                                            CashLine::CASH_TYPE_TransferOut => $line->referable->cash->cashBook->name,
                                            //CashLine::CASH_TYPE_Difference   => '--',
                                            CashLine::CASH_TYPE_CreditNote  => $line->referable->document_number.'<small class="ml-2">'.$line->referable->partnerable->full_name.'</small>',
                                            //CashLine::CASH_TYPE_EmployeeSalary   => '--',
                                            CashLine::CASH_TYPE_EmployeeAnticipation    => $line->referable->full_name,
                                            //CashLine::CASH_TYPE_EmployeeDiscount   => '--',
                                            //CashLine::CASH_TYPE_GeneralExpense   => '--',
                                            CashLine::CASH_TYPE_Invoice     => $line->referable->document_number.'<small class="ml-2">'.$line->referable->partnerable->full_name.'</small>',
                                            CashLine::CASH_TYPE_Receipment  => $line->referable->document_number.'<small class="ml-2">'.$line->referable->partnerable->full_name.'</small>',
                                            CashLine::CASH_TYPE_BankDeposit => $line->referable->bankAccount->bank->name.'<small class="ml-2">'.$line->referable->bankAccount->account_number.'</small>',
                                            default => null,
                                        } : null !!}</b></a>
                                    </td>
                                    <td class="align-middle text-right">{{ currency($line->currency_id)->code }} <b>{{ number($line->amount, currency($line->currency_id)->decimals) }}</b></td>
                                    {{-- <td class="align-middle">{{ amount($line->net_amount, $resource->cashBook->currency) }}</td> --}}
                                    <td class="align-middle text-right">{{ currency($line->currency_id)->code }} <b>{{ number($end_balance, currency($resource->cashBook->currency_id)->decimals) }}</b></td>
                                    @php $end_balance -= $line->net_amount @endphp
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
