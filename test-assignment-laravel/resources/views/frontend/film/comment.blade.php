<div class="col-md-12">
    <h4>Comments</h4>
    <div class="comments">
      @if (Auth::check())
        <form method="POST" action="">
          <div class="form-group">
            <textarea class="form-control" name="comment"></textarea>
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