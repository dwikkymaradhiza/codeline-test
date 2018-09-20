<div class="col-md-12">
    <hr>
    <h4>Comments (<span class="comment-count">{{ count($film->comments) }}</span>)</h4>
    <hr>
    <div class="comment-list">
      @if(count($film->comments) > 0)
        @foreach($film->comments as $k => $v)
          <div>
            <strong>{{ $v->user->name }}</strong> <span class="date">{{ $v->created_at->diffForHumans() }}</span>
            <p>{{ $v->comments }}</p>
          </div>
        @endforeach
      @else
        There is no comment.
      @endif
    </div>
</div>
<div class="col-md-12">
    <hr>
    <h4>Your Comment</h4>
    <div class="comment">
      @if (Auth::check())
        <form method="POST" id="comment">
          <div class="form-group">
            <input type="hidden" id="film_id" name="film_id" value="{{ $film->id }}" />
            <textarea class="form-control" id="comment-text" name="comment"></textarea>
          </div>
          <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Comment" />
          </div>
        </form>
      @else
        Please <a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a> if you want to comment in this film.
      @endif
    </div>
  </div>

  @section('styles')
  <!-- Sweet Alert -->
  <link rel="stylesheet" href="{{ asset("/bower_components/bootstrap-sweetalert/dist/sweetalert.css") }}">  
  @endsection

  @section('scripts')
  <!-- Sweet Alert -->
  <script src="{{ asset("/bower_components/bootstrap-sweetalert/dist/sweetalert.js") }}"></script>

  @if(Auth::check())
  <script>
    $("#comment").on('submit', function(e) {
      e.preventDefault();
      if (!$("#comment-text").val()) {
        return swal("Error!", "Comment should not be empty.", "error");
      }

      $.ajax({
        url: '{{ route("films.comment") }}',
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $(this).serialize(),
        success: function (err, status, msg) {
          swal("Success!", "Comment saved.", "success");
          let newComment = `<div>
                              <strong>{{ Auth::user()->name }}</strong> <span class="date">a few second(s) ago</span>
                              <p>${$('#comment-text').val()}</p>
                            </div>`;
                          
          $(newComment).prependTo('.comment-list');
          $('.comment-count').text(parseInt($('.comment-count').text(), 0) + 1);
        },
        error: function (err, status, msg) {
          swal("Error!", "An error has occured! Please try again later.", "error");
        }
      });
    });
  </script>
  @endif
@endsection