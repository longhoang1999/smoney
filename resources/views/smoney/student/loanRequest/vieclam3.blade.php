<div class="main-top">
  <div class="main-top-title">Thông tin về việc làm của bạn</div>
  <span class="main-nottop-title-detail">Điền các thông tin cơ bản về việc làm hiện tại của bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">3. Thông tin về cơ sở nơi bạn làm việc</div>
    <br><span class="main-top-title-detail">Tên cơ sở làm việc: </span><br>
    <input type="text" class="input-text mt-1" placeholder="Nhập tên cơ sở làm việc của bạn">
    <br><span class="main-top-title-detail">Địa chỉ của cơ sở: </span><br>
    <input type="text" class="input-text mt-1" placeholder="Nhập địa chỉ của cơ sở nơi bạn làm việc">
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
        data:{"page": "vieclam4"},
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
        data:{"page": "vieclam2"},
        success:function(data)
        {
          $(".main").empty();
          $(".main").append(data[1]);
        }
    });
  })
</script>