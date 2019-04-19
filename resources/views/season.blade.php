@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Season</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('season') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="seasons" class="col-md-4 col-form-label text-md-right">Seasons</label>

                                <div class="col-md-6">
                                    <input id="seasons" type="text" class="form-control{{ $errors->has('seasons') ? ' is-invalid' : '' }}" name="seasons" value="{{ old('seasons') }}" required autocomplete="seasons" autofocus>

                                    @if ($errors->has('seasons'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('seasons') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Season
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
