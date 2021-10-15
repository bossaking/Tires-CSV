@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="generate-csv" class="btn btn-primary mb-2">Generate CSV</a>
            <table style="width: 100%" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Model</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tires as $tire)
                        <tr>
                            <td>{{$tire->name}}</td>
                            <td>{{$tire->model}}</td>
                            <td>{{$tire->price}}</td>
                            <td>{{$tire->date}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
