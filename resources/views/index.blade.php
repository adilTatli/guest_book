@extends('layouts.layout')

@section('content')

    <div class="container mt-5">
        <h1>Гостевая книга</h1>

        <form method="GET" action="{{ route('search') }}">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="mb-2" for="search">Поиск</label>
                    <input type="text" name="search" class="form-control" id="search" value="{{ request('search') }}">
                </div>
            </div>
        </form>

        <h2 class="mt-5">Отзывы</h2>

        @if(!auth()->user())
            <h4>Войдите чтобы оставить отзыв</h4>
        @endif

        @if($posts->count())
            <table class="table">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Отзыв</th>
                    <th>Оценка</th>
                    <th>Дата добавления</th>
                </tr>
                </thead>
                <tbody id="review-table">

                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->user->email }}</td>
                        <td>{{ $post->content }}</td>
                        <td>
                            <div class="rating rating_set">
                                <div class="rating_body">
                                    <div class="rating_active"></div>
                                </div>
                                <div class="rating_value">{{ $post->rating }}</div>
                            </div>
                        </td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        @else
            <div class="row">
                <div class="col">
                    <p>Записей пока нет...</p>
                </div>
            </div>
        @endif

        <div class="card-footer clearfix">
            {{ $posts->links() }}
        </div>

    </div>

@endsection
