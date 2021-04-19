@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="currency_id" required
    foreign="currencies" :values="$currencies" foreign-add-label="{{ __('inventory::currencies.add') }}"

    label="{{ __('inventory::inventory.currency_id.0') }}"
    placeholder="{{ __('inventory::inventory.currency_id._') }}"
    {{-- helper="{{ __('inventory::inventory.currency_id.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="name" required
    label="{{ __('cash::currency.name.0') }}"
    placeholder="{{ __('cash::currency.name._') }}"
    {{-- helper="{{ __('cash::currency.name.?') }}" --}} />

<x-backend-form-controls
    submit="cash::cash_books.save"
    cancel="cash::cash_books.cancel" cancel-route="backend.cash_books" />
