<x-front-layout title="Two Factor Auth">

    <x-slot name="breadcrumb">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Two Factor Auth</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li>Two Factor Auth</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    @auth
                        <form class="card login-form" action="{{ route('two-factor.enable') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="title">
                                    <h3>Two Factor Auth</h3>
                                    <p>You can enable/disable 2FA.</p>
                                </div>
                                @if (session('status') == 'two-factor-authentication-enabled')
                                    <div class="mb-4 font-medium text-sm">
                                        Please finish the configuration of 2fa.
                                    </div>
                                @endif
                                <div class="button">
                                    @if (!$user->two_factor_secret)
                                        <button class="btn" type="submit">Enable</button>
                                    @else
                                        <div class="mb-4 text-center">
                                            {!! $user->twoFactorQrCodeSvg() !!}
                                        </div>
                                        <div class="p-4">
                                            <h3>Recovery Codes</h3>
                                            <ul>
                                                @foreach ($user->recoveryCodes() as $code)
                                                    <li>{{ $code }}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        @method('delete')
                                        <button class="btn" type="submit">Disable</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    @endauth
                    @guest
                        <div class="card border-primary p-4 text-center font-bold">
                            <p>
                                Please Login first!!
                            </p>
                            <a href="{{ route('login') }}">Login</a>
                        </div>

                    @endguest
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
