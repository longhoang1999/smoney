<div class="main-top">
  <div class="main-top-title">
    Một số options có thể làm tăng khả năng bạn được cho vay
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền một số tùy chọn có thể làm tăng khả năng vay thành công của bạn</p>
      <p class="text-info">
        <span>+ Nếu bạn có thông tin về người bảo trợ bạn có thể khai báo ở đây</span>
        <span>Lưu ý: Người bảo trợ có thể là bố, mẹ, người thân ruột thịt,..</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Nếu bạn có người bảo trợ hoặc bạn tham gia các hoạt động đoàn thể ở trường,... hãy điền vào phần dưới. Ví dụ: đoàn thanh niên, câu lạc bộ sinh viên</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Nhập thông tin người bảo trợ</div>

    <div class="container-fuild">
      <div class="row">
        <div class="col-md-6">
          <span class="main-top-title-detail required-icon">1. Họ và tên: </span><br>
          <input type="text" class="input-text mt-1 fullname" placeholder="Nhập họ và tên">
        </div>
        <div class="col-md-6">
          <span class="main-top-title-detail required-icon">2. Số điện thoại: </span><br>
          <input type="text" class="input-text mt-1 phone" placeholder="Nhập số điện thoại" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
        </div>
        <div class="col-md-6">
          <span class="main-top-title-detail required-icon">3. Số căn cước công dân: </span><br>
          <input type="text" class="input-text mt-1 cccd" placeholder="Nhập số căn cước công dân">
        </div>
        <div class="col-md-6">
          <span class="main-top-title-detail required-icon">4. Giới tính: </span><br>
          <select name="gender" class="select color-gray mt-1">
            <option value="" hidden="">--Giới tính</option>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
          </select>
        </div>
        <div class="col-md-12">
          <span class="main-top-title-detail">
            5. Số tài khoản: 
            Ví dụ: 0123456789 - Agribank - Chi nhánh Đông Hà Nội
          </span><br>
          <input type="text" class="input-text mt-1 stk" placeholder="Nhập số tài khoản">
        </div>
        <div class="col-md-12">
          <span class="main-top-title-detail required-icon">6. Quan hệ với sinh viên: </span><br>
          <input type="text" class="input-text mt-1 relationship" placeholder="Nhập quan hệ với sinh viên">
        </div>

        <!-- /question -->
        <div class="file-infor mt-3">
          <button class="btn btn-sm btn-info btn-add">Thêm một người bảo trợ</button>
        </div>
      </div>
    </div>
  </div>
</div>
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
<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin người bảo trợ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fuild">
          <div class="row">
            <div class="col-md-4">Họ tên</div>
            <div class="col-md-8 showFullName"></div>
            <div class="col-md-4">Số điện thoại</div>
            <div class="col-md-8 showPhone"></div>
            <div class="col-md-4">Số căn cước công dân</div>
            <div class="col-md-8 showCccd"></div>
            <div class="col-md-4">Giới tính</div>
            <div class="col-md-8 showGender"></div>
            <div class="col-md-4">Số tài khoản</div>
            <div class="col-md-8 showStk"></div>
            <div class="col-md-4">Quan hệ với sinh viên</div>
            <div class="col-md-8 showRelationship"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal">Xóa</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var yourParentsInfo = {};
  var numberParents = 0;
  var colorList = ["#ff9f0f", "#0b5ac3", "#11cc16", "#11ccc3", "#cc11be","#c30b71","#f5e200","#f50000","#a200f5","#f5007c"];
  $(".btn-add").click(function() {
    if(checkHasInfo()){
        let object = {
          name: $(".fullname").val(),
          phone: $(".phone").val(),
          cccd: $(".cccd").val(),
          gender: $("select[name=gender]").val(),
          stk: $(".stk").val(),
          relationship: $(".relationship").val()
        }
        numberParents++;
        yourParentsInfo[`${numberParents.toString()}`] = object;
        // refress
        $(".fullname").val("");
        $(".phone").val("");
        $(".cccd").val("");
        $("select[name=gender]").val("");
        $(".stk").val("");
        $(".relationship").val("");
        // add file
        let randomColor = Math.floor(Math.random() * colorList.length);
        $(".file-infor").append(`<div class="file-infor-icon ml-4" data-key="${numberParents}"><i style="color:${colorList[randomColor]}" class="fas fa-file-alt"></i></div>`);
    }else{
      alert("Bạn nhập thiếu thông tin");
    }
  })



  $(".file-infor").on("click",".file-infor-icon",function(){
    let key = $(this).data("key");
    $(".showFullName").text(yourParentsInfo[`${key}`].name);
    $(".showPhone").text(yourParentsInfo[`${key}`].phone);
    $(".showCccd").text(yourParentsInfo[`${key}`].cccd);
    $(".showGender").text(yourParentsInfo[`${key}`].gender);
    $(".showStk").text(yourParentsInfo[`${key}`].stk);
    $(".showRelationship").text(yourParentsInfo[`${key}`].relationship);
    $(".btn-delete").attr("data-key",key);
    $("#exampleModal").modal("show");
  })




  $(".btn-delete").click(function() {
    let key = $(this).data("key");
    $(`div[data-key=${key}]`).remove();
    delete yourParentsInfo[`${key}`];
  })

  function checkHasInfo(){
    if($(".fullname").val() != "" && $(".phone").val() != "" && $(".cccd").val() != "" && $(".relationship").val() != "" && $("select[name=gender]").val() != ""){
      return true;
    }else{
      return false;
    }
  }


  $(".btn-next").click(function() {
    if(checkHasInfo()){
      // add like btn-add function
      let object = {
        name: $(".fullname").val(),
        phone: $(".phone").val(),
        cccd: $(".cccd").val(),
        gender: $("select[name=gender]").val(),
        stk: $(".stk").val(),
        relationship: $(".relationship").val()
      }
      numberParents++;
      yourParentsInfo[`${numberParents.toString()}`] = object;
    }
    if(Object.keys(yourParentsInfo).length > 0){
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "page": "otherpage1",
              "pagepresent" : "option4",
              "data" : createObject()
          },
          success:function(data)
          {
            $(".main").empty();
            $(".main").append(data[1]);
          }
      });
      scrollToMain();
    }else{
      alert("Bạn chưa nhập thông tin");
    }
  })
  function createObject(){
    var objectToSave = {
      maHS: maHS,
      yourParentsInfo: yourParentsInfo,
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "option3"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })
</script>