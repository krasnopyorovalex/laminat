@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Расписание</li>
@endsection

@section('content')

    <a href="{{ route('admin.schedules.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>Дата похода</th>
                <th>Описание</th>
                <th>Цена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td><span class="label label-primary">{{ $schedule->date->formatLocalized('%d %b %Y') }}</span></td>
                    <td>{!! strip_tags($schedule->body) !!}</td>
                    <td>{{ $schedule->price }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.schedules.edit', $schedule) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.schedules.destroy', $schedule) }}" class="form__delete">
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
