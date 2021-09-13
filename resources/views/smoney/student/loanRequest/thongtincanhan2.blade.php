<div class="main-top">
  <div class="main-top-title">
    Thông tin cá nhân
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền thông tin cá nhân của bạn.</p>
      <p>Thông tin cá nhân tiếp theo là:</p>
      <p class="text-info">
        <span>+ Email chính của bạn (email này được dùng để gửi các thông báo đến bạn)</span>
        <span>+ Giới tính của bạn</span>
        <span>+ Thông tin tài khoản: Hệ thống yêu cầu cung cấp số thẻ ATP của bạn</span>
              <span class="text-block ml-3 text-primary">Hãy nhập dưới dạng sau: Số tài khoản - Tên ngân hàng - Chi nhánh mở tài khoản</span>    
              <span class="text-block ml-3 text-primary">Ví dụ: 0123456789 - Agribank - Chi nhánh Đông Hà Nội</span>        
        <span>+ Số điện thoại khác (nếu có): Nếu bạn sử dụng nhiều số điện thoại ngoài số điện thoại chính, hãy điền vào đây</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Điền các thông tin cá nhân của bạn</span>
  <div class="block-question" style="margin-bottom: 4rem;">
    <!--question  -->
    <div class="question question-one required-icon">Email</div>
    <!-- <span class="main-top-title-detail">Email chính của bạn</span> -->
    <input type="email" class="email input-text mt-1" placeholder="Nhập email" value="{{ $email }}">
    <!-- /question -->

    <!--question  -->
    <div class="question question-two required-icon">Giới tính</div>
    <span class="main-top-title-detail"></span>
    <select class="select color-gray">
      <option hidden="">--Giới tính</option>
      <option value="Nam" 
        @if($gioitinh == "Nam")
          selected="" 
        @endif
      >Nam</option>
      <option value="Nữ" 
        @if($gioitinh == "Nữ")
          selected="" 
        @endif
      >Nữ</option>
      <option value="Khác" 
        @if($gioitinh == "Khác")
          selected="" 
        @endif
      >Khác</option>
    </select>
    <!-- /question -->

    <!--question  -->
    <div class="question question-three required-icon">Nhập thông tin tài khoản của bạn</div>
    <!-- <span class="main-top-title-detail">Hãy nhập dưới dạng sau: Số tài khoản - Tên ngân hàng - Chi nhánh mở tài khoản</span>
    <br>
    <span class="main-top-title-detail">Ví dụ: 0123456789 - Agribank - Chi nhánh Đông Hà Nội</span> -->

    <div class="multi-input multi-account-number">
      <input type="text" class="first-acc input-text mt-1" placeholder="Nhập thông tin tài khoản">
    </div>
    <div class="btn-plus btn-plus-account-number">
      <span>Thêm mới</span>
      <i class="fas fa-plus"></i>
    </div>
    <!-- /question -->

    <!--question  -->
    <div class="question question-three">Số điện thoại khác(nếu có)</div>
    <!-- <span class="main-top-title-detail">Nếu bạn sử dụng nhiều số điện thoại ngoài số điện thoại chính, hãy điền vào đây</span> -->

    <div class="multi-input multi-other-phone">
      <input type="text" class="input-text mt-1 first-phone" placeholder="Nhập số điện thoại" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
    </div>
    <div class="btn-plus btn-plus-other-phone">
      <span>Thêm mới</span>
      <i class="fas fa-plus"></i>
    </div>
    <!-- /question -->
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
    if($(".email").val() == undefined || $(".email").val() == ""){
      $(".notExistContent").html("Email");
      $("#modalNotExist").modal("show");
    }else if($(".select").val() == undefined || $(".select").val() == ""){
      $(".notExistContent").html("Giới tính");
      $("#modalNotExist").modal("show");
    }else if($(".first-acc").val() == undefined || $(".first-acc").val() == ""){
      $(".notExistContent").html("Thông tin tài khoản");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "thongtincuchu1",
              "pagepresent" : "thongtincanhan2",
              "data" : createObject()
          },
          success:function(data)
          {
            $(".main").empty();
            $(".main").append(data[1]);
          }
      });
      scrollToMain();
    }
  })
  function createObject(){
    var var1 = $(".email").val();
    var var2 = $(".select").val();
    let arStk = [];
    let otherStkAll = document.querySelectorAll(".multi-account-number input")
    otherStkAll.forEach((item, index)=>{
       arStk.push(item.value) 
    })
    let arPhone = [];
    let otherPhoneAll = document.querySelectorAll(".multi-other-phone input")
    otherPhoneAll.forEach((item, index)=>{
       arPhone.push(item.value) 
    })
    var objectToSave = {
      maHS: maHS,
      email : var1,
      gender : var2,
      stk : arStk,
      otherPhone : arPhone,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "thongtincanhan1",
            "maHS" : maHS
        },
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[0]);
          // call hàm ở trang trước
          fillData(data[1]);
        }
    });
    scrollToMain();
  })
  // 
  $(".btn-plus-account-number").click(function() {
    if($(".first-acc").val() == undefined || $(".first-acc").val() == ""){
      alert("Hãy nhập trường đầu tiên");
    }else{
      $(".multi-account-number").append('<input type="text" class="input-text mt-1" placeholder="Nhập thêm thông tin tài khoản">');
    }
  })
  $(".btn-plus-other-phone").click(function() {
    if($(".first-phone").val() == undefined || $(".first-phone").val() == ""){
      alert("Hãy nhập trường đầu tiên");
    }else{
      $(".multi-other-phone").append(`<input type="text" class="input-text mt-1" placeholder="Nhập thêm điện thoại" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\\..*?)\\..*/g, '$1');">`);
    }
  })
  
  function fillData(data){
    $(".email").val(data['hsk_email']);
    $(".select").val(data['hsk_gender']);
    // check mảng null toàn bộ
    var otherThanNull = data['hsk_stk'].some(function (el) {
        return el !== null;
    });
    if(otherThanNull){
      $(".multi-account-number").empty();
      data['hsk_stk'].forEach(function(item, index){
        if(item !=  null){
          
          $(".multi-account-number").append(`<input type="text" class="input-text mt-1" placeholder="Nhập thông tin tài khoản" value="${item}">`);
        }
      })
    }

    // check mảng null toàn bộ
    var otherThanNull = data['hsk_otherPhone'].some(function (el) {
        return el !== null;
    });
    if(otherThanNull){
      $(".multi-other-phone").empty();
      data['hsk_otherPhone'].forEach(function(item, index){
        if(item !=  null){
          $(".multi-other-phone").append(`<input value="${item}" type="text" class="input-text mt-1" placeholder="Nhập số điện thoại" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\\..*?)\\..*/g, '$1');">`);
        }
      })
    }
    
  }
</script>