@include('backend::components.errors')

<x-backend-form-text :resource="$resource ?? null" name="name" required
    label="{{ __('cash::currency.name.0') }}"
    placeholder="{{ __('cash::currency.name._') }}"
    {{-- helper="{{ __('cash::currency.name.?') }}" --}} />

<x-backend-form-text :resource="$resource ?? null" name="code" required
    label="{{ __('cash::currency.code.0') }}"
    placeholder="{{ __('cash::currency.code._') }}"
    {{-- helper="{{ __('cash::currency.code.?') }}" --}} />

<x-backend-form-number :resource="$resource ?? null" name="decimals" required
    label="{{ __('cash::currency.decimals.0') }}"
    placeholder="{{ __('cash::currency.decimals._') }}"
    helper="{{ __('cash::currency.decimals.?') }}" />

<x-backend-form-controls
    submit="cash::currencies.save"
    cancel="cash::currencies.cancel" cancel-route="backend.currencies" />
