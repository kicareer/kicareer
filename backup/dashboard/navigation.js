function togglenav(id){
	if ($("#"+id).css('display')=='none') {
		$("#"+id).css('display','block');
	}else{
		$("#"+id).css('display','none');
	}
}