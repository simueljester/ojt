@extends('layouts.app')

@section('content')
@if (Auth::user()->role == 'teacher')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white"> Teacher Account </div>
                    <div class="p-3">
                        Hello {{Auth::user()->name}}
                        <div>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                                Create new book (via ajax)
                            </button>
                            <br>
                            <br>
                            <a class="btn btn-warning btn-sm" href="{{route('book.create')}}"> Create New Book (via page)</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <th> Title </th>
                                <th> Created At </th>
                                <th> Status </th>
                                <th> Action </th>
                            </thead>
                            <tbody id="tbl_books">
                                {{-- <tr>
                                    <td colspan="4">  </td>
                                </tr> --}}
                                {{-- @forelse ($books as $index => $book)
                                    <tr>
                                        
                                        <td style="width:10%">
                                            {{$book->title}}
                                        </td>
                                        <td style="width:30%">
                                            {{$book->description}}
                                        </td>
                                        <td style="width:20%">
                                            {{$book->created_at->format('M-d-y')}}
                                        </td>
                                        <td style="width:10%">
                                            <span class="badge {{$book->archived_at ? 'badge-danger' : 'badge-success' }} "> {{$book->archived_at ? 'archived' : 'active' }} </span>    
                                            @if ($book->archived_at)
                                                {{ $book->archived_at->format('M-d-y') }}
                                            @endif
                                        </td>
                                        <td style="width:30%">
                                            <a href="{{route('book.edit',$book->id)}}" class="btn btn-primary"> Edit </a>
                                            <form action="{{route('book.delete')}}" method="post">
                                                @csrf
                                                @method('POST')
                                                <button class="btn btn-danger" name="delete_id" value="{{$book->id}}"> Delete </button>
                                            </form>
                                         
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"> No record found </td>
                                    </tr>
                                @endforelse --}}
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>





@else
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white"> Student Account </div>
                    <div  class="text-center">
                        Hello {{Auth::user()->name}}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


    <!-- Modal Create -->
      <form enctype="multipart/form-data" id="postForm" name="postForm"  method="post">
        <div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title"> Title </label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title"> Description </label>
                            <textarea name="description" id="description" class="form-control"cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="btn-save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

     <!-- Modal View -->
    <div class="modal fade" id="modal-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <strong> Title: </strong>
                        <div id="view-title"></div>
                    </div>
                    <div>
                        <strong> Description: </strong>
                        <div id="view-description"></div>
                    </div>
                    <div>
                        <strong> Creation Date: </strong>
                        <div id="view-created_at"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <form enctype="multipart/form-data" id="postEditForm" name="postEditForm"  method="post">
        <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title"> Title </label>
                            <input type="text" name="title_edit" id="title_edit" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title"> Description </label>
                            <textarea name="description_edit" id="description_edit" class="form-control"cols="30" rows="10"> </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_edit" id="id_edit">
                        <button type="button" id="btn-update-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="button" id="btn-update" class="btn btn-primary"> Update Record </button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Modal Delete -->
    {{-- <form enctype="multipart/form-data" id="postDeleteForm" name="postDeleteForm"  method="post"> --}}
        <div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm Book Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span> Are you sure you want to delete <strong id="title_delete"></strong> ? </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <button type="button" id="btn-delete-close" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                         <button type="button" id="btn-delete" onclick="deleteBook()" class="btn btn-danger"> Delete Record </button>
                    </div>
                </div>
            </div>
        </div>
    {{-- </form> --}}


{{-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> --}}
<script>

$( document ).ready(function() {
    getList()
});

function getList(){

    var str = ""
     $.ajax({
        type:'GET',
        url:"{{ route('book.list') }}",

        success:function(data){
                     
            var books = data
            var is_archive 
            
            books.forEach((book, key) => {
            
            is_archive = book.archived_at != null ? '<span class="badge badge-pill badge-warning">Archived</span>' : '<span class="badge badge-pill badge-success">Active</span>'
            var jsonbook = JSON.stringify(book)
         
            str += `
                    <tr>
                        <td class='align-left'> ${book.title} </td>
                        <td class='align-left'> ${book.created_at} </td>
                        <td class='align-left'> ${is_archive} </td>
                        <td class='align-left'>  
                            <button class='btn btn-success btn-sm' onclick='viewBook(${jsonbook})'> View </button>
                            <button class='btn btn-primary btn-sm' onclick='openEdit(${jsonbook})'> Edit </button>
                            <button class='btn btn-danger btn-sm' onclick='confirmDelete(${jsonbook})'> Delete </button>
                        </td>
                    </tr>
            `
            })
            $("#tbl_books").html(str);
       
        },
        error:function(e){
           console.log(e);
        }

       
    });

 


}

//Saving Record
$('#btn-save').on('click', function() {
  let data = new FormData($("#postForm")[0]);

  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '{{ route('book.save') }}',
    type: 'POST',
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function(xhr) {
        $('#btn-save').text('Saving...');
    },
    success: function(data) {
        if(data == 'success'){
            getList()
            $("#btn-close" ).trigger( "click" );
            alert('Record succesfully created')
        }else{
            alert('Error')
        }

        $('#btn-save').text('Save');
        $('#title').val('');
        $('#description').val('');
    },
    error: function(r) {
        console.log('error', r);
        $('#btn-save').text('Save');
        $('#title').val('');
        $('#description').val('');
    }
  });
});

//Editing Record
function openEdit(jsonbook){
    $('#id_edit').val(jsonbook.id)
    $('#title_edit').val(jsonbook.title)
    $('#description_edit').html(jsonbook.description)
    $('#modal-edit').modal()
}

$('#btn-update').on('click', function() {
  let data = new FormData($("#postEditForm")[0]);
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '{{ route('book.update') }}',
    type: 'POST',
    data: data,
    processData: false,
    contentType: false,
    beforeSend: function(xhr) {
        $('#btn-update').text('Updating Record...');
    },
    success: function(data) {
        if(data == 'success'){
            getList()
            $("#btn-update-close" ).trigger( "click" );
            alert('Record succesfully updated')
        }else{
            alert('Error')
        }
    $('#btn-update').text('Update Record');
    },
    error: function(r) {
      console.log('error', r);
    $('#btn-update').text('Update Record');
    }
  });
});


//Viewing Record
function viewBook(jsonbook){
    $('#view-title').html(jsonbook.title)
    $('#view-description').html(jsonbook.description)
    $('#view-created_at').html(jsonbook.created_at)
    $('#modal-view').modal()
}


//Deleting Record
function confirmDelete(jsonbook){
    $('#delete_id').val(jsonbook.id)
    $('#title_delete').html(jsonbook.title)
    $('#modal-delete').modal()
}

function deleteBook(){
    var id_to_delete = $('#delete_id').val()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'POST',
        url:"{{ route('book.delete') }}",
        data:{ delete_id:id_to_delete },
        beforeSend: function(xhr) {
            $('#btn-delete').text('Deleting...');
        },
        success:function(data){
            if(data == 'success'){
                getList()
                $("#btn-delete-close" ).trigger( "click" );
                alert('Record succesfully deleted')
                $('#btn-delete').text('Delete Record');
            }else{
                alert('Error')
            }
        },
        error:function(e){
            console.log(e);
            $('#btn-delete').text('Delete Record');
        }
    });
}


</script>


@endsection
