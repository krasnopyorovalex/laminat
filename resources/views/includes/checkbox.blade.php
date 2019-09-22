<div class="form-group">
    <label class="checkbox-inline">
        <input type="hidden" name="{{ $name }}" value="0">
        <input type="checkbox" class="control-primary" value="1" {{ (isset($entity) && $entity->{$name} || isset($isChecked) && $isChecked) ? 'checked="checked"' : ''  }} name="{{ $name }}">
        {{ $label }}
    </label>
</div>