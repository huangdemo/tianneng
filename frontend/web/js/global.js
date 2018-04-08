//初始加载
function addLoadEvent(func){
	var oldonload = window.onload;
	if(typeof window.onload  != 'function'){
		window.onload = func;
	}else{
		window.onload = function(){
			oldonload();
			func();
		}
	}
}
//后插入
function insertAfter(newElement,targetElement){
	var parent = targetElement.parentNode;
	if(parent.lastChild == targetElement){
		parent.appendChild(newElement);
	}else{
		parent.insertBefore(newElement,targetElement.nextElementSibling);
	}
}
//添加类
function addClass(element,value){
	if(!element.ClassName){
		element.className = value;
	}else{
		newClassName = element.className;
		newClassName+= " ";
		newClassName+= value;
		element.className = newClassName;
	}
}

function moveElement(elemID,final_x,final_y,interval){
	if(!document.getElementById) return false;
	if(!document.getElementById(elemID)) return false;	
	var elem = document.getElementById(elemID);
	if(elem.movement){
		clearTimeout(elem.movement);
	}
	if(!elem.style.left){
		elem.style.left = "0px";
	}
	if(!elem.style.top){
		elem.style.top = "0px";
	}
	var xpos = parseInt(elem.style.left);
	var ypos = parseInt(elem.style.top);
	var dist = 0;
	if(xpos == final_x && ypos == final_y){
		return true;
	}
	if(xpos < final_x){
		dist = Math.ceil((final_x - xpos)/10);
		xpos = xpos + dist;
	}
	if(xpos > final_x){
		dist = Math.ceil((xpos - final_x)/10);
		xpos = xpos - dist;
	}
	if(ypos < final_y){
		dist = Math.ceil((final_y - ypos)/10);
		ypos = ypos + dist;
	}
	if(ypos > final_y){
		dist = Math.ceil((ypos - final_y)/10);
		ypos = ypos - dist;
	}
	elem.style.left = xpos + "px";
	elem.style.top = ypos + "px";
	var repeat = "moveElement('"+elemID+"',"+final_x+","+final_y+","+interval+")"
	elem.movement = setTimeout(repeat,interval);
}
function stripTables(){
	if(!document.getElementsByTagName) return false;
	var table = document.getElementsByTagName("table");
	for(var i=0; i<table.length; i++){
		var odd = false;
		var rows = table[i].getElementsByTagName("tr");
		for(var j=0; j<rows.length; j++){
			if(odd==true){
				addClass(rows[j],"odd");
				odd = false;
			}else{
				odd = true;
			}
		}
	}
}
function test11(){
				var table = document.getElementById("recordTable");
				var btn = document.getElementById("showBTN");
				if(table.style.display == "block"){
					table.style.display = "none";
					btn.innerHTML = "展开";
				}else{
					table.style.display = "block";
					btn.innerHTML = "收起";
				}
				
			}

			function prepareShowTable(){
				
			if(!document.getElementById("showBTN")) return false;
				var btn = document.getElementById("showBTN");
				btn.onclick = function(){
					test11();
				}
			}
function numadd(){
				var goodsNumText = document.getElementById("goodsNum");
				var goodsNum  = parseInt(goodsNumText.innerHTML);
				if(goodsNum<99){
					goodsNum++;
					goodsNumText.innerHTML = goodsNum;
				}
				return false;
				
				
			}
		function numreduce(){
				var goodsNumText = document.getElementById("goodsNum");
				var goodsNum  = parseInt(goodsNumText.innerHTML);
				if(goodsNum>1){
					goodsNum--;
					goodsNumText.innerHTML = goodsNum;
				}
				return false;
				
			}
		function preparenumContrl(){
			if(!document.getElementById("addbtn")) return false;
			if(!document.getElementById("reducebtn")) return false;
				var addbtn = document.getElementById("addbtn");
				var reducebtn = document.getElementById("reducebtn");
				addbtn.onclick = function(){
					numadd();
				}
				reducebtn.onclick = function(){
					numreduce();
				}
			}
addLoadEvent(stripTables);
addLoadEvent(prepareShowTable);
addLoadEvent(preparenumContrl);