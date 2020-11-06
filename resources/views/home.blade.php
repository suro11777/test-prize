@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Prize') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(time() - auth()->user()->when_played > 86400)
                            <div>
                                <button class="btn btn-success"><a href="{{route('get-prize')}}">{{__('Get Prize')}}</a>
                                </button>
                            </div>
                            @else
                            <h4>You have already taken part</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
