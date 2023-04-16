@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{route('assignment.assign')}}" method="POST">
    @csrf
    @method('POST')
        <div class="card">
            <div class="card-header">
                <strong> Assignments </strong> 
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <strong> Books </strong> 
                        <button type="button" class="text-primary" value="1" style="cursor:pointer" onclick="checkAllBooks()" id="btn-select-books"> Select all books </button>
                        <table class="table table-sm table-hover">
                            <thead>
                                <th> </th>
                                <th> Book name </th>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                <tr>
                                    <td>  
                                        <div class="form-check">
                                            <input class="form-check-input bookCheckbox" type="checkbox" name="books[]" value="{{$book->id}}" id="defaultCheck1">
                                        </div>
                                    </td>
                                    <td> {{$book->title}} </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="2"> No record found </td>
                                    </tr>
                                @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <strong> Users </strong>
                        <table class="table table-sm table-hover">
                            <thead>
                                <th> </th>
                                <th> Student </th>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>  
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="users[]" value="{{$user->id}}" id="defaultCheck1">
                                        </div>
                                    </td>
                                    <td> {{$user->name}} </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="2"> No record found </td>
                                    </tr>
                                @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success"> Assign Books </button>
            </div>
        </div>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script>
    function checkAllBooks(){
      
        var value = $('#btn-select-books').val();

        if(value == 1){
            $('.bookCheckbox').attr('checked',true)
            $('#btn-select-books').val(0)
        }else{
            $('.bookCheckbox').removeAttr( "checked" )
            $('#btn-select-books').val(1)
        }

    }
</script>

@endsection
