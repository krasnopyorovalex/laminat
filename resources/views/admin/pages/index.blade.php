@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Страницы</li>
@endsection

@section('content')

    <a href="{{ route('admin.pages.create') }}" type="button" class="btn bg-primary">
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
                <th>Обновлена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $page->name }}</td>
                    <td>{{ $page->alias }}</td>
                    <td><span class="label label-primary">{{ $page->updated_at->diffForHumans() }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.pages.edit', $page) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $page->alias }}">
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