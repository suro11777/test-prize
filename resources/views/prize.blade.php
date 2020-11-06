@extends('layouts.app')

@section('content')

    <div>
        <h3>
            @if($updated)
                {{__('Your winnings have been sent or added to your account')}}
            @else
                {{__('Sorry something went wrong')}}
            @endif
        </h3>
    </div>
@endsection
