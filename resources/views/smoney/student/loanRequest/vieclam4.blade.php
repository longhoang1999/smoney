<div class="main-top">
  <div class="main-top-title">Thông tin về việc làm của bạn</div>
  <span class="main-nottop-title-detail">Điền các thông tin cơ bản về việc làm hiện tại của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Chia sẻ về mức lương trung bình của bạn</div>
    <span class="main-top-title-detail required-icon">Mức lương trung bình / tháng mà bạn kiếm được: </span><br><br>
    <!-- số tiền -->
    <div class="range">
      <div class="form-group range__value">
        <span class="show-money"></span>    
        <div class="range__value_control">
          <div class="plus">
            <i class="fas fa-sort-up"></i>
          </div>
          <div class="sub">
            <i class="fas fa-sort-down"></i>
          </div>
        </div>         
      </div>
      <div class="form-group range__slider">
        <div class="range__slider_child">
          <span class="money-from">1 triệu</span>
          <input type="range" step="50000">
          <span class="money-to">20 triệu</span>
        </div>
      </div>
    </div>
    <!-- /Số tiền -->
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

<script type="text/javascript" src="{{ asset('js/Smoney/Student/inputRange2.js') }}"></script>
<script type="text/javascript">
  // set up input range
  var min = 1000000;
  var max = 20000000;
  var cur = 3000000;
  var rangeElement = document.querySelector("input[type='range']")
  $("input[type='range']").attr("min",min);
  $("input[type='range']").attr("max",max);
  $("input[type='range']").attr("value",cur);
  $(".show-money").html(asMoney(cur))
  $("input[type='range']").attr("style",generateBackground($("input[type='range']")));

  rangeElement.addEventListener('input', updateSlider)
  function asMoney(value) {
    return parseFloat(value)
      .toLocaleString('en-US', { maximumFractionDigits: 2 }) + '  VNĐ'
  }
  function generateBackground(rangeElement) {   
    if (rangeElement.val() === min) {
      return
    }
    let percentage =  (rangeElement.val() - min) / (max - min) * 100;
    return 'background: linear-gradient(to right, #50299c, #7a00ff ' + percentage + '%, #d3edff ' + percentage + '%, #dee1e2 100%)'
  }
  function updateSlider () {
    $(".show-money").html(asMoney($("input[type='range']").val()))
    $("input[type='range']").attr("style",generateBackground($("input[type='range']")));
  }
  $(".plus").click(function() {
    $("input[type='range']").val(parseInt($("input[type='range']").val()) + 50000)
    updateSlider()
  })
  $(".sub").click(function() {
    $("input[type='range']").val(parseInt($("input[type='range']").val()) - 50000)
    updateSlider()
  })
  // end set up input range

  $(".btn-next").click(function() {
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
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "vieclam3"},
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