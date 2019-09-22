<div class="form-group">
    <label for="{{ $name }}">{{ $label }}:</label>
    <select class="form-control border-blue border-xs select-search" id="{{ $name }}" name="{{ $name }}" data-width="100%">
        @inject('linkGenerator', 'App\Services\LinkGeneratorService')

        @foreach($linkGenerator->getCollection() as $key => $value)
            @if (count($value['collections']))
            <optgroup label="{{ $key }}">
                @foreach($value['collections'] as $item)
                    <option value="{{ $linkGenerator->createLink($value['module'], $item->alias) }}"  @if ( isset($entity) && $linkGenerator->createLink($value['module'], $item['alias']) == old($name, $entity->{$name}))selected="selected"@endif>
                        {{ $item->name }}
                    </option>
                @endforeach
            </optgroup>
            @endif
        @endforeach
    </select>
</div>