@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <strong> Edit Book </strong>
        </div>
        <div class="card-body">
            <form action="{{route('book.update')}}" method="POST">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title"> Title </label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$book->title}}">
                </div>
                <div class="form-group">
                    <label for="title"> Description </label>
                    <textarea name="description" id="description" class="form-control"cols="30" rows="10"> {!! $book->description !!} </textarea>
                </div>
                <div class="form-group">
                    <input type="hidden" name="id" value="{{$book->id}}">
                    <button class="btn btn-sm btn-success"> Save Changes </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
