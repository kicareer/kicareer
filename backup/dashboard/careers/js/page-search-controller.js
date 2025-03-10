// AJAX LIVE SEARCH
function pagesearch(str) {
  if (str.length==0) {
    document.getElementById("page-search").innerHTML="";
    document.getElementById("page-search").style.border="0px";
    $("#page-search").hide();
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("page-search").innerHTML=this.responseText;
      document.getElementById("page-search").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","page-search-controller.php?projectid="+$("#projectId").val()+"&q="+str,true);
  xmlhttp.send();
  $("#page-search").show();
}
// AJAX LIVE SEARCH