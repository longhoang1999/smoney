class Slider2 {
constructor (rangeElement, valueElement, options) {
  this.rangeElement = rangeElement
  this.valueElement = valueElement
  this.options = options

  // Attach a listener to "change" event
  this.rangeElement.addEventListener('input', this.updateSlider2.bind(this))
}

// Initialize the Slider2
init() {
  this.rangeElement.setAttribute('min', this.options.min)
  this.rangeElement.setAttribute('max', this.options.max)
  this.rangeElement.value = this.options.cur

  this.updateSlider2()
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

updateSlider2 (newValue) {
  this.valueElement.innerHTML = this.asMoney(this.rangeElement.value)
  this.rangeElement.style = this.generateBackground(this.rangeElement.value)
}
}

let rangeElement2 = document.querySelector('.range2 [type="range"]')
let valueElement2 = document.querySelector('.range2 .range__value span') 

let options2 = {
  min: 1000000,
  max: 20000000,
  cur: 3000000
}

if (rangeElement2) {
  let slider2 = new Slider2(rangeElement2, valueElement2, options2)
  slider2.init()
}