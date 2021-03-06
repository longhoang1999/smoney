<div class="main-top">
  <div class="main-top-title">
    Các chủ đề mà bạn quan tâm
    <i class="fas fa-question-circle"></i>
    <div class="more-info-user">
      <p>Điền các chủ đề mà bạn quan tâm.</p>
      <p class="text-info">
        <span>+ Để chúng tôi hiểu rõ hơn về bạn: bạn có thể cho chúng tôi biết các lĩnh vực mà bạn quan tâm</span>
        <span>Lưu ý: kéo thả vào vùng của bạn</span>
      </p>
    </div>
  </div>
  <span class="main-nottop-title-detail">Hãy để chúng tôi hiểu rõ hơn về bạn</span>
  <div class="block-question">
    <!--question  -->
    <div class="question question-two">Lựa chọn các chủ đề mà bạn hứng thú (kéo thả)</div>
    <span class="main-top-title-detail">Chủ đề</span>

    <div class="div_drop" id="div1" ondrop="drop(event,this)" ondragover="allowDrop(event)">
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag1">Giáo dục</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag2">Khoa học</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag3">Y tế</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag4">Xã hội</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag5">Chứng khoán</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag6">Cổ phiếu</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag7">Công nghệ</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag8">Máy móc</a>
          <a class="ui tag label" draggable="true" ondragstart="drag(event)" id="drag9">Nông nghiệp</a>
    </div>

    <span class="main-top-title-detail">Chủ đề của bạn</span>
    <div class="div_drop" id="div2" ondrop="drop(event,this)" ondragover="allowDrop(event)">
    </div>
    <!-- /question -->
    <input type="hidden" id="content_tag" name="content_tag">
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
        data:{"page": ""},
        data:{
            "page": "notification1",
            "pagepresent" : "tag1",
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
    var objectToSave = {
      maHS: maHS,
      contentTag: $("#content_tag").val(),
    }
    return objectToSave;
  }

  function allowDrop(ev) {
    ev.preventDefault();
  }
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }
  var arrayTag = [];
  function drop(ev,el) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    el.appendChild(document.getElementById(data));
    // gán value
    $("#content_tag").val("");
    arrayTag = [];
    let lenth = $("#div2 a").length;
    for (let i = 0; i < lenth; i++) {
      arrayTag.push($("#div2 a")[i].text)
    }
    let content_tag = "";
    arrayTag.forEach(function(item, index){
      content_tag = content_tag + item + "|";
    })
    $("#content_tag").val(content_tag);
  }

  $(".btn-back").click(function() {
    $.ajax({
        url:"{!! route('student.loadTimelinePre') !!}",
        method: "GET",
        data:{
            "page": "otherpage1",
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

  function fillData(data){
    let ar = document.querySelectorAll("#div1 a");
    ar.forEach((item) => {
        if(data.indexOf(item.innerText) != -1){
            $("#div2").append(item)
        }
    })
    $("#content_tag").val("");
    arrayTag = [];
    let lenth = $("#div2 a").length;
    for (let i = 0; i < lenth; i++) {
      arrayTag.push($("#div2 a")[i].text)
    }
    let content_tag = "";
    arrayTag.forEach(function(item, index){
      content_tag = content_tag + item + "|";
    })
    $("#content_tag").val(content_tag);
  }


  $(".timeline-two").removeClass("active");
  if(!$(".timeline-two").hasClass("done")){
    $(".timeline-two").addClass("done");
  }
  $(".timeline-three").removeClass("done");
  if(!$(".timeline-three").hasClass("active")){
    $(".timeline-three").addClass("active");
  }
  $(".timeline-four").removeClass("active");
  $(".timeline-four").removeClass("done");
</script>