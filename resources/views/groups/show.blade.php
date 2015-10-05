@extends('app')

@section('content')


@include('partials.group')

    <h2>{{ $group->name }}</h2>

<p>
            {{ $group->body }}
</p>

<h2>Latest discussions in this group</h2>
@foreach ($discussions as $discussion)

<li>{{ $discussion->name }}</li>

@endforeach

<a class="btn btn-primary" href="{{ route('discussion.create', ['group_id' => $group->id] ) }}">New discussion</a>



<h2>Latest files in this group</h2>
@foreach ($files as $file)

<li>{{ $file->name }}</li>

@endforeach



@endsection