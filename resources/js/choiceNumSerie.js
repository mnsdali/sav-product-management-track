// ==== check if has serial number js ==== //

var checkbox = document.getElementById('checkbox');
var inputGroup = document.getElementById('input-group');
var fileInput = document.getElementById('file');
var numSerieInput = document.getElementById('numSerieInput');
var otherInput = document.getElementById('other-input');

checkbox.addEventListener('change', function() {
  if (checkbox.checked) {
    inputGroup.style.display = 'block';
    numSerieInput.style.display = 'block';
    otherInput.style.display = 'none';
  } else {
    inputGroup.style.display = 'none';
    numSerieInput.style.display = 'none';
    otherInput.style.display = 'block';
  }
});
// ==== check if has serial number js ==== //


// limit number of characters in textarea//

document.getElementById('prod-descrip-textarea').onkeyup = function() {
    var remainingChars = (500 - this.value.length)
    
    if (remainingChars < 0) {
        document.getElementById('countCharsMachineDescrip').style.color = "red"
        this.value = this.value.slice(0, 500);
        remainingChars = 0;
      } 
      document.getElementById('countCharsTextArea').innerHTML = "vous pouvez encore écrire "+ remainingChars + " caractéres" ;
  
};



document.getElementById('panne-descrip-textarea').onkeyup = function() {
  var remainingChars = (500 - this.value.length)
  
  if (remainingChars < 0) {
      document.getElementById('countCharsPanneDescrip').style.color = "red"
      this.value = this.value.slice(0, 500);
      remainingChars = 0;
  }else{
    document.getElementById('countCharsPanneDescrip').style.color = "black"
  } 
    document.getElementById('countCharsPanneDescrip').innerHTML = "vous pouvez encore écrire "+ remainingChars + " caractéres" ;

};

