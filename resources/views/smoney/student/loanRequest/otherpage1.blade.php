<div class="main-top">
  <div class="main-top-title">Một số giấy tờ khác (nếu có)</div>
  <span class="main-nottop-title-detail">Nếu bạn có các giấy tờ như giấy khám sức khỏe, chứng nhận đã tham gia các cuộc thi, chứng nhận tham gia NCKH,... có thể điền vào để tăng khả năng vay thành công</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">1. Giấy khám sức khỏe</div>
    <div class="block-input-file">
        <div class="open-input-file">Tải File đính kèm</div>
    </div>
    <div class="question question-two">2. Giấy chứng nhận tham gia NCKH</div>
    <div class="block-input-file">
        <div class="open-input-file">Tải File đính kèm</div>
    </div>
    <!-- /question -->
    <button class="btn btn-sm btn-info mt-3">Thêm một giấy tờ mới</button>
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
        data:{"page": "tag1"},
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
        data:{"page": "option4"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  
</script>