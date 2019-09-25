@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.filters.index') }}">Фильтры</a></li>
    <li class="active">Список опций</li>
@endsection

@section('content')

    <a href="{{ route('admin.filter_options.create', ['filter' => $filter]) }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Фильтр</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="table__dnd">
            @foreach($filterOptions as $filterOption)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $filterOption->name }}</td>
                    <td><span class="label label-primary bg-teal-400">{{ $filterOption->filter->name }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.filter_options.edit', $filterOption) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.filter_options.destroy', $filterOption) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="hidden" value="{{ $filterOption->filter->id }}" name="filter_id">
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
