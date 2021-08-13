<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="{{ asset('img-smoney/smoney.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/Smoney/Student/test.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Test</title>
</head>
<body>
    <div class="container">
      <form class="range">
        <div class="form-group range__slider">
          <input type="range" step="500">
        </div><!--/form-group-->
        <div class="form-group range__value">
          <label>Số tiền</label>
          <span></span>            
        </div><!--/form-group-->
      </form>
    </div><!--/container-->

  <!-- js -->
  <script type="text/javascript" src="{{ asset('js/Smoney/Pushjs/push.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script type="text/javascript">
    Push.create('Notification_1',{
      body: "Welcome to Long Hoang",
      timeout: 5000,
      icon: '{{ asset("img-smoney/smoney.png") }}',
      onClick: function () {
        window.focus();
        this.close();
      }
    })
    Push.create('Notification_2',{
      body: "Welcome to Long Hoang 2",
      timeout: 5000,
      icon: '{{ asset("img-smoney/smoney.png") }}',
      onClick: function () {
        window.focus();
        this.close();
      }
    })
    Push.create('Notification_3',{
      body: "Welcome to Long Hoang 4",
      timeout: 5000,
      icon: '{{ asset("img-smoney/smoney.png") }}',
      onClick: function () {
        window.focus();
        this.close();
      }
    })
  </script>
  <script type="text/javascript">
  
    class Slider {
      constructor (rangeElement, valueElement, options) {
        this.rangeElement = rangeElement
        this.valueElement = valueElement
        this.options = options

        // Attach a listener to "change" event
        this.rangeElement.addEventListener('input', this.updateSlider.bind(this))
      }

      // Initialize the slider
      init() {
        this.rangeElement.setAttribute('min', options.min)
        this.rangeElement.setAttribute('max', options.max)
        this.rangeElement.value = options.cur

        this.updateSlider()
      }

      // Format the money
      asMoney(value) {
        return parseFloat(value)
          .toLocaleString('en-US', { maximumFractionDigits: 2 }) + '  VNĐ'
      }

      generateBackground(rangeElement) {   
        if (this.rangeElement.value === this.options.min) {
          return
        }

        let percentage =  (this.rangeElement.value - this.options.min) / (this.options.max - this.options.min) * 100
        return 'background: linear-gradient(to right, #50299c, #7a00ff ' + percentage + '%, #d3edff ' + percentage + '%, #dee1e2 100%)'
      }

      updateSlider (newValue) {
        this.valueElement.innerHTML = this.asMoney(this.rangeElement.value)
        this.rangeElement.style = this.generateBackground(this.rangeElement.value)
      }
    }

    let rangeElement = document.querySelector('.range [type="range"]')
    let valueElement = document.querySelector('.range .range__value span') 

    let options = {
      min: 5000000,
      max: 100000000,
      cur: 7000000
    }

    if (rangeElement) {
      let slider = new Slider(rangeElement, valueElement, options)

      slider.init()
    }
  </script>
</body>
</html>