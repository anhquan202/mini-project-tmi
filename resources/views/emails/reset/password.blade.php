<x-mail::message>
  # Đặt lại mật khẩu

  Chào bạn,

  Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của mình. Vui lòng sử dụng mã xác nhận dưới đây:

  <x-mail::panel>
    <h2 style="text-align: center; font-size: 32px; font-weight: bold; color: #3490dc; letter-spacing: 3px;">
      {{ $resetCode }}
    </h2>
  </x-mail::panel>

  **Lưu ý quan trọng:**
  - Mã này có hiệu lực trong vòng 15 phút
  - Vui lòng không chia sẻ mã này với bất kỳ ai
  - Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng bỏ qua email này

  Cảm ơn bạn,<br>
  {{ config('app.name') }}
</x-mail::message>
