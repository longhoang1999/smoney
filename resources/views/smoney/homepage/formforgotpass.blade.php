<div>
	<p style="font-weight: bold;">Hệ thống nhận được yêu cầu 
		<span style="color: #0300e0;font-weight: bold;">"thay đổi mật khẩu" </span>
	tài khoản <span style="color: #0300e0;font-weight: bold;">"{{ $phone }}"</span> từ bạn:</p>

	<p>Bạn hãy <span style="color: #0300e0;font-weight: bold;">" click "</span> vào nút dưới đây để tiến hành lấy lại mật khẩu tài khoản: </p>

	<a href="{{ route('student.forgotPass',[$phone,$key]) }}" target="_blank" style="display: block;text-decoration: none;padding: 7px 4px;background: #4083ff;width: 5.5rem;text-align: center;border-radius: 5px;font-weight: 500;color: white;">Click here</a>

	<p style="text-transform: uppercase;font-weight: bold;color: red;" 
	class="text-uppercase font-weight-bold text-danger">Hãy đảm bảo rằng bạn chính là người thực hiện yêu cầu này</p>
</div>