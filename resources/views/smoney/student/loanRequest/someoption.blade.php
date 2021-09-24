<div class="main-top">
  <div class="main-top-title">
    Một số options có thể làm tăng khả năng bạn được cho vay
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền một số tùy chọn có thể làm tăng khả năng vay thành công của bạn</p>
      <p class="text-info">
       
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Nếu bạn cung cấp cho chúng tôi thêm một số thông tin về bạn.Điều đó có thể làm tăng khả năng được vay thành công của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two required-icon">Bạn có muốn khai báo thêm một số tùy chọn không?</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Có</span>
          <i class="fas fa-check"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>Không</span>
          <i class="fas fa-times"></i>
        </li>
      </ul>
      <input type="hidden" class="option">
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
    if($(".option").val() == undefined || $(".option").val() == ""){
      $(".notExistContent").html("Bạn có tham gia câu lạc bộ, đoàn thể nào của trường không");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "option1",
              "pagepresent" : "someoption",
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
    var option = $(".option").val();
    var objectToSave = {
      maHS: maHS,
      option: option,
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "cosodaotao4",
            "maHS" : maHS
        },
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[0]);
          // call hàm ở trang trước
          fillData(data[1]);
        }
    });
    scrollToMain();
  })
  function fillData(data){
    $(".option").val(data);
    $(".option").parent().find(`li.square-item[data-value=${data}]`).addClass("square-select");
  }

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