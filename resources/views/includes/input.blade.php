<div class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <input type="{{ $type ?? 'text' }}" class="form-control border-blue border-xs" id="{{ $name }}" name="{{ $name }}" value="{{ old( $name, isset($entity) ? $entity->{$name} : '') }}" autocomplete="off">
</div>