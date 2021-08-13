<div class="main-top">
  <div class="main-top-title">Thông tin cá nhân</div>
  <span class="main-nottop-title-detail">Điền các thông tin cá nhân của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-one required-icon">Họ tên đầy đủ</div>
    <div class="range">
      <span class="main-top-title-detail">Họ tên trong giấy khai sinh của bạn</span>
      <input type="text" class="input-text mt-1 fullname" placeholder="Nhập họ và tên"
      value="{{ $name }}">
    </div>
    <!-- /question -->

    <!--question  -->
    <div class="question question-two required-icon">Số điện thoại</div>
    <div class="range">
      <span class="main-top-title-detail">Số điện thoại chính của bạn</span>
      <input type="text" class="input-text mt-1 phone" placeholder="Nhập số điện thoại" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{ $sdt }}">
    </div>
    <!-- /question -->

    <!--question  -->
    <div class="question question-three required-icon">Số căn cước công dân</div>
    <div class="range">
      <span class="main-top-title-detail">Số căn cước công dân bạn đang dùng</span>
      <input type="text" class="input-text mt-1 cccd" placeholder="Nhập số căn cước công dân" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="{{ $cccd }}">
    </div>
    <!-- /question -->

    <!--question  -->
    <div class="question question-three required-icon">Ngày tháng năm sinh</div>
    <div class="range">
      <span class="main-top-title-detail">Ngày tháng năm sinh trong giấy khai sinh của bạn</span>
      <input type="date" class="input-text mt-1 color-gray birthday" value="{{ $ngaysinh }}">
    </div>
    <!-- /question -->
  </div>
</div>

<div class="block-end">
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
</div>
<script type="text/javascript">
  $(".btn-next").click(function() {
    if($(".fullname").val() == undefined || $(".fullname").val() == ""){
      $(".notExistContent").html("Họ và tên");
      $("#modalNotExist").modal("show");
    }else if($(".phone").val() == undefined || $(".phone").val() == ""){
      $(".notExistContent").html("Số điện thoại");
      $("#modalNotExist").modal("show");
    }else if($(".cccd").val() == undefined || $(".cccd").val() == ""){
      $(".notExistContent").html("Số căn cước công dân");
      $("#modalNotExist").modal("show");
    }else if($(".birthday").val() == undefined || $(".birthday").val() == ""){
      $(".notExistContent").html("Ngày sinh");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
            "page": "thongtincanhan2",
            "pagepresent" : "thongtincanhan1",
            "data" : createObject()
          },
          success:function(data)
          {
            $(".main").empty();
            $(".main").append(data[1]);
          }
      });
    }
  })
  function createObject(){
    var var1 = $(".fullname").val();
    var var2 = $(".phone").val();
    var var3 = $(".cccd").val();
    var var4 = $(".birthday").val();
    var objectToSave = {
      maHS: maHS,
      fullname : var1,
      phone : var2,
      cccd : var3,
      birthday : var4
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "thongtinkhoanvay1"},
        success:function(data)
        {
          maHS = data[0];
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  
  $(".timeline-one").removeClass("active");
  if(!$(".timeline-one").hasClass("done")){
    $(".timeline-one").addClass("done");
  }
  $(".timeline-two").removeClass("done");
  if(!$(".timeline-two").hasClass("active")){
    $(".timeline-two").addClass("active");
  }
  $(".timeline-three").removeClass("active");
  $(".timeline-three").removeClass("done");
  
</script>