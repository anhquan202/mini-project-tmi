@extends('welcome')
@section('content')
  <form id="form-login">
    @csrf
    <div class="form-group">
      <label for="">Username</label>
      <input type="text" placeholder="Username" name="username">
      <span class="error error-username"></span>
    </div>
    <div class="form-group">
      <label for="">Pasword</label>
      <input type="password" placeholder="password" name="password">
      <span class="error error-password"></span>

    </div>
    <button class="btn-access">Đăng nhập</button>
  </form>
@endsection
@section('script')
  <script>
    $(function() {
      $('#form-login').on('submit', function(e) {
        e.preventDefault();
        $('.error-username, .error-password').text('');
        const username = $('input[name="username"]').val();
        const password = $('input[name="password"]').val();

        $.ajax({
          method: "post",
          url: "api/login",
          contentType: "application/json",
          data: JSON.stringify({
            username: username,
            password: password
          }),
          success: function(response) {
            console.log(response.data);
            localStorage.setItem('auth_token', JSON.stringify(response.data?.token))
            localStorage.setItem('user', JSON.stringify(response.data?.user))
            alert('Đăng nhập thành công')
            window.location.href = 'http://127.0.0.1:8000/home'
          },
          error: function(error) {
            $('.error-username').text(error.responseJSON?.errors.username)
            $('.error-password').text(error.responseJSON?.errors.password)
          }
        });

      });
    })
  </script>
@endsection
