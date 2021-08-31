<div class="main-top">
  <div class="main-top-title">
    Thông tin khoản vay
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền thông tin khoản vay của bạn.</p>
      <p>Thông tin về khoản vay gồm có:</p>
      <p class="text-info">
        <span>+ Bạn muốn vay là bao nhiêu tiền?</span>
        <span>+ Mục đích của khoản vay là gì?</span>
        <span>+ Bạn dự định sẽ trả hết trong bao nhiêu tháng?</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Điền các thông tin về khoản vay của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-one required-icon">
      Số tiền bạn muốn vay
    </div>
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
          <span class="money-from">5 triệu</span>
          <input type="range" step="50000">
          <span class="money-to">20 triệu</span>
        </div>
      </div>
    </div>
    <!-- /Số tiền -->
    <!-- /question -->

    <!--question  -->
    <div class="question question-two required-icon">Mục đích vay</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>Học phí</span>
          <i class="fas fa-school"></i>
        </li>
      </ul>
      <input type="hidden" class="loan-purpose">
    </div>
    <!-- /question -->

    <!--question  -->
    <div class="question question-three required-icon">Thời hạn</div>
    <div class="block-square">
      <ul>
        <li class="square-item" data-value="1">
          <span>3 tháng</span>
          <i class="far fa-clock"></i>
        </li>
        <li class="square-item" data-value="2">
          <span>6 tháng</span>
          <i class="far fa-clock"></i>
        </li>
        <li class="square-item" data-value="3">
          <span>12 tháng</span>
          <i class="far fa-clock"></i>
        </li>
      </ul>
      <input type="hidden" class="loan-duration">
    </div>
    <!-- /question -->
  </div>
</div>

<div class="block-end">
  <hr>
  <div class="main-bottom">
    <div></div>
    <div class="btn-next main-bottom-item">
      Tiếp theo
      <i class="fas fa-long-arrow-alt-right"></i>
    </div>
  </div>
</div>


<script type="text/javascript">
  // set up input range
  var min = 5000000;
  var max = 20000000;
  var cur = 7000000;
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
    if($(".loan-purpose").val() == undefined || $(".loan-purpose").val() == ""){
      $(".notExistContent").html("Mục đích vay");
      $("#modalNotExist").modal("show");
    }else if($(".loan-duration").val() == undefined || $(".loan-duration").val() == "")
    {
      $(".notExistContent").html("Thời hạn vay");
      $("#modalNotExist").modal("show");
    }
    else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
            "page": "thongtincanhan1",
            "pagepresent" : "thongtinkhoanvay1",
            "data" : createObject()
          },
          success:function(data)
          {
            maHS = data[0];
            $(".main").empty();
            $(".main").append(data[1]);
          }
      });
      scrollToMain();
    }
  })

  function createObject(){
    var var1 = $("input[type='range']").val();
    var var2 = $(".loan-purpose").val();
    var var3 = $(".loan-duration").val();
    var objectToSave = {
      maHS: maHS,
      money : var1,
      purpose : var2,
      duration : var3
    }
    return objectToSave;
  }

  $(".timeline-one").removeClass("done");
  if(!$(".timeline-one").hasClass("active")){
    $(".timeline-one").addClass("active");
  }
  if($(".timeline-two").hasClass("active")){
    $(".timeline-two").removeClass("active");
  }
  

  function fillData(data){
    // hsk_money
    $("input[type='range']").attr("value",data['hsk_money']);
    $(".show-money").html(asMoney(data['hsk_money']))
    $("input[type='range']").attr("style",generateBackground($("input[type='range']")));
    // hsk_purpose
    $(".loan-purpose").val(data['hsk_purpose']);
    $(".loan-purpose").parent().find(`li.square-item[data-value=${data['hsk_purpose']}]`).addClass("square-select");
    // hsk_duration
    $(".loan-duration").val(data['hsk_duration']);
    $(".loan-duration").parent().find(`li.square-item[data-value=${data['hsk_duration']}]`).addClass("square-select");
  }


  // function divMainAnimation(){
  //   $(".main-top").fadeOut("fast");
  //   $(".block-end").fadeOut("fast");
  //   $(".main-top").fadeIn("slow");
  //   $(".block-end").fadeIn("slow");
  // }
</script>