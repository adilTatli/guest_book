@extends('layouts.layout')

@section('content')

    <div class="container mt-5">

        <h2 class="mt-5">Отзывы</h2>
        @if($users->count())
            <table class="table">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Отзыв</th>
                    <th>Оценка</th>
                    <th>Дата добавления</th>
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <th>Actions</th>
                    @endif
                </tr>
                </thead>
                <tbody id="review-table">

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($user->posts as $post)
                                {{ $post->content }}
                            @endforeach
                        </td>
                        <td>
                            @foreach ($user->posts as $post)
                                <div class="rating rating_set">
                                    <div class="rating_body">
                                        <div class="rating_active"></div>
                                    </div>
                                    <div class="rating_value">{{ $post->rating }}</div>
                                </div>
                            @endforeach
                        </td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>

                        @if(auth()->user() && auth()->user()->isAdmin())
                            <td>
                                <a href="{{ route('user.posts.edit', ['post' => $post->id]) }}" class="btn btn-info mb-3 mt-2">
                                    <i class="fas fa-pencil-alt">Изменить</i>
                                </a>

                                <form action="{{ route('user.posts.destroy', ['post' => $post->id]) }}" method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger mb-2"
                                            onclick="return confirm('Подтвердите удаление')">
                                        <i class="fas fa-trash-alt">Удалить</i>
                                    </button>
                                </form>
                            </td>
                        @endif

                    </tr>
                @endforeach

                </tbody>
            </table>
        @else
            <div class="row">
                <div class="col">
                    <p>Записей не найдено...</p>
                </div>
            </div>
        @endif

        <div class="card-footer clearfix">
            {{ $users->links() }}
        </div>

    </div>

@endsection
