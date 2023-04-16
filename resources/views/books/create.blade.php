@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <strong> Create </strong>
        </div>
        <div class="card-body">
            <form action="{{route('book.save')}}" method="POST" id="create-book-form">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title"> Title </label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="title"> Description </label>
                    <textarea name="description" id="description" class="form-control"cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-sm btn-success" onclick="showLoading()" id="btn-save"> Save </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>

    $( document ).ready(function() {

    });


    function showLoading(){
        
        // Jquery
        var btn = $('#btn-save')
        btn.text('Creating..')
        btn.prop( "disabled", true );
        $( "#create-book-form" ).submit();

        // Pure JS / Vanilla JS
        // document.getElementById("create-book-form").submit();
        // document.getElementById("btn-save").innerText = "Creating...";
        // document.getElementById("btn-save").disabled = true
    }
</script>

@endsection
