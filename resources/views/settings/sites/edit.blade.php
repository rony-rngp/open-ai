@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        {{ __('Edit Website') }}
                        <a href="{{ route('setting.index') }}" class="btn btn-sm btn-success" style="float: right">Back</a>
                    </div>

                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('setting.website.update', $website->id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label class="mb-2" for="site_title">Site Title <i class="text-danger">*</i></label>
                                    <input type="text" required name="site_title" value="{{ $website->site_title }}" id="site_title" class="form-control">
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label class="mb-2" for="site_url">Site Url (domainname only domain.com) <i class="text-danger">*</i></label>
                                    <input type="text" required name="site_url" value="{{ $website->site_url }}" id="site_url" class="form-control">
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label class="mb-2" for="wordpress_username">Wordpress Username <i class="text-danger">*</i></label>
                                    <input type="text" required name="wordpress_username" value="{{ $website->wordpress_username }}" id="wordpress_username" class="form-control">
                                </div>

                                <div class="col-md-6 form-group mb-3">
                                    <label class="mb-2" for="wordpress_password">Wordpress Password <i class="text-danger">*</i></label>
                                    <input type="text" required name="wordpress_password" value="{{ $website->wordpress_password }}" id="wordpress_password" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-primary " style="float: right" type="submit">Update</button>
                                </div>

                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
