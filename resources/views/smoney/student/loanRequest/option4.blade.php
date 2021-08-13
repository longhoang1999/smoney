<div class="main-top">
  <div class="main-top-title">Một số options có thể làm tăng khả năng bạn được cho vay</div>
  <span class="main-nottop-title-detail">Nếu bạn có người bảo trợ hoặc bạn tham gia các hoạt động đoàn thể ở trường,... hãy điền vào phần dưới. Ví dụ: đoàn thanh niên, câu lạc bộ sinh viên</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Nhập thông tin người bảo trợ</div>
    <span class="main-top-title-detail required-icon">1. Họ và tên: </span><br>
    <input type="text" class="input-text mt-1" placeholder="Nhập họ và tên">
    <br><span class="main-top-title-detail required-icon">2. Số điện thoại: </span><br>
    <input type="text" class="input-text mt-1" placeholder="Nhập số điện thoại">
    <br><span class="main-top-title-detail required-icon">3. Số căn cước công dân: </span><br>
    <input type="text" class="input-text mt-1" placeholder="Nhập số căn cước công dân">
    <br><span class="main-top-title-detail required-icon">4. Giới tính: </span><br>
    <select name="" class="select color-gray">
      <option hidden="">--Giới tính</option>
      <option>Nam</option>
      <option>Nữ</option>
      <option>Khác</option>
    </select>
    <br><span class="main-top-title-detail">
      5. Số tài khoản: 
      <small>Ví dụ: 0123456789 - Agribank - Chi nhánh Đông Hà Nội</small>
    </span><br>
    <input type="text" class="input-text mt-1" placeholder="Nhập số tài khoản">
    <br><span class="main-top-title-detail required-icon">6. Quan hệ với sinh viên: </span><br>
    <input type="text" class="input-text mt-1" placeholder="Nhập quan hệ với sinh viên">

    <!-- /question -->
    <button class="btn btn-sm btn-info mt-3">Thêm một người bảo trợ</button>
  </div>
</div>
<hr>
<div class="main-bottom">
  <div class="btn-back main-bottom-item">
    Quay lại
    <i class="fas fa-long-arrow-alt-left"></i>
  </div>
  <div class="btn-next main-bottom-item">
    Tiếp theo
    <i class="fas fa-long-arrow-alt-right"></i>
  </div>
</div>


<script type="text/javascript">
  $(".btn-next").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "otherpage1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "option3"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
</script>