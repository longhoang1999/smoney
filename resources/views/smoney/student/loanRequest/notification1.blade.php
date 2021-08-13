<div class="main-top">
  <div class="main-top-title">Lựa chọn kênh thông báo</div>
  <span class="main-nottop-title-detail">Chúng tôi có thể liên lạc với bạn qua những cách nào</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Lựa chọn cổng thông tin mà chúng tôi có thể thông báo đến bạn</div>
    <div class="block-square">
      <ul>
        <li class="square-item square-select">
          <span>Email</span>
          <i class="fas fa-envelope-open-text"></i>
        </li>
        <li class="square-item">
          <span>Số điện thoại</span>
          <i class="fas fa-phone"></i>
        </li>
        <li class="square-item">
          <span>Cả hai</span>
          <i class="fas fa-file-signature"></i>
        </li>
      </ul>
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
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "vote1"},
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
        data:{"page": "tag1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
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