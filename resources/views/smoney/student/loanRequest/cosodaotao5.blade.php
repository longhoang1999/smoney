<?php 
  use App\Models\SmoneyModels\NhaTruong;
  use App\Models\SmoneyModels\Student;
  $userLogin = Auth::user();
  $findStudent = Student::where("_id",$userLogin->tks_sotk)->first();
  $inforUniArr = array();
  $uniAr = array();
  if($findStudent->university != null){
      $university = $findStudent->university;
      $uniAr = array_keys($university);

      $index = 1;
      foreach($uniAr as $value){
          $findNhaTruong = NhaTruong::where("nt_id",$value)->first();
          $newArr = array("id" => $findNhaTruong->nt_id,
                          "name" => $findNhaTruong->nt_ten
          );
          array_push($inforUniArr, $newArr);
      } 
  }
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
        @foreach($inforUniArr as $uni)
          <li class="square-item" data-value="{{ $uni['id'] }}">
            <span>{{ $uni['name'] }}</span>
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
              "page": "cosodaotao4",
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
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "thongtinkhoanvay1",
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

  function fillData(data){
    // chooseSchool
    $(".choose-school").val(data['chooseSchool']);
    $(".choose-school").parent().find(`li.square-item[data-value=${data['chooseSchool']}]`).addClass("square-select");
  }

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