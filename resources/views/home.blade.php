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
                    御器所の音楽室へようこそ!
                    <a href="../">掲示板へ行く</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
