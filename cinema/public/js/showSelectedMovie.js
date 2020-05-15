
 url="/registerMovie/";


 var selected =false;
 function saveTheValue() {
 selected =false;
 var selectBox = document.getElementById("selectBox");
 var selectedValue = selectBox.options[selectBox.selectedIndex].value;

 myForm = document.getElementById("divAdded");
while (myForm.firstChild) {
  myForm.removeChild(myForm.firstChild);
}
  var i ;
  for(i=0;i<selectedValue;i++)
  {
        additional = document.createElement("input");
        additional.setAttribute("type","text");
        additional.setAttribute("id","Name for person"+i);
        additional.setAttribute("name","Name"+(i+1));
        additional.setAttribute("class","form-control");
        additional.style.marginBottom = "5pt";
        additional.placeholder = "Reference name";
        myForm.appendChild(additional);
  }
}
function message(msg) {
  alert(msg);
}
 //not implemented

