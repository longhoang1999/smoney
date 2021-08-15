<div class="main-top">
  <div class="main-top-title">Thông tin về việc làm của bạn</div>
  <span class="main-nottop-title-detail">Điền các thông tin cơ bản về việc làm hiện tại của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Thời gian bạn làm việc</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Fulltime</span>
          <i class="fas fa-briefcase"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>Partime</span>
          <i class="fas fa-home"></i>
        </li>
        <li class="square-item" data-value="3">
          <span>Fieldtrip</span>
          <i class="fas fa-building"></i>
        </li>
      </ul>
      <input type="hidden" class="time-work">
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
            "page": "vieclam3",
            "pagepresent" : "vieclam2",
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
    var timeWork = $(".time-work").val();
    var objectToSave = {
      maHS: maHS,
      timeWork: timeWork,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "vieclam1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  
</script>