<style>
  .range{display: none;}
</style>

<div class="main-top">
  <div class="main-top-title">Thông tin nơi cư chú</div>
  <span class="main-nottop-title-detail">Điền các thông tin về nơi cư chú của bạn</span>
  <div class="block-question">

    <!--question  -->
    <div class="question question-one required-icon">Địa chỉ tạm chú của bạn</div>
    <div class="block-square">
      <ul>
        <li class="square-item not-select-orther" data-value="1">
          <span>Giống địa chỉ thường chú</span>
          <i class="fab fa-font-awesome-flag"></i>
        </li>
        <li class="square-item select-orther" data-value="2">
          <span>Khác</span>
          <i class="fas fa-question"></i>
        </li>
      </ul>
      <input type="hidden" class="loan-address-now">
    </div>

    <div class="range">
      <span class="main-top-title-detail">Chọn Thành phố / Tỉnh</span>
      <br>
      <select name="" class="select color-gray" id="select-city">
        <option hidden="">Thành phố / Tỉnh</option>
      </select>
      <br>
      <span class="main-top-title-detail">Chọn Quận / Huyện</span>
      <br>
      <select name="" class="select color-gray" id="select-district">
        <option hidden="">Quận / Huyện</option>
      </select>
      <br>
      <span class="main-top-title-detail">Chọn Phường / Xã</span>
      <br>
      <select name="" class="select color-gray" id="select-ward">
        <option hidden="">Phường / Xã</option>
      </select>
      <br>
      <span class="main-top-title-detail">Số nhà (tên đường, phố) / thôn, xóm</span>
      <br>
      <input type="text" class="home-number input-text mt-1 color-gray" placeholder="Ví dụ: Số nhà 21, phố Kim Ngưu">
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
            "page": "cosodaotao1",
            "pagepresent" : "thongtincuchu3",
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
    var check = $(".loan-address-now").val();
    var address = `${$(".home-number").val()} - ${$( "#select-ward option:selected" ).text()} - ${$( "#select-district option:selected" ).text()} - ${$( "#select-city option:selected" ).text()}`;

    var objectToSave = {
      maHS: maHS,
      check: check,
      addressNow: address,
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "thongtincuchu2"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })

  $(".select-orther").click(function() {
    $(".range").slideDown();
  })
  $(".not-select-orther").click(function() {
    $(".range").slideUp();
  })

  $.ajax({
      url:"{!! route('student.loadAllCity') !!}",
      method: "POST",
      success:function(data)
      {
        if(data['status'] === "success")
        {
          data['province_address'].forEach(function(item, index) {
            $("#select-city").append(`<option value="${item['provinceid']}">${item['name']}</option>`);
          })
        }
      }
  });
  $("#select-city").change(function() {
      $.ajax({
          method: "POST",
          url: "{!! route('student.findDistrict') !!}",
          data: {'provinceID': $(this).val()},
          success: function(data)
          {
              if(data['status'] === "success")
              {
                  let district = data['district_address'];
                  $("#select-district").empty();
                  $("#select-district").append('<option hidden="" value="">Quận / Huyện</option>');
                  district.forEach((item, index) => {
                      $("#select-district").append(`<option value="${item['districtid']}">${item['type']} ${item['name']}</option>`);
                  })
              }
          }
      });
  })
  $("#select-district").change(function() {
      $.ajax({
          method: "POST",
          url: "{!! route('student.findWard') !!}",
          data: {'districtID': $(this).val()},
          success: function(data)
          {
              if(data['status'] === "success")
              {
                  let ward = data['ward_address'];
                  $("#select-ward").empty();
                  $("#select-ward").append('<option hidden="" value="">Phường / Xã</option>');
                  ward.forEach((item, index) => {
                      $("#select-ward").append(`<option value="${item['wardid']}">${item['type']} ${item['name']}</option>`);
                  })
              }
          }
      });
  })


  $(".timeline-one").removeClass("active");
  if(!$(".timeline-one").hasClass("done")){
    $(".timeline-one").addClass("done");
  }
  $(".timeline-two").removeClass("done");
  if(!$(".timeline-two").hasClass("active")){
    $(".timeline-two").addClass("active");
  }
  $(".timeline-three").removeClass("active");
  $(".timeline-three").removeClass("done");
</script>