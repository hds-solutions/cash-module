@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="cash_book_id" required
    foreign="cash_books" :values="$cash_books" foreign-add-label="{{ __('cash::cash_books.add') }}"

    label="{{ __('cash::cash.cash_book_id.0') }}"
    placeholder="{{ __('cash::cash.cash_book_id._') }}"
    {{-- helper="{{ __('cash::cash.cash_book_id.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="description" required
    default="{{ __('cash::cash.nav').' @ '.now() }}"
    label="{{ __('cash::cash.description.0') }}"
    placeholder="{{ __('cash::cash.description._') }}"
    {{-- helper="{{ __('cash::cash.description.?') }}" --}} />

{{-- <x-backend-form-amount :resource="$resource ?? null" name="start_balance"
    label="{{ __('cash::cash.start_balance.0') }}"
    placeholder="{{ __('cash::cash.start_balance._') }}"
    helper="{{ __('cash::cash.start_balance.?') }}" /> --}}

<x-backend-form-controls
    submit="cash::cashes.save"
    cancel="cash::cashes.cancel" cancel-route="backend.cashes" />
