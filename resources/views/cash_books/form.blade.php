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

<div class="form-row">
    <div class="offset-0 offset-md-3 col-12 col-md-9">
        <button type="submit" class="btn btn-success">@lang('cash::cash_books.save')</button>
        <a href="{{ route('backend.cash_books') }}" class="btn btn-danger">@lang('cash::cash_books.cancel')</a>
    </div>
</div>
