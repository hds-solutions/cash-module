@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="cash_book_id" required
    foreign="cash_books" :values="$cash_books" foreign-add-label="{{ __('cash::cash_books.add') }}"

    label="{{ __('cash::cash.cash_book_id.0') }}"
    placeholder="{{ __('cash::cash.cash_book_id._') }}"
    {{-- helper="{{ __('cash::cash.cash_book_id.?') }}" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="start_balance" required
    label="{{ __('cash::cash.start_balance.0') }}"
    placeholder="{{ __('cash::cash.start_balance._') }}"
    {{-- helper="{{ __('cash::cash.start_balance.?') }}" --}} />

<div class="form-row">
    <div class="offset-0 offset-md-3 col-12 col-md-9">
        <button type="submit" class="btn btn-success">@lang('cash::cashes.save')</button>
        <a href="{{ route('backend.cashes') }}" class="btn btn-danger">@lang('cash::cashes.cancel')</a>
    </div>
</div>
