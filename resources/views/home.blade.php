@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <form class="card card-sm" style="border: none; background-color: rgba(245, 245, 245, 0.4)">
                <div class="card-body row no-gutters align-items-center justify-content-center">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select A Season</button>
                            <div class="dropdown-menu">
                                @foreach($seasons as $season)
                                    <a class="dropdown-item" href="{{ route('league', $season) }}" >
                                        {{ $season->title }}
                                    </a>
                                @endforeach
                            </div>
                </div>
            </form>
        </div>

    </div>
    <league-table id="{{ request('id') ? request('id') : null }}"></league-table>
</div>
@endsection
