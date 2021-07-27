<div>
	<p style="color: #0300e0;font-weight: bold;">Hệ thống nhận thấy bạn đã đăng nhập trên một thiết bị mới
	</p>

	<p>Nếu bạn là người đăng nhập hãy <span style="color: #0300e0;font-weight: bold;">" click "</span> vào nút dưới đây để tiến hành đăng nhập vào tài khoản của bạn: </p>

	<a href="{{ route('student.successDevice',[$user,$maso,$log_ip_address,$log_device_name,$phone,$password,$checkDeviceCookie]) }}" target="_blank" style="display: block;text-decoration: none;padding: 7px 4px;background: #4083ff;width: 8.5rem;text-align: center;border-radius: 5px;font-weight: 500;color: white;">Xác thực thiết bị</a>


	<p style="text-transform: uppercase;font-weight: bold;color: red;" 
	class="text-uppercase font-weight-bold text-danger">Hãy đảm bảo rằng bạn chính là người thực hiện yêu cầu này</p>
</div>