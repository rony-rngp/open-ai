@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create a new post') }}</div>

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

                            <form action="{{ route('post.store') }}" method="post">
                                @csrf
                                <div class="col-md-12 form-group">
                                    <label class="mb-2" for="keyword">Keywords <i class="text-danger">*</i></label>
                                    <textarea name="keyword" required rows="3" id="keyword" class="form-control" placeholder="Write keyword"></textarea>
                                </div>

                                <div class="col-md-12 form-group mt-3">
                                    <label class="mb-2" for="website_id">Select Website <i class="text-danger">*</i></label>
                                    <select name="website_id" id="website_id" class="form-control" required>
                                        <option value="">Select One</option>
                                        @foreach($websites as $website)
                                        <option value="{{ $website->id }}">{{ $website->site_title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button class="btn btn-primary " style="float: right" type="submit">Write Article</button>
                                </div>

                            </form>
                    </div>
                </div>
                <br>

                @if($pending_count > 0)
                <p>Your task is running state. This page will automatically refresh in every 30 seconds to see the update state.</p>
                @endif

                <table class="table table-bordered">
                    <tr>
                        <th>Website</th>
                        <th>Keyword</th>
                        <th>Status</th>
                    </tr>
                    @foreach($post_list as $post)
                        <tr>
                            <td>{{ @$post->website->site_title }}</td>
                            <td>{{ $post->keyword }}</td>
                            <td>
                                @if($post->status == 'Pending')
                                    <p class="badge bg-primary">Pending</p>
                                @elseif($post->status == 'Success')
                                    <p class="badge bg-success">Success</p>
                                @else
                                    <p class="badge bg-danger">Failed</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
    <script>
        @if($pending_count > 0)
        setTimeout(function(){
            window.location.reload(1);
        }, 30000);
        @endif
    </script>
@endsection
