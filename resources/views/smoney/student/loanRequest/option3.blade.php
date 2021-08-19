<div class="main-top">
  <div class="main-top-title">
    Một số options có thể làm tăng khả năng bạn được cho vay
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền một số tùy chọn có thể làm tăng khả năng vay thành công của bạn</p>
      <p class="text-info">
        <span>+ Nếu bạn có thông tin về người bảo trợ bạn có thể khai báo ở đây</span>
        <span>Lưu ý: Người bảo trợ có thể là bố, mẹ, người thân ruột thịt,..</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Nếu bạn có người bảo trợ hoặc bạn tham gia các hoạt động đoàn thể ở trường,... hãy điền vào phần dưới. Ví dụ: đoàn thanh niên, câu lạc bộ sinh viên</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Bạn có người bảo trợ không</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Có</span>
          <i class="fas fa-smile-wink"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>Không</span>
          <i class="fas fa-smile-beam"></i>
        </li>
      </ul>
      <input type="hidden" class="your-parents">
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
        data:{
            "page": "option4",
            "pagepresent" : "option3",
            "data" : createObject()
        },
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })

  function createObject(){
    var yourParents = $(".your-parents").val();
    var objectToSave = {
      maHS: maHS,
      yourParents: yourParents,
    }
    return objectToSave;
  }
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
    scrollToMain();
  })
</script>