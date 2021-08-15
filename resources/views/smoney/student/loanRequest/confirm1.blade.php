<div class="main-top">
  <div class="main-top-title">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi</div>
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
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-labelledby="doneModalLabel" aria-hidden="true">
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
              $("#doneModal").modal("show");
              maHS = null;
            }
          }
      });
    }else{
      alert("Bạn chưa đồng ý với điều khoản!");
    }
  })
  function createObject(){
    var objectToSave = {
      maHS: maHS
    }
    return objectToSave;
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "vote1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })

  $('#doneModal').on('hidden.bs.modal', function (e) {
    location.replace("{{ route('student.student') }}");
  })
  
</script>