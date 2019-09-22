@foreach($catalogs as $catalog)
    <tr>
        <td><span class="label label-primary">{{ $child ? '' : $loop->iteration }}</span></td>
        <td> {{ $prefix }} {{ $catalog->name }}</td>
        <td>{{ $catalog->alias }}</td>
        <td><span class="label label-primary">{{ $catalog->updated_at->diffForHumans() }}</span></td>
        <td>
            <div>
                <a href="{{ route('admin.catalogs.edit', $catalog) }}"><i class="icon-pencil7"></i></a>
                @if (!count($catalog->catalogs))
                <a href="{{ route('admin.catalog_products.index', $catalog) }}" data-original-title="Товары" data-popup="tooltip"><i class="icon-lan2"></i></a>
                @endif
                <form method="POST" action="{{ route('admin.catalogs.destroy', $catalog) }}" class="form__delete">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="last__btn">
                        <i class="icon-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @if ($catalog->catalogs)
        @include('admin.catalogs._tr', ['catalogs' => $catalog->catalogs, 'prefix' => $prefix . '***', 'child' => true])
    @endif
@endforeach
