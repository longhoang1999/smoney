<div class="main-top">
  <div class="main-top-title">Thông tin về cơ sở đào tạo của bạn</div>
  <span class="main-nottop-title-detail">Điền các thông tin về các trường đại học, cao đẳng,... mà bạn đang theo học</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two required-icon">Bạn học tại bao nhiêu trường</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>1 Trường</span>
          <i class="fas fa-university"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>2 Trường</span>
          <i class="fas fa-university"></i>
        </li>
        <li class="square-item" data-value="3">
          <span>3 Trường</span>
          <i class="fas fa-university"></i>
        </li>
      </ul>
      <input type="hidden" class="number-school">
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
            "page": "cosodaotao2",
            "pagepresent" : "cosodaotao1",
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
    var numberSchool = $(".number-school").val();
    var objectToSave = {
      maHS: maHS,
      numberSchool: numberSchool,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "thongtincuchu3"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  
  $(".timeline-two").removeClass("active");
  if(!$(".timeline-two").hasClass("done")){
    $(".timeline-two").addClass("done");
  }
  $(".timeline-three").removeClass("done");
  if(!$(".timeline-three").hasClass("active")){
    $(".timeline-three").addClass("active");
  }
  $(".timeline-four").removeClass("active");
  $(".timeline-four").removeClass("done");
  
</script>