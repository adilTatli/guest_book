@extends('layouts.layout')

@section('content')

    <div class="container mt-5">
        <h1>Личный кабинет</h1>


        <h2 class="mt-5">Отзывы</h2>

        <div class="mt-2 mb-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-review" >
                Оставить отзыв
            </button>

            <div class="modal fade" id="modal-review" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Оставить отзыв</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="{{ route('home') }}" method="POST" id="reviewForm">
                                @csrf

                                <div class="mb-3">
                                    <label for="review" class="form-label">Отзыв</label>
                                    <textarea class="form-control" id="review" name="content" rows="4" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <div class="form_item">
                                        <div class="form_label">Оценка:</div>
                                        <div class="rating rating_set">
                                            <div class="rating_body">
                                                <div class="rating_active"></div>
                                                <div class="rating_items">
                                                    <input type="radio" class="rating_item" value="1" name="rating">
                                                    <input type="radio" class="rating_item" value="2" name="rating">
                                                    <input type="radio" class="rating_item" value="3" name="rating">
                                                    <input type="radio" class="rating_item" value="4" name="rating">
                                                    <input type="radio" class="rating_item" value="5" name="rating">
                                                </div>
                                            </div>
                                            <div class="rating_value">0</div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($posts->count())
            <table class="table">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Отзыв</th>
                    <th>Оценка</th>
                    <th>Дата добавления</th>
                    <th>Actions</th>
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
