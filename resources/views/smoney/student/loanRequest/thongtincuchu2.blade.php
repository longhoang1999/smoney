<div class="main-top">
  <div class="main-top-title">
    Thông tin nơi cư chú
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền thông tin về nơi cư chú của bạn.</p>
      <p class="text-info">
        <span>Thông tin thường chú là thông tin trong sổ hộ khẩu của bạn.</span>
        <span>+ Nếu hộ khẩu của bạn bạn ở thành phố hãy khai báo đến số nhà, số đường...</span>
        <span>+ Nếu bạn không ở thành phố hãy khai báo đến bản, làng, thôn, xóm,...</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Điền các thông tin về nơi cư chú của bạn</span>
  <div class="block-question">

    <!--question  -->
    <div class="question question-one required-icon">Địa chỉ thường chú của bạn</div>
    <p class="text-fill-address font-italic">Địa chỉ bạn đã nhập là: <span class="text-warning fill-address font-weight-bold"></span></p>
    <div class="range">
      <span class="main-top-title-detail">Chọn Thành phố / Tỉnh</span>
      <br>
      <select name="" class="select color-gray" id="select-city">
        <option hidden="" value="">Thành phố / Tỉnh</option>
      </select>
      <br>
      <span class="main-top-title-detail">Chọn Quận / Huyện</span>
      <br>
      <select name="" class="select color-gray" id="select-district">
        <option hidden="" value="">Quận / Huyện</option>
      </select>
      <br>
      <span class="main-top-title-detail">Chọn Phường / Xã</span>
      <br>
      <select name="" class="select color-gray" id="select-ward">
        <option hidden="" value="">Phường / Xã</option>
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
    if($("#select-city").val() == ""){
      $(".notExistContent").html("Thành phố / Tỉnh");
      $("#modalNotExist").modal("show");
    }else if($("#select-district").val() == ""){
      $(".notExistContent").html("Quận  / Huyện");
      $("#modalNotExist").modal("show");
    }else if($("#select-ward").val() == ""){
      $(".notExistContent").html("Phường / Xã");
      $("#modalNotExist").modal("show");
    }else if($(".home-number").val() == ""){
      $(".notExistContent").html("Số nhà");
      $("#modalNotExist").modal("show");
    }else{
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "thongtincuchu3",
              "pagepresent" : "thongtincuchu2",
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
    let checkBack = $(".fill-address").text();
    if(checkBack == ""){
      var address = `${$(".home-number").val()} - ${$( "#select-ward option:selected" ).text()} - ${$( "#select-district option:selected" ).text()} - ${$( "#select-city option:selected" ).text()}`;
    }else{
      var address = checkBack;
    }

    var objectToSave = {
      maHS: maHS,
      address: address,
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "thongtincuchu1",
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

  $.ajax({
      url:"{!! route('student.loadAllCity') !!}",
      method: "POST",
      success:function(data)
      {
        if(data['status'] === "success")
        {
          data['province_address'].forEach(function(item, index) {
            $("#select-city").append(`<option value="${item['provinceid']}">${item['type']} ${item['name']}</option>`);
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
                  // reset xa
                  $("#select-ward").empty();
                  $("#select-ward").append('<option hidden="" value="">Phường / Xã</option>');
              }
          }
      });
      // reset back
      $(".fill-address").text("");
      $(".text-fill-address").hide();
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

  function fillData(data){    
    $(".fill-address").text(data['hsk_address']);
    $(".text-fill-address").show();
  }
</script>