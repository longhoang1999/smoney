<?php 
  use App\Models\SmoneyModels\NhaTruong;
  $findUni = NhaTruong::whereIn("nt_id",$uniAr)->get();
 ?>
<div class="main-top">
  <div class="main-top-title">
    Thông tin về cơ sở đào tạo của bạn
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền thông tin về trường mà bạn theo học (tiếp theo).</p>
      <p>Những thông tin này sẽ là cơ sở để trường xác minh bạn là sinh viên của nhà trường</p>
      <p class="text-info">
        <span>+ Chọn trường nơi gửi hồ sơ của bạn. Nếu bạn muốn nộp học phí cho trường nào hãy chọn nơi gửi hồ sơ khoản vay về trường đó</span>
        <span>+ Sau khi trường bạn xác nhận thông tin của bạn là đúng bạn mới có thể vay</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Điền các thông tin về các trường đại học, cao đẳng,... mà bạn đang theo học</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two ">Chọn trường nơi gửi hồ sơ của bạn</div>
    <span class="main-top-title-detail required-icon">Nếu bạn muốn nộp học phí cho trường nào hãy chọn nơi gửi hồ sơ khoản vay về trường đó</span>

    <!--question  -->
    <div class="block-square">
      <ul>
        @foreach($findUni as $uni)
          <li class="square-item" data-value="{{ $uni->nt_id }}">
            <span>{{ $uni->nt_ten }}</span>
            <i class="fas fa-university"></i>
          </li>
        @endforeach
      </ul>
      <input type="hidden" class="choose-school">
    </div>
    <!-- /question -->

    <div class="container-fuild block-show-img mt-3">
      <div class="row">
        <!-- append here -->
      </div>
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
    if($(".choose-school").val() == undefined || $(".choose-school").val() == ""){
      $(".notExistContent").html("Chọn trường nơi gửi hồ sơ của bạn");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "vieclam1",
              "pagepresent" : "cosodaotao5",
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
    var chooseSchool = $(".choose-school").val();
    var objectToSave = {
      maHS: maHS,
      chooseSchool: chooseSchool,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "cosodaotao3"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })

  $(".timeline-two").removeClass("active");
  if(!$(".timeline-two").hasClass("done")){
    $(".timeline-two").addClass("done");
  }
  $(".timeline-three").removeClass("done");
  if(!$(".timeline-three").hasClass("active")){
    $(".timeline-three").addClass("active");
  }
  $(".timeline-four").removeClass("active");
  $(".timeline-four").removeClass("done");
</script>