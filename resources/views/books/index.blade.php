@extends('layout')

@section('page-content')
    <h1>BookStore</h1>

    <div class="row">
        <div class="col-lg-10 p-3">
            <form method="get" action="{{ route('books.index') }}">
                <div class="row g-2">
                    <div class="col-8">
                        <input type="text" class="form-control" name="search" placeholder="Search by title or author" value="{{ request('search') }}">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-2">
            <a href="{{ route('books.create') }}" class="btn btn-primary">New Book</a>
        </div>
    </div>

    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->price }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                </td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <form action="{{ route('books.delete', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        <input type="hidden" name="id" value="{{ $book->id }}">
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection