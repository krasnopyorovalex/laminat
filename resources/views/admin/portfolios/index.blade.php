@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Портфолио</li>
@endsection

@section('content')

    <a href="{{ route('admin.portfolios.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Alias</th>
                <th>Позиция</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($portfolios as $portfolio)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $portfolio->name }}</td>
                    <td>{{ $portfolio->alias }}</td>
                    <td>{{ $portfolio->pos }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.portfolios.edit', $portfolio) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.portfolios.destroy', $portfolio) }}" class="form__delete">
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