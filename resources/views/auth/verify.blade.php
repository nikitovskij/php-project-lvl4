@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('interface.form.verify-request') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('interface.form.verification-link') }}
                        </div>
                    @endif

                    {{ __('interface.form.before-proceeding') }}
                    {{ __('interface.form.not-verification-email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('interface.form.request-new-email') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
