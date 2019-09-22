<div class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <div class="input-group"><span class="input-group-addon border-blue border-xs"><i class="icon-calendar22 border-blue border-xs"></i></span>
        <input type="{{ $type ?? 'text' }}" class="form-control daterange-single border-blue border-xs" id="{{ $name }}" name="{{ $name }}" value="{{ old( $name, isset($entity) ? $entity->{$name} : '') }}" autocomplete="off">
    </div>
</div>