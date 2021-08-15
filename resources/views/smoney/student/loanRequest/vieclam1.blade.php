<div class="main-top">
  <div class="main-top-title">Thông tin về việc làm của bạn</div>
  <span class="main-nottop-title-detail">Điền các thông tin cơ bản về việc làm hiện tại của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Tình trạng việc làm của bạn</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Đang làm thuê</span>
          <i class="fas fa-briefcase"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>Không đi làm</span>
          <i class="fas fa-home"></i>
        </li>
        <li class="square-item" data-value="3">
          <span>Tự kinh doanh</span>
          <i class="fas fa-building"></i>
        </li>
      </ul>
      <input type="hidden" class="employment-status">
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
            "page": "vieclam2",
            "pagepresent" : "vieclam1",
            "data" : createObject()
        },
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  function createObject(){
    var employmentStatus = $(".employment-status").val();
    var objectToSave = {
      maHS: maHS,
      employmentStatus: employmentStatus,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "cosodaotao4"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  
  $(".timeline-three").removeClass("active");
  if(!$(".timeline-three").hasClass("done")){
    $(".timeline-three").addClass("done");
  }
  $(".timeline-four").removeClass("done");
  if(!$(".timeline-four").hasClass("active")){
    $(".timeline-four").addClass("active");
  }
  $(".timeline-five").removeClass("active");
  $(".timeline-five").removeClass("done");
  
</script>