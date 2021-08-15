<div class="main-top">
  <div class="main-top-title">Bạn có đóng góp ý kiến gì không?</div>
  <span class="main-nottop-title-detail">Chúng tôi muốn lắng nghe ý kiến và đánh giá của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Ý kiến của bạn</div>
    <textarea class="input-text hight-200 opinion" placeholder="Nhập ý kiến của bạn"></textarea>

    <div class="question question-two">Đánh giá của bạn</div>
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