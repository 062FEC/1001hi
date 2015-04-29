
function open_upload(f_t_name,f_file_path,f_value2)
{
if (!f_file_path) f_file_path='../../uploadfiles/';
var sss="../upload/upload.php?t_name="+f_t_name+"&file_path="+f_file_path;
window.open(sss,"上传文件","toolbar=no,menubar=no,resizable=yes,top="+(screen.availHeight - parseFloat(300))/2+",left="+(screen.availWidth - parseFloat(500))/2+",width=500pt,height=300pt");

}

function open_upload2(f_t_name,f_file_path,f_value2)
{
if (!f_file_path) f_file_path='../uploadfiles/';
var sss="upload/upload.php?t_name="+f_t_name+"&file_path="+f_file_path;
window.open(sss,"上传文件","toolbar=no,menubar=no,resizable=yes,top="+(screen.availHeight - parseFloat(300))/2+",left="+(screen.availWidth - parseFloat(500))/2+",width=500pt,height=300pt");
}

function getElementsByClassName(classname) {
	var results = new Array();
	var elems = document.getElementsByTagName("*");
	for(var i = 0; i<elems.length; i++) {
		if(elems[i].className.indexOf(classname) != -1) {
			results[results.length] = elems[i];
		}
	}
	return results;
}

function chnCCDefaultId(id){
	var extend_trs = getElementsByClassName('extend_tr');
	var display = '';
	if(id!='0') display = 'none';
	for (var i = 0; i<extend_trs.length; i++) extend_trs[i].style.display=display;
}