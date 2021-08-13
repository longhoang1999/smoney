<div class="main-top">
  <div class="main-top-title">Bạn có đóng góp ý kiến gì không?</div>
  <span class="main-nottop-title-detail">Chúng tôi muốn lắng nghe ý kiến và đánh giá của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Ý kiến của bạn</div>
    <textarea class="input-text hight-200" placeholder="Nhập ý kiến của bạn"></textarea>

    <div class="question question-two">Đánh giá của bạn</div>
    <div>
      <i class="fas fa-star text-warning"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
      <i class="fas fa-star"></i>
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
        data:{"page": "confirm1"},
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
        data:{"page": "notification1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
</script>