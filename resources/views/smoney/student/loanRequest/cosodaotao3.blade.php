<div class="main-top">
  <div class="main-top-title">
    Thông tin về cơ sở đào tạo của bạn
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền thông tin về trường mà bạn theo học (tiếp theo).</p>
      <p>Những thông tin này sẽ là cơ sở để trường xác minh bạn là sinh viên của nhà trường</p>
      <p class="text-info">
        <span>+ Địa chỉ email sinh viên mà nhà trường bạn cung cấp (không bắt buộc)</span>
        <span>+ Loại chương trình đào tạo của trường bạn</span>
        <span>+ Địa chỉ trụ sở chính của trường nếu trường bạn có nhiều trụ sở. Hoặc điền địa chỉ trường bạn nếu trường bạn chỉ có một địa chỉ</span>
        <span>+ Trạng thái tối nghiệp của bạn</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Điền các thông tin về các trường đại học, cao đẳng,... mà bạn đang theo học</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Thông tin về trường của bạn</div>
    <div class="range">
      <br><span class="main-top-title-detail">5. Địa chỉ email do nhà trường cung cấp: </span><br>
      <input type="email" class="input-text mt-1 email" placeholder="Nhập địa chỉ email">
      <br><span class="main-top-title-detail required-icon">6. Loại chương trình đào tạo: </span><br>
      <select id="programType" class="select color-gray">
        <option hidden="">Chọn loại chương trình đào tạo</option>
        <option value="Chính quy">Chính quy</option>
        <option value="Không chính quy">Không chính quy</option>
      </select>
      <br><span class="main-top-title-detail">7. Địa chỉ trụ sở chính: </span><br>
      <input type="text" class="uniAddress input-text mt-1" placeholder="Nhập địa chỉ trụ sở chính của trường">
      <br><span class="main-top-title-detail required-icon">8. Trạng thái tốt nghiệp: </span><br>
      <select id="leaveUni" class="select color-gray">
        <option hidden="">Chọn trạng thái tốt nghiệp của bạn</option>
        <option value="Đã tốt nghiệp">Đã tốt nghiệp</option>
        <option value="Chưa tốt nghiệp">Chưa tốt nghiệp</option>
      </select>
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
            "page": "cosodaotao4",
            "pagepresent" : "cosodaotao3",
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
    var numberSchool = $(".number-school").val();
    var objectToSave = {
      maHS: maHS,
      universityID: `{{ $uniID }}`,
      emailUni: $(".email").val(),
      programType: $("#programType").val(),
      uniAddress: $(".uniAddress").val(),
      leaveUni: $("#leaveUni").val(),
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "cosodaotao2"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
    scrollToMain();
  })
</script>