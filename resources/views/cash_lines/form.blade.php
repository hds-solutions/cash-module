@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="cash_id" required readonly
    foreign="cashes" :values="$cashes" {{-- default="123" --}}
    request="cash"

    {{-- foreign-add-label="cash::cashes.add" --}}
    show="cashBook.name"

    label="cash::cash_line.cash_id.0"
    placeholder="cash::cash_line.cash_id._"
    {{-- helper="cash::cash_line.cash_id.?" --}} />

<x-backend-form-select :resource="$resource ?? null" name="cash_type" required
    :values="\HDSSolutions\Laravel\Models\CashLine::CASH_TYPES" {{-- default="123" --}}

    label="cash::cash_line.cash_type.0"
    placeholder="cash::cash_line.cash_type._"
    {{-- helper="cash::cash_line.cash_type.?" --}} />

<x-backend-form-foreign :resource="$resource ?? null" name="currency_id" required
    foreign="currencies" :values="backend()->currencies()"
    request="currency" default="{{ $cash?->cashBook?->currency_id ?? backend()->currency()?->id }}"

    append="decimals"

    foreign-add-label="cash::currencies.add"
    {{-- show="cashBook.name" --}}

    label="cash::cash_line.currency_id.0"
    placeholder="cash::cash_line.currency_id._"
    {{-- helper="cash::cash_line.currency_id.?" --}} />

<x-backend-form-text :resource="$resource ?? null" name="description" required

    label="cash::cash_line.description.0"
    placeholder="cash::cash_line.description._"
    {{-- helper="cash::cash_line.description.?" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="amount" required
    currency="[name=currency_id]"

    label="cash::cash_line.amount.0"
    placeholder="cash::cash_line.amount._"
    {{-- helper="cash::cash_line.amount.?" --}} />

<x-backend-form-controls
    submit="cash::cash_lines.save"
    cancel="cash::cash_lines.cancel" cancel-route="backend.cashes.show:{{ $cash->id }}" />
