<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
</head>

<body>
<form>
<input type="text" value="name"/>
<textareaname="editor1" cols="80" rows="15" id="editor1" class="fontha" style="border-radius:0.25em;"><?php echo $row1['editor1'] ;?></textarea>
		<script type='text/javascript'>
			var editor = CKEDITOR.replace( 'editor1' );
		</script>

</form>
</body>
</html>