<x-front-layout title="Profile">

    <x-slot name="breadcrumb">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Products</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('products') }}"><i class="lni lni-grid"></i> Products</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a name="" id="" style="background-color: var(--border-color); color: var(--black-color)!important; font-weight: 700" class="btn mt-5 p-4 mx-4 d-block h-24"
                href="{{ route('front.2fa') }}" role="button">2-step
                verification</a>
            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</x-front-layout>
