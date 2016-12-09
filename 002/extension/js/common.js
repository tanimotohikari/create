
function onButtonClick() {
  target = document.getElementById('output');
  target.innerText = document.forms.id_form1.id_textBox1.value;
  if(_.include(target.innerText, '￥')) {
    var strLength = (target.innerText.match(/￥/g)||[]).length;
    for(var i=0; i<strLength; i++) {
      target.innerText = target.innerText.replace('￥', '/');
    }
  }
  if(_.include(target.innerText, '\\')) {
    var strLength = (target.innerText.match(/\\/g)||[]).length;
    for(var i=0; i<strLength; i++) {
      target.innerText = target.innerText.replace('\\', '/');
    }
  }
  if(_.include(target.innerText, '\/')) {
    var strLength = (target.innerText.match(/\//g)||[]).length;
    for(var i=0; i<strLength; i++) {
      target.innerText = target.innerText.replace('\/', '￥');
    }
  }
}
