<div class="main-top">
  <div class="main-top-title">
    Bạn có đóng góp ý kiến gì không?
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Nhập ý kiến và đánh giá của bạn</p>
      <p class="text-info">
        <span>Nếu bạn có bất kỳ ý kiến, đóng góp gì, bạn có thể gửi cho chúng tôi</span>
        <span>Hãy đánh giá về trải nghiệm sử dụng hệ thống của bạn!</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Chúng tôi muốn lắng nghe ý kiến và đánh giá của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two required-icon">Những thông tin khác mà bạn muốn gửi về cho chúng tôi</div>
    <textarea class="input-text hight-200 opinion" placeholder="Nhập ý kiến của bạn"></textarea>

    <div class="question question-two required-icon">Đánh giá của bạn</div>
    <div class="star mt-2" id="div_Starrank_tour">
      <i class="fas fa-star star_1 star_select" data-value="1"></i>
      <i class="fas fa-star star_2 star_select" data-value="2"></i>
      <i class="fas fa-star star_3 star_select" data-value="3"></i>
      <i class="fas fa-star star_4" data-value="4"></i>
      <i class="fas fa-star star_5" data-value="5"></i>
    </div>
    <input type="hidden" id="star_Share" name="numberStar" value="3">
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
  @for($i = 1; $i<= 5; $i++)
    $("#div_Starrank_tour .star_{{$i}}").click(function(){
        @for($j = 1 ; $j <= 5; $j++)
            $("#div_Starrank_tour .star_{{$j}}").css("color","#212529");
        @endfor
        @for($j = 1 ; $j <= $i; $j++)
            $("#div_Starrank_tour .star_{{$j}}").css("color","#ff9700");
        @endfor
        //console.log($(this).attr("data-value"));
        $("#star_Share").val($(this).attr("data-value"));
  });
  @endfor


  $(".btn-next").click(function() {
    if($("#star_Share").val() == undefined || $("#star_Share").val() == ""){
      $(".notExistContent").html("Đánh giá của bạn");
      $("#modalNotExist").modal("show");
    }else if($(".opinion").val() == undefined || $(".opinion").val() == ""){
      $(".notExistContent").html("Ý kiến của bạn");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "confirm1",
              "pagepresent" : "vote1",
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
    var objectToSave = {
      maHS: maHS,
      opinion: $(".opinion").val(),
      star_votes: $("#star_Share").val()
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "notification1",
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
    $(".opinion").text(data.opinion);
    $("#star_Share").val(data.star_votes);
    refreshStar(data.star_votes);
  }
  function refreshStar(star){
    if(star == "1"){
      $(".star_1").addClass("star_select");
      $(".star_2").removeClass("star_select");
      $(".star_3").removeClass("star_select");
      $(".star_4").removeClass("star_select");
      $(".star_5").removeClass("star_select");
    }else if(star == "2"){
      $(".star_1").addClass("star_select");
      $(".star_2").addClass("star_select");
      $(".star_3").removeClass("star_select");
      $(".star_4").removeClass("star_select");
      $(".star_5").removeClass("star_select");
    }else if(star == "3"){
      $(".star_1").addClass("star_select");
      $(".star_2").addClass("star_select");
      $(".star_3").addClass("star_select");
      $(".star_4").removeClass("star_select");
      $(".star_5").removeClass("star_select");
    }else if(star == "4"){
      $(".star_1").addClass("star_select");
      $(".star_2").addClass("star_select");
      $(".star_3").addClass("star_select");
      $(".star_4").addClass("star_select");
      $(".star_5").removeClass("star_select");
    }else if(star == "5"){
      $(".star_1").addClass("star_select");
      $(".star_2").addClass("star_select");
      $(".star_3").addClass("star_select");
      $(".star_4").addClass("star_select");
      $(".star_5").addClass("star_select");
    }
  }


  $(".timeline-four").removeClass("active");
  if(!$(".timeline-four").hasClass("done")){
    $(".timeline-four").addClass("done");
  }
  $(".timeline-five").removeClass("done");
  if(!$(".timeline-five").hasClass("active")){
    $(".timeline-five").addClass("active");
  }
  $(".timeline-six").removeClass("active");
  $(".timeline-six").removeClass("done");
</script>