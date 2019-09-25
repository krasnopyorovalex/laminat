@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Фильтры</li>
@endsection

@section('content')

    <a href="{{ route('admin.filters.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Позиция</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($filters as $filter)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $filter->name }}</td>
                    <td>{{ $filter->pos }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.filters.edit', $filter) }}"><i class="icon-pencil7"></i></a>
                            <a href="{{ route('admin.filter_options.index', $filter) }}" data-original-title="Опции фильтра" data-popup="tooltip"><i class="icon-lan2"></i></a>
                            <form method="POST" action="{{ route('admin.filters.destroy', $filter) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn">
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
