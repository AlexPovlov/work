
// for ( li of document.querySelectorAll('li')){
//     let span = document.createElement('span');
//     for (const hee of li.children) {
//         hee.hidden = true;
//     }
//     li.prepend(span);
//     span.append(span.nextSibling);
// }

for ( li of document.querySelectorAll('li')){
    for (const hee of li.querySelectorAll('ul')) {
            hee.hidden = true;
        }
}



document.querySelector('ul').onclick = function (event) {
    

    var myRequest = new XMLHttpRequest();
    myRequest.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            myfunc(this.responseText)
        }
    }

    function myfunc(data) {
        newDiv.innerHTML = data;
        if (!elem) {
            a.appendChild(newDiv);
        }else{
            elem.innerHTML = data;
        }
    }

    
    if (event.target.tagName != 'SPAN') return;
    
    var newDiv = document.createElement('div');
        newDiv.id = 'elem';
    let elem = document.getElementById('elem');
    
    let childConteiner = event.target.parentNode.querySelector('ul');

    var a = document.querySelector(".content");

    if (document.location.pathname == '/') {
        myRequest.open("GET","/data/"+event.target.id,true);
        myRequest.send();
    }
    

    if(!childConteiner) return;
    
    childConteiner.hidden = !childConteiner.hidden;
   
}


