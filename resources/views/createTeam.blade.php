@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Enter Team For {{ $season->title }} Season </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('team', $season) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Club 1</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control{{ $errors->has('seasons') ? ' is-invalid' : '' }}" name="Club[]" value="{{ old('seasons') }}" required autocomplete="seasons" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Club 2</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control{{ $errors->has('seasons') ? ' is-invalid' : '' }}" name="Club[]" value="{{ old('seasons') }}" required autocomplete="seasons" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Club 3</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control{{ $errors->has('seasons') ? ' is-invalid' : '' }}" name="Club[]" value="{{ old('seasons') }}" required autocomplete="seasons" autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Club 4</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control{{ $errors->has('seasons') ? ' is-invalid' : '' }}" name="Club[]" value="{{ old('seasons') }}" required autocomplete="seasons" autofocus>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Team
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
