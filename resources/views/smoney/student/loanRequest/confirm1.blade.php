<div class="main-top">
  <div class="main-top-title">
    Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Chấp nhận điều khoản</p>
      <p class="text-info">
        <span>+ Chấp nhận điều khoản và khoản vay của bạn sẽ được gửi đi</span>
        <span>+ Chúng tôi sẽ thông báo cho bạn thông tin về yêu cầu vay của bạn sớm nhất</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail"></span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two text-center">Chấp nhận điều khoản và gửi yêu cầu. Chúng tôi sẽ có thông báo về bạn sớm nhất</div>
    <div class="rules">
        <p class="rules-title">
            <input type="checkbox" id="rules-checkbox">
            <label for="rules-checkbox" class="mb-0">
                Tôi đã đọc và đồng ý với &nbsp;
            </label>
            <span class="open-block-rules" data-toggle="modal" data-target="#exampleModal">Điều khoản sử dụng phầm mềm</span>
        </p>
    </div>
    <div class="block-btn">
      <button class="btn btn-sm btn-info btn-send-request">Gửi yêu cầu</button>
    </div>
  </div>
</div>
<div class="block-end">
  <hr>
  <div class="main-bottom">
    <div class="btn-back main-bottom-item">
      Quay lại
      <i class="fas fa-long-arrow-alt-left"></i>
    </div>
    <div></div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Điều khoản sử dụng!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Done -->
<div class="modal fade customModal" id="doneModal" tabindex="-1" role="dialog" aria-labelledby="doneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="doneModalLabel">Thông báo nhận yêu cầu thành công!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="text-info">Chúng tôi đã nhận thành công hồ sơ của bạn! Chúng tôi sẽ gửi cho bạn yêu cầu sớm nhất</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(".btn-send-request").click(function() {
    if ($('#rules-checkbox').is(':checked')) {
      $(".modal-head-btn").hide();
      $(".success-title").show();
      $(".title-modal-Choseuni").text("Cơ sở đào tạo nhận hồ sơ");
      $(".modal-title-heading").html("<span>Hãy kiểm tra thông tin của bản thật chính xác trước khi gửi yêu cầu đi<span><br><span class='text-danger'>Bạn sẽ không thể sửa được hồ sơ của mình sau khi hồ sơ đã được gửi.</span>");
      $(".modal-title-comfirm").hide();

      $(".block-personal-infor").slideUp("fast");
      $(".block-school-infor").slideUp("fast");
      $(".block-parent-infor").slideUp("fast");
      $(".block-job-infor").slideUp("fast");

      let shool = document.querySelectorAll(".block-school-infor");
      shool.forEach((item) => {
          if(item.dataset.id != "{{$IDchoseShool}}")
              item.hidden = true;
      })

      $.ajax({
          url:"{!! route('student.getInfoHoso') !!}",
          method: "GET",
          data:{
              maHS
          },
          success:function(data)
          {
            $("#modalRequiredInfo .modal-body .info-hoso").remove();
            $("#modalRequiredInfo .modal-body").append(data);
          }
      });
      setTimeout(() => {
        $("#modalRequiredInfo").modal("show");
      },200)
    }else{
      alert("Bạn chưa đồng ý với điều khoản!");
    }
  })
  $("#modalRequiredInfo").on("click",".btn-submit-loanRequest",function(){
      $.ajax({
          url:"{!! route('student.loadTimeline') !!}",
          method: "GET",
          data:{
              "pagepresent" : "done",
              "data" : createObject()
          },
          success:function(data)
          {
            if(data['response'] == "success"){
              $("#modalRequiredInfo").hide();
              $("#doneModal").modal("show");
              maHS = null;
            }
          }
      });
  })
  function createObject(){
    var objectToSave = {
      maHS: maHS
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "vote1",
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
  
  

  $('#doneModal').on('hidden.bs.modal', function (e) {
    location.replace("{{ route('student.student') }}");
  })
  
  $(".timeline-five").removeClass("active");
  if(!$(".timeline-five").hasClass("done")){
    $(".timeline-five").addClass("done");
  }
  $(".timeline-six").removeClass("done");
  if(!$(".timeline-six").hasClass("active")){
    $(".timeline-six").addClass("active");
  }
</script>