@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        {{ __('Website List') }}

                        <a href="{{ route('setting.website.add') }}" class="btn btn-sm btn-success" style="float: right">Add New Website</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>Title</td>
                                <td>Url</td>
                                <td>Username</td>
                                <td>Created At</td>
                                <td>Action</td>
                            </tr>
                            @foreach($all_sites as $website)
                                <tr>
                                    <td>{{ $website->site_title }}</td>
                                    <td>{{ $website->site_url }}</td>
                                    <td>{{ $website->wordpress_username }}</td>
                                    <td>{{ date('F d, Y, H:i A') }}</td>
                                    <td>
                                        <a href="{{ route('setting.website.edit', $website->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
