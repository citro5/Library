@extends('layouts.master')

@section('titolo')
Authors of my books
@endsection

@section('stile', 'style.css')

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item dropdown current">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">My Library</a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('book.index') }}">Books's list</a></li>
        <li class="current"><a class="dropdown-item" href="{{ route('author.index') }}">Authors' list</a></li>
    </ul>
</li>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item" aria-current="page">Library</li>
        <li class="breadcrumb-item">Authors</li>
    </ol>
</nav>
@endsection

@section('corpo')
<div class="row">
    <div class="col-md-offset-10 col-xs-6">
        <p>
            <a class="btn btn-success" href="{{ route('author.create') }}"><i class="bi-person-plus"></i> Create new author</a>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-hover table-responsive" style="width:100%">
            <col width='80%'>
            <col width='10%'>
            <col width='10%'>
                        
            <thead>
                <tr>
                    <th>Author's name</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($authors_list as $author)
                <tr>
                    <td>{{ $author->lastname }} {{ $author->firstname }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('author.edit', ['author' => $author->id]) }}"><i class="bi-pencil-square"></i> Edit</a>
                    </td>
                    <td>
                        @if(count($author->books)==0)
                        <a class="btn btn-danger" href="{{ route('author.destroy.confirm', ['id' => $author->id]) }}"><i class="bi-trash3"></i> Delete</a>
                        @else
                        <a class="btn btn-secondary" disabled="disabled" href=""><i class="bi-lock"></i> Delete</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection