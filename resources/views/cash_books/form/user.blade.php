<div class="col-12 d-flex mb-1">
    <x-form-foreign name="users[]"
        :values="$users" default="{{ $selected->id ?? null }}"

        foreign="users" foreign-add-label="backend::users.add"
        show="full_name"

        label="cash::cash_book.users.0"
        placeholder="cash::cash_book.users._"
        {{-- helper="cash::cash_book.users.?" --}} />

    <button type="button" class="btn btn-danger ml-2"
        data-action="delete"
        @if ($selected !== null)
        data-confirm="Eliminar @lang('User')?"
        data-text="Esta seguro de eliminar la @lang('User') {{ $selected->name }}?"
        data-accept="Si, eliminar"
        @endif>X</button>
</div>
