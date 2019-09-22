<tr>
    <td><span class="label label-primary">{{ $child ? '' : $loop->iteration }}</span></td>
    <td> {{ $prefix }} {{ $service->name }}</td>
    <td>{{ $service->alias }}</td>
    <td>
        <div>
            <a href="{{ route('admin.services.edit', $service) }}"><i class="icon-pencil7"></i></a>
            <form method="POST" action="{{ route('admin.services.destroy', $service) }}" class="form__delete">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="last__btn">
                    <i class="icon-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>