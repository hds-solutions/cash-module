@include('backend::components.errors')

<x-backend-form-text :resource="$resource ?? null" name="name" required
    label="cash::currency.name.0"
    placeholder="cash::currency.name._"
    {{-- helper="cash::currency.name.?" --}} />

<x-backend-form-text :resource="$resource ?? null" name="code" required
    label="cash::currency.code.0"
    placeholder="cash::currency.code._"
    {{-- helper="cash::currency.code.?" --}} />

<x-backend-form-number :resource="$resource ?? null" name="decimals" required
    label="cash::currency.decimals.0"
    placeholder="cash::currency.decimals._"
    helper="cash::currency.decimals.?" />

<x-backend-form-controls
    submit="cash::currencies.save"
    cancel="cash::currencies.cancel" cancel-route="backend.currencies" />
