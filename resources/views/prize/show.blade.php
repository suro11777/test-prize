@extends('layouts.app')

@section('content')
    @if($getPrize)
        <div>
            <h2>Get Your Prize</h2>
            <div>
            <span>
                You Win
                @if($type != 3)
                    {{$getPrize. $whatDidYouWin}}
                    @php $type == 2 ? $inputName = 'count_points':$inputName = 'money' @endphp
                @else
                    {{$getPrize->name?$getPrize->name . $whatDidYouWin:"You haven't won, try later"}}
                    @php $inputName = 'thing' @endphp
                @endif
            </span>
                <div>
                    <button id="refuse"><a href="{{route('home')}}"> {{__('Refuse A Prize')}}</a></button>
                </div>


                <div>
                    <form id="get-prize" action="{{route('user.update-prize')}}" method="POST">
                        @csrf
                        <input id="name" type="hidden" name="{{$inputName}}" value="{{$getPrize}}">
                        <input id="type" type="hidden" name="type" value="{{$type}}">
                        <button type="submit" id="get-prize">Get Prize</button>
                    </form>
                </div>

                @if($type == 1)
                    <div>
                        <button id="change"> {{__('change money to points')}}</button>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div>{{__("You haven't won, try later")}}</div>
    @endif
@endsection

@push('bottom_js')
    <script !src="">
        $('#change').on('click', function () {
            let change = {{config('settings.change')}};
            let money = {{$getPrize}};
            let nameValue = money * change;
            $("#name").val(nameValue);
            $("#name").attr("name", 'count_points');
            $('#type').val(2);
            $('#get-prize').submit();
        })
    </script>
@endpush
