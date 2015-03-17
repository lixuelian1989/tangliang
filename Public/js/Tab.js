// JavaScript Document
//Tab 切换
function tabs(tabId, tabNum){
	$(tabId + " .tab li").removeClass("curr");
	$(tabId + " .tab li").eq(tabNum).addClass("curr");
	$(tabId + " .tabcon").hide();
	$(tabId + " .tabcon").eq(tabNum).show();
}


function setTab(name,a,n){
		for (var i = 1; i <= n ; i++)
		{
			var ti = document.getElementById(name+"_tit"+i);
			var ci = document.getElementById(name+"_con"+i);

			ti.className = i == a ? "currkt" : "";
			ci.className = i == a ? "tabcon" : "undis";
		}
	}
	
	
	function setTab2(name2,a2,n2){
		for (var i2 = 1; i2 <= n2 ; i2++)
		{
			var ti2 = document.getElementById(name2+"_tit"+i2);
			var ci2 = document.getElementById(name2+"_con"+i2);

			ti2.className = i2 == a2 ? "currkt2" : "";
			ci2.className = i2 == a2 ? "tabcon2" : "undis";
		}
	}
	
		function setTab3(name3,a3,n3){
		for (var i3 = 1; i3 <= n3 ; i3++)
		{
			var ti3 = document.getElementById(name3+"_tit"+i3);
			var ci3 = document.getElementById(name3+"_con"+i3);

			ti3.className = i3 == a3 ? "currkt3" : "";
			ci3.className = i3 == a3 ? "tabcon3" : "undis";
		}
	}
	
			function setTab4(name4,a4,n4){
		for (var i4 = 1; i4 <= n4 ; i4++)
		{
			var ti4 = document.getElementById(name4+"_tit"+i4);
			var ci4 = document.getElementById(name4+"_con"+i4);

			ti4.className = i4 == a4 ? "currkt4" : "";
			ci4.className = i4 == a4 ? "tabcon4" : "undis";
		}
	}