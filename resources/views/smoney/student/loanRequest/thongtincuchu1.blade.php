<div class="main-top">
  <div class="main-top-title">
    Thông tin nơi cư chú
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền thông tin cư chú của bạn.</p>
      <p class="text-info">
        <span>Hiện tại bạn đang sống cùng gia đình, đang thuê trọ hay bạn ở với hình thức khác.</span>
        <span>Nếu bạn không sống cùng gia đình hoặc đang thuê trọ bạn có thể nhập thông tin cho chúng tôi biết</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Điền các thông tin về nơi cư chú của bạn</span>
  <div class="block-question">

    <!--question  -->
    <div class="question question-one">Bạn đang sống ở đâu</div>
   <!--  <span class="main-top-title-detail">Hiện tại bạn đang sống cùng ai</span> -->
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Sống cùng gia đình</span>
          <i class="fas fa-building"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>Đang thuê trọ</span>
          <i class="fas fa-home"></i>
        </li>
        <li class="square-item enter-text" data-value="3">
          <span>Khác (mời nhập)</span>
          <i class="fas fa-pencil-alt"></i>
        </li>
      </ul>
      <input type="hidden" class="loan-address">
    </div>
    <!-- /question -->
    <input type="text" class="live-other input-text mt-1" placeholder="Bạn đang sống cùng ai?">
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
            "page": "thongtincuchu2",
            "pagepresent" : "thongtincuchu1",
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
    var var1 = $(".loan-address").val();
    var var2 = $(".live-other").val();
    var objectToSave = {
      maHS: maHS,
      liveWith: var1,
      liveOther : var2
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "thongtincanhan2",
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
  
  $(".enter-text").click(function() {
    $(".live-other").toggle(400);
  })
  
  function fillData(data){    
    if(data['hsk_liveWith'] == "1" || data['hsk_liveWith'] == "2"){
      $(".loan-address").val(data['hsk_liveWith']);
      $(".loan-address").parent().find(`li.square-item[data-value=${data['hsk_liveWith']}]`).addClass("square-select");
    }else{
      $(".loan-address").val("3");
      $(".loan-address").parent().find(`li.square-item[data-value=3]`).addClass("square-select");
      $(".live-other").val(data['hsk_liveWith']);
      $(".live-other").show();
    }
  }
</script>