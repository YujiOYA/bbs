@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    大矢の日記へようこそ!
                    <a href="../">日記へ行く</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
