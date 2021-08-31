<div class="main-top">
  <div class="main-top-title">
    Lựa chọn kênh thông báo
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Lựa chọn kênh thông tin mà bạn muốn hệ thống thông báo</p>
      <p class="text-info">
        <span>+ Chúng tôi khuyên bạn nên chọn gửi thông báo từ cả số điện thoại và email</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Chúng tôi có thể liên lạc với bạn qua những cách nào</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two required-icon">Lựa chọn cổng thông tin thông báo đến bạn</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Email</span>
          <i class="fas fa-envelope-open-text"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>Số điện thoại</span>
          <i class="fas fa-phone"></i>
        </li>
        <li class="square-item" data-value="3">
          <span>Cả hai</span>
          <i class="fas fa-file-signature"></i>
        </li>
      </ul>
      <input type="hidden" class="portal">
    </div>
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
    if($(".portal").val() == undefined || $(".portal").val() == ""){
      $(".notExistContent").html("Lựa chọn cổng thông tin mà chúng tôi có thể thông báo đến bạn");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "vote1",
              "pagepresent" : "notification1",
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
    var objectToSave = {
      maHS: maHS,
      portal: $(".portal").val(),
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "tag1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })
  
  $(".timeline-five").removeClass("active");
  if(!$(".timeline-five").hasClass("done")){
    $(".timeline-five").addClass("done");
  }
  $(".timeline-six").removeClass("done");
  if(!$(".timeline-six").hasClass("active")){
    $(".timeline-six").addClass("active");
  }
</script>