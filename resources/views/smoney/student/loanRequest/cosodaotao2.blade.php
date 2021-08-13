<?php  
  use App\Models\SmoneyModels\NhaTruong;
  $unis = NhaTruong::get();
  ?>
<div class="main-top">
  <div class="main-top-title">Thông tin về cơ sở đào tạo của bạn</div>
  <span class="main-nottop-title-detail">Điền các thông tin về các trường đại học, cao đẳng,... mà bạn đang theo học</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Thông tin về trường của bạn</div>
    <div class="range">
      <br>
      <span class="main-top-title-detail required-icon">1. Tên trường: </span>
      <br>
      <select id="select-university" class="select color-gray">
        <option hidden="">Chọn trường</option>
        @foreach($unis as $uni)
          <option value="{{ $uni->nt_id }}" 
            @foreach($uniAr as $uAr)
              @if($uni->nt_id == $uAr)
                disabled=""
              @endif
            @endforeach
          >{{ $uni->nt_ten }}</option>
        @endforeach
      </select>
      <br><span class="main-top-title-detail required-icon">2. Chuyên ngành theo học: </span><br>
      <input type="text" class="input-text mt-1 specialized" placeholder="Nhập chuyên ngành">
      <br><span class="main-top-title-detail required-icon">3. Lớp hành chính: </span><br>
      <input type="text" class="input-text mt-1 class" placeholder="Nhập lớp hành chính">
      <br><span class="main-top-title-detail required-icon">4. Mã sinh viên: </span><br>
      <input type="text" class="input-text mt-1 studentCode" placeholder="Nhập mã sinh viên">
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
            "page": "cosodaotao3",
            "pagepresent" : "cosodaotao2",
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
    var numberSchool = $(".number-school").val();
    var objectToSave = {
      maHS: maHS,
      universityID: $("#select-university").val(),
      specialized: $(".specialized").val(),
      class: $(".class").val(),
      studentCode: $(".studentCode").val(),
    }
    return objectToSave;
  }
  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimeline') !!}",
        method: "GET",
        data:{"page": "cosodaotao1"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
</script>