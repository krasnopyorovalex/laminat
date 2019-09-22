@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Статьи</li>
@endsection

@section('content')

    <a href="{{ route('admin.articles.create') }}" type="button" class="btn bg-primary">
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
                <th>Создана</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->alias }}</td>
                    <td><span class="label label-primary">{{ Illuminate\Support\Carbon::parse($article->published_at)->format('d M Y') }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.articles.edit', $article) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="form__delete">
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