@extends('admin.layouts.sidebar')

@section('ttl', 'Profile - Edit')

@section('page_name', 'Profile')
@section('bread')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('dashboard.dashboard') }}">Profile</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

    <x-alert type="success" />

    <form class="p-4 m-4 border rounded-md" method="post" action="{{ route('dashboard.profile.update') }}"
        enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" value="{{ $user->profile->first_name }}" label="First name" />
            </div>
            <div class="col-md-6">
                <x-form.input name="last_name" value="{{ $user->profile->last_name }}" label="Last name" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="birthday" value="{{ $user->profile->birthday }}" label="Birthday" type="date" />
            </div>
            <div class="col-md-6">
                <x-form.radio name="gender" checked="{{ $user->profile->gender }}" :options="[
                    'male' => 'male',
                    'disfemaleactive' => 'female',
                ]" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <x-form.input name="street" value="{{ $user->profile->street }}" label="Street" />
            </div>
            <div class="col-md-4">
                <x-form.input name="city" value="{{ $user->profile->city }}" label="city" />
            </div>
            <div class="col-md-4">
                <x-form.input name="state" value="{{ $user->profile->state }}" label="state" />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <x-form.input name="postal_code" value="{{ $user->profile->postal_code }}" label="postal_code" />
            </div>
            <div class="col-md-4">
                <x-form.select name="country" :options="$countries" selected="{{ $user->profile->country }}" label="country" />
            </div>
            <div class="col-md-4">
                <x-form.select name="local" :options="$locals" selected="{{ $user->profile->local }}" label="local" />
            </div>
        </div>
        <div class="form-group">

            <button type="submit" class="btn w-full btn-outline-primary">Update</button>
        </div>
    </form>

@endsection
