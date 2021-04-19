@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="cash_id" required
    foreign="cashes" :values="$cashes" foreign-add-label="{{ __('cash::cashes.add') }}"
    option-title="cashBook.name"

    label="{{ __('cash::cashmovement.cash_id.0') }}"
    placeholder="{{ __('cash::cashmovement.cash_id._') }}"
    {{-- helper="{{ __('cash::cashmovement.cash_id.?') }}" --}} />

<x-backend-form-foreign :resource="$resource ?? null" name="to_cash_id" required
    foreign="cashes" :values="$cashes" foreign-add-label="{{ __('cash::cashes.add') }}"
    option-title="cashBook.name"

    label="{{ __('cash::cashmovement.to_cash_id.0') }}"
    placeholder="{{ __('cash::cashmovement.to_cash_id._') }}"
    {{-- helper="{{ __('cash::cashmovement.to_cash_id.?') }}" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="amount" required
    label="{{ __('cash::cashmovement.amount.0') }}"
    placeholder="{{ __('cash::cashmovement.amount._') }}"
    {{-- helper="{{ __('cash::cashmovement.amount.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="description" required
    label="{{ __('cash::cashmovement.description.0') }}"
    placeholder="{{ __('cash::cashmovement.description._') }}"
    {{-- helper="{{ __('cash::cashmovement.description.?') }}" --}} />

<x-backend-form-foreign :resource="$resource ?? null" name="conversion_rate_id"
    foreign="conversion_rates" :values="$conversion_rates" foreign-add-label="{{ __('cash::conversion_rates.add') }}"

    label="{{ __('cash::cashmovement.conversion_rate_id.0') }}"
    placeholder="{{ __('cash::cashmovement.conversion_rate_id._') }}"
    {{-- helper="{{ __('cash::cashmovement.conversion_rate_id.?') }}" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="rate"
    label="{{ __('cash::cashmovement.rate.0') }}"
    placeholder="{{ __('cash::cashmovement.rate._') }}"
    {{-- helper="{{ __('cash::cashmovement.rate.?') }}" --}} />

<x-backend-form-controls
    submit="cash::cashmovements.save"
    cancel="cash::cashmovements.cancel" cancel-route="backend.cashmovements" />
