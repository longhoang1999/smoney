<div>
	<p>
		<span>Chúng tôi nhận được yêu cầu vay của bạn từ ngân hàng </span>
		<span style="font-weight: bold;">"{{ $nameBank }}"</span>
	</p>
	<p>
		<span>Số tiền vay: </span>
		<span style="font-weight: bold;">{{ $money }} VNĐ</span>
	</p>
	<p>
		<span>Lãi xuất vay:</span> 
		<span style="font-weight: bold;">{{ $interestRate }} % / tháng</span>
    </p>
	<p>
		<span>Kỳ hạn:</span>
	    <span style="font-weight: bold;"> {{ $loanMonth }} tháng</span>
    </p>
	<p>
		<span>Đây là mã code để bạn xác nhận khoản vay</span>
		<span style="color: red;">
			{{ $code }}
		</span>
	</p>
	<p style="color: red; font-style: italic; font-weight: bold">Vui lòng không chia sẽ mã này cho bất kì ai</p>
</div>