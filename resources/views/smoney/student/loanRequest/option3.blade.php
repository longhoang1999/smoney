<div class="main-top">
  <div class="main-top-title">Một số options có thể làm tăng khả năng bạn được cho vay</div>
  <span class="main-nottop-title-detail">Nếu bạn có người bảo trợ hoặc bạn tham gia các hoạt động đoàn thể ở trường,... hãy điền vào phần dưới. Ví dụ: đoàn thanh niên, câu lạc bộ sinh viên</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Bạn có người bảo trợ không</div>
    <div class="block-square">
      <ul>
        <li class="square-item square-select">
          <span>Có</span>
          <i class="fas fa-smile-wink"></i>
        </li>
        <li class="square-item">
          <span>Không</span>
          <i class="fas fa-smile-beam"></i>
        </li>
      </ul>
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

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "option2"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
</script>