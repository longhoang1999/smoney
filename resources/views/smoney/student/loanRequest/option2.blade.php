<div class="main-top">
  <div class="main-top-title">Một số options có thể làm tăng khả năng bạn được cho vay</div>
  <span class="main-nottop-title-detail">Nếu bạn có người bảo trợ hoặc bạn tham gia các hoạt động đoàn thể ở trường,... hãy điền vào phần dưới. Ví dụ: đoàn thanh niên, câu lạc bộ sinh viên</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Điền tên các câu lạc bộ, đoàn thể mà bạn tham gia</div>
    <div class="multi-input multi-account-number">
      <input type="text" class="input-text mt-1" placeholder="Tên câu lạc bộ, đoàn thể">
    </div>
    <div class="btn-plus btn-plus-account-number">
      <i class="fas fa-plus"></i>
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
            "page": "option3",
            "pagepresent" : "option2",
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
    let arNameClub = [];
    let nameClub = document.querySelectorAll(".multi-account-number input")
    nameClub.forEach((item, index)=>{
       arNameClub.push(item.value) 
    })
    var objectToSave = {
      maHS: maHS,
      nameClub: arNameClub,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "option1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })

  
  $(".btn-plus-account-number").click(function() {
    $(".multi-account-number").append('<input type="text" class="input-text mt-1" placeholder="Nhập thêm câu lạc bộ, đoàn thể">');
  })
</script>