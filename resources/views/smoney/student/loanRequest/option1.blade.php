<div class="main-top">
  <div class="main-top-title">
    Một số options có thể làm tăng khả năng bạn được cho vay
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền một số tùy chọn có thể làm tăng khả năng vay thành công của bạn</p>
      <p class="text-info">
        <span>+ Nếu bạn tham gia các hoạt động đoàn thể ở trường,... hãy điền vào phần dưới. Ví dụ: đoàn thanh niên, câu lạc bộ sinh viên</span>
        <span>Lưu ý: Thông tin chỉ có ích tại cơ sở bạn sẽ gửi hồ sơ</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Nếu bạn có người bảo trợ hoặc bạn tham gia các hoạt động đoàn thể ở trường,... hãy điền vào phần dưới. Ví dụ: đoàn thanh niên, câu lạc bộ sinh viên</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two required-icon">Bạn có tham gia câu lạc bộ, đoàn thể nào của trường không</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Có</span>
          <i class="fas fa-users"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>Không</span>
          <i class="fas fa-user"></i>
        </li>
      </ul>
      <input type="hidden" class="club">
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
    if($(".club").val() == undefined || $(".club").val() == ""){
      $(".notExistContent").html("Bạn có tham gia câu lạc bộ, đoàn thể nào của trường không");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "option2",
              "pagepresent" : "option1",
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
    var club = $(".club").val();
    var objectToSave = {
      maHS: maHS,
      club: club,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "vieclam4"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })
  
  $(".timeline-four").removeClass("active");
  if(!$(".timeline-four").hasClass("done")){
    $(".timeline-four").addClass("done");
  }
  $(".timeline-five").removeClass("done");
  if(!$(".timeline-five").hasClass("active")){
    $(".timeline-five").addClass("active");
  }
  $(".timeline-six").removeClass("active");
  $(".timeline-six").removeClass("done");
</script>