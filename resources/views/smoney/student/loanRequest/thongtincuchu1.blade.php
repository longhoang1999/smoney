<div class="main-top">
  <div class="main-top-title">Thông tin nơi cư chú</div>
  <span class="main-nottop-title-detail">Điền các thông tin về nơi cư chú của bạn</span>
  <div class="block-question">

    <!--question  -->
    <div class="question question-one">Bạn đang sống ở đâu</div>
    <span class="main-top-title-detail">Hiện tại bạn đang sống cùng ai</span>
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
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "thongtincanhan2"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
  
  $(".enter-text").click(function() {
    $(".live-other").toggle(400);
  })
  
  
</script>