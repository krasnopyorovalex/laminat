@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Фотогалерея</li>
@endsection

@section('content')

    <a href="{{ route('admin.galleries.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Обновлена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($galleries as $gallery)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $gallery->name }}</td>
                    <td><span class="label label-primary">{{ $gallery->updated_at->diffForHumans() }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.galleries.edit', $gallery) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $gallery->alias }}">
                                    <i class="icon-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection