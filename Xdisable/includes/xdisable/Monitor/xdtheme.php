<?php
function xdisable_theme(){
global $sitename,$xdemailset;
?><!doctype html>
<html>
<head>
<title><?php echo $sitename; ?></title>
<?php @include("includes/meta.php"); ?>
<style type="text/css">
body{direction:ltr;background:#000;}
.matrix {font-family:Lucida Console, Courier, Monotype; font-size:10pt; text-align:center; width:10px; padding:0px; margin:0px;}
.main{margin:140px auto;width:422px;height:321px;}
.main1{float:left;margin:10px 0 0 9px;width:400px;height:229px;background:#000;}
.monitor{margin-top:-239px;float:right;width:422px;height:321px;background:url(includes/xdisable/Monitor/1.png) no-repeat;}
</style>
<!--[if lte IE 6]><script src="includes/xdisable/Monitor/DD_belatedPNG.js" type="text/javascript" charset="utf-8"></script><![endif]-->
</head>
<body>
<script type="text/javascript" language="JavaScript">
<!--
var rows=15;
var speed=50;
var reveal=4;
var effectalign="default"
var w3c=document.getElementById&&!window.opera;;
var ie45=document.all&&!window.opera;
var ma_tab,matemp,ma_bod,ma_row,x,y,columns,ma_txt,ma_cho;
var m_coch=new Array();
var m_copo=new Array();
window.onload=function(){if(!w3c&&!ie45)return
var matrix=(w3c)?document.getElementById("matrix"):document.all["matrix"];
ma_txt=(w3c)?matrix.firstChild.nodeValue:matrix.innerHTML;
ma_txt=" "+ma_txt+" ";
columns=ma_txt.length;
if(w3c){while(matrix.childNodes.length)matrix.removeChild(matrix.childNodes[0]);
ma_tab=document.createElement("table");
ma_tab.setAttribute("border",0);ma_tab.setAttribute("align",effectalign);ma_tab.style.backgroundColor="#000000";ma_bod=document.createElement("tbody");for(x=0;x<rows;x++){ma_row=document.createElement("tr");for(y=0;y<columns;y++){matemp=document.createElement("td");matemp.setAttribute("id","Mx"+x+"y"+y);matemp.className="matrix";matemp.appendChild(document.createTextNode(String.fromCharCode(160)));ma_row.appendChild(matemp);}
ma_bod.appendChild(ma_row);}
ma_tab.appendChild(ma_bod);matrix.appendChild(ma_tab);}else{ma_tab='<ta'+'ble align="'+effectalign+'" border="0" style="background-color:#000000">';for(var x=0;x<rows;x++){ma_tab+='<t'+'r>';for(var y=0;y<columns;y++){ma_tab+='<t'+'d class="matrix" id="Mx'+x+'y'+y+'"> </'+'td>';}
ma_tab+='</'+'tr>';}
ma_tab+='</'+'table>';matrix.innerHTML=ma_tab;}
ma_cho=ma_txt;for(x=0;x<columns;x++){ma_cho+=String.fromCharCode(32+Math.floor(Math.random()*94));m_copo[x]=0;}
ma_bod=setInterval("mytricks()",speed);}
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('K T(){x=0;O(y=0;y<M;y++){x=x+(5[y]==i);b=5[y]%i;6(b&&5[y]<i){6(b<c+1){6(n){d=8.j("a"+(b-1)+"y"+y);d.C.B=o[y]}f{d=8.l["a"+(b-1)+"y"+y];d.z=o[y]}d.h.t="#J";d.h.s="N"}6(b>1&&b<c+2){d=(n)?8.j("a"+(b-2)+"y"+y):8.l["a"+(b-2)+"y"+y];d.h.s="I";d.h.t="#V"}6(b>2){d=(n)?8.j("a"+(b-3)+"y"+y):8.l["a"+(b-3)+"y"+y];d.h.t="#S"}6(b<g.p(c/2)+1)5[y]++;f 6(b==g.p(c/2)+1&&o[y]==R.E(y))q(y);f 6(b<c+2)5[y]++;f 6(5[y]<i)5[y]=0}f 6(g.u()>0.9&&5[y]<i){o[y]=e.E(g.p(g.u()*e.H));5[y]++}}6(x==M)W(Y)}K q(4){X 7,k,m;6(5[4]==g.p(c/2)+1){O(m=0;m<c;m++){6(n){7=8.j("a"+m+"y"+4);7.C.B=o[4]}f{7=8.l["a"+m+"y"+4];7.z=o[4]}7.h.t="#J";7.h.s="N"}6(g.u()<P){7=e.U(R.E(4));e=e.F(0,7)+e.F(7+1,e.H)}6(g.u()<P-1)e=e.F(0,e.H-1);5[4]+=Z;D("q("+4+")",G)}f 6(5[4]>r){6(n){7=8.j("a"+(5[4]-Q)+"y"+4);k=8.j("a"+(r+c-5[4]--)+"y"+4)}f{7=8.l["a"+(5[4]-Q)+"y"+4];k=8.l["a"+(r+c-5[4]--)+"y"+4]}7.h.s="I";k.h.s="I";D("q("+4+")",G)}f 6(5[4]==r)5[4]=i+g.p(c/2);6(5[4]>i&&5[4]<r){6(n){7=8.j("a"+(5[4]-L)+"y"+4);7.C.B=w.v(A);k=8.j("a"+(i+c-5[4]--)+"y"+4);k.C.B=w.v(A)}f{7=8.l["a"+(5[4]-L)+"y"+4];7.z=w.v(A);k=8.l["a"+(i+c-5[4]--)+"y"+4];k.z=w.v(A)}D("q("+4+")",G)}}',62,62,'||||ycol|m_copo|if|mtmp|document||Mx|ma_row|rows|matemp|ma_cho|else|Math|style|100|getElementById|mtem|all|ytmp|w3c|m_coch|floor|zoomer|200|fontWeight|color|random|fromCharCode|String|||innerHTML|160|nodeValue|firstChild|setTimeout|charAt|substring|speed|length|normal|33ff66|function|101|columns|bold|for|reveal|201|ma_txt|009900|mytricks|indexOf|00ff00|clearInterval|var|ma_bod|199'.split('|'),0,{}))
</script>
<div class="main"><div class="main1">
<div id="matrix">       <?php echo xdvs(3); ?>      </div>
</div><div class="monitor"></div></div>
</body>
</html>
<?php
die();
}
?>