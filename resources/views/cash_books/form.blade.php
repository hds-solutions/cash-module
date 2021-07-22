@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="currency_id" required
    foreign="currencies" :values="backend()->currencies()" foreign-add-label="cash::currencies.add"
    append="decimals" default="{{ backend()->currency()?->id }}"

    label="cash::cash_book.currency_id.0"
    placeholder="cash::cash_book.currency_id._"
    {{-- helper="cash::cash_book.currency_id.?" --}} />

<x-backend-form-text :resource="$resource ?? null" name="name" required
    label="cash::cash_book.name.0"
    placeholder="cash::cash_book.name._"
    {{-- helper="cash::cash_book.name.?" --}} />

<x-backend-form-controls
    submit="cash::cash_books.save"
    cancel="cash::cash_books.cancel" cancel-route="backend.cash_books" />
