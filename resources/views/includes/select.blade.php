<div class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <select class="form-control border-blue border-xs select-search" id="{{ $name }}" name="{{ $name }}" data-width="100%">
        <option value="">Не выбрано</option>
        @foreach($items as $value)
            <option value="{{ $value->id }}" @if (isset($entity) && old($name, $entity->{$name}) == $value->id) selected @endif>{{ $value->name }}</option>
        @endforeach
    </select>
</div>