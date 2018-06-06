@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    403!  Forbidden error
                    <br>
                    Bạn không có quyền truy cập vào mục này.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
