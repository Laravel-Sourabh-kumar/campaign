@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<div class="container">
    <h1>Create a New Campaign</h1>
    <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Campaign Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div>
            <label for="file">Upload CSV File:</label>
            <input type="file" name="file" id="file" accept=".csv" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-5">Create Campaign</button>
    </form>
    </div>
@endsection
