@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="cash_book_id" required
    foreign="cash_books" :values="$cash_books" request="cash_book" foreign-add-label="cash::cash_books.add"

    label="cash::cash.cash_book_id.0"
    placeholder="cash::cash.cash_book_id._"
    {{-- helper="cash::cash.cash_book_id.?" --}} />

<x-backend-form-text :resource="$resource ?? null" name="description" required
    default="{{ __('cash::cash.nav').' @ '.now() }}"
    label="cash::cash.description.0"
    placeholder="cash::cash.description._"
    {{-- helper="cash::cash.description.?" --}} />

{{-- <x-backend-form-amount :resource="$resource ?? null" name="start_balance"
    label="cash::cash.start_balance.0"
    placeholder="cash::cash.start_balance._"
    helper="cash::cash.start_balance.?" /> --}}

<x-backend-form-controls
    submit="cash::cashes.save"
    cancel="cash::cashes.cancel" cancel-route="backend.cashes" />
