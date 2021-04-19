@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="cash_id" required
    foreign="cash_books" :values="$cash_books" foreign-add-label="{{ __('cash::cash_books.add') }}"

    label="{{ __('cash::cash.cash_id.0') }}"
    placeholder="{{ __('cash::cash.cash_id._') }}"
    {{-- helper="{{ __('cash::cash.cash_id.?') }}" --}} />

<x-backend-form-foreign :resource="$resource ?? null" name="to_cash_id" required
    foreign="cash_books" :values="$cash_books" foreign-add-label="{{ __('cash::cash_books.add') }}"

    label="{{ __('cash::cash.to_cash_id.0') }}"
    placeholder="{{ __('cash::cash.to_cash_id._') }}"
    {{-- helper="{{ __('cash::cash.to_cash_id.?') }}" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="amount" required
    label="{{ __('cash::cash.amount.0') }}"
    placeholder="{{ __('cash::cash.amount._') }}"
    {{-- helper="{{ __('cash::cash.amount.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="description" required
    label="{{ __('cash::cash.description.0') }}"
    placeholder="{{ __('cash::cash.description._') }}"
    {{-- helper="{{ __('cash::cash.description.?') }}" --}} />

<x-backend-form-foreign :resource="$resource ?? null" name="conversion_rate_id"
    foreign="conversion_rates" :values="$conversion_rates" foreign-add-label="{{ __('cash::conversion_rates.add') }}"

    label="{{ __('cash::cash.conversion_rate_id.0') }}"
    placeholder="{{ __('cash::cash.conversion_rate_id._') }}"
    {{-- helper="{{ __('cash::cash.conversion_rate_id.?') }}" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="rate"
    label="{{ __('cash::cash.rate.0') }}"
    placeholder="{{ __('cash::cash.rate._') }}"
    {{-- helper="{{ __('cash::cash.rate.?') }}" --}} />

<x-backend-form-controls
    submit="cash::cashmovements.save"
    cancel="cash::cashmovements.cancel" cancel-route="backend.cashmovements" />
