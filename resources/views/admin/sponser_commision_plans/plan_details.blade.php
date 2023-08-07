@for ($i = 1; $i <= $total_generations; $i++)
    <div class="form-group col-md-12 mx-auto">
        <div class="input-group">
            <div class="input-group-append">
                <div class="input-group-text">{{ $i }} @lang('Generation')</div>
            </div>
            <input type="hidden" name="generation[]" value="{{ $i }}">
            <input type="number" name="commission[]" step="any" class="form-control"
                placeholder="@lang('Commission')" required>
            <div class="input-group-append">
                <div class="input-group-text">@lang('%')</div>
            </div>
        </div>
    </div>
@endfor
