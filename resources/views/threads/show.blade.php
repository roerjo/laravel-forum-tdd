@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <a href="#">{{ $thread->creator->name }}</a> posted::
          {{ $thread->title }}
        </div>
        <div class="panel-body">
          <article>
            <div class="body">
              {{ $thread->body }}
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      @foreach ($thread->replies as $reply)

        @include('threads.reply')

      @endforeach

    </div>
  </div>

  @if (auth()->check())
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <form method="POST" action="/threads/{{ $thread->id }}/replies">
          {{ csrf_field() }}
          <div class="form-group">
            <textarea name="body" id="body" class="form-control" placeholder="Add a reply..." rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  @endif
</div>
@endsection
