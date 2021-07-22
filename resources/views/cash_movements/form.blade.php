@include('backend::components.errors')

<x-backend-form-foreign :resource="$resource ?? null" name="cash_id" required
    foreign="cashes" :values="$cashes" foreign-add-label="cash::cashes.add"
    show="cashBook.name"

    label="cash::cash_movement.cash_id.0"
    placeholder="cash::cash_movement.cash_id._"
    {{-- helper="cash::cash_movement.cash_id.?" --}} />

<x-backend-form-foreign :resource="$resource ?? null" name="to_cash_id" required
    foreign="cashes" :values="$cashes" foreign-add-label="cash::cashes.add"
    show="cashBook.name"

    label="cash::cash_movement.to_cash_id.0"
    placeholder="cash::cash_movement.to_cash_id._"
    {{-- helper="cash::cash_movement.to_cash_id.?" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="amount" required
    label="cash::cash_movement.amount.0"
    placeholder="cash::cash_movement.amount._"
    {{-- helper="cash::cash_movement.amount.?" --}} />

<x-backend-form-text :resource="$resource ?? null" name="description" required
    label="cash::cash_movement.description.0"
    placeholder="cash::cash_movement.description._"
    {{-- helper="cash::cash_movement.description.?" --}} />

<x-backend-form-foreign :resource="$resource ?? null" name="conversion_rate_id"
    foreign="conversion_rates" :values="$conversion_rates" foreign-add-label="cash::conversion_rates.add"

    label="cash::cash_movement.conversion_rate_id.0"
    placeholder="cash::cash_movement.conversion_rate_id._"
    {{-- helper="cash::cash_movement.conversion_rate_id.?" --}} />

<x-backend-form-amount :resource="$resource ?? null" name="rate"
    label="cash::cash_movement.rate.0"
    placeholder="cash::cash_movement.rate._"
    {{-- helper="cash::cash_movement.rate.?" --}} />

<x-backend-form-controls
    submit="cash::cash_movements.save"
    cancel="cash::cash_movements.cancel" cancel-route="backend.cash_movements" />
