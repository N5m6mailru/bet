<div class="container">
  <form onsubmit="updatePost(this); return false;">
    <div class="mb-3">
      <input type="text" name="title" class="form-control" placeholder="Заголовок">
    </div>
    <div class="mb-3">
      <textarea id="sample">Hi</textarea>
    </div>
    <div class="mb-3">
      <input type="text" name="author" class="form-control" placeholder="Автор">
    </div>
    <div class="mb-3">
      <input type="submit" class="form-control btn btn-primary" value="Сохранить">
    </div>
  </form>
</div>
<link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor.css" rel="stylesheet"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor-contents.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
<!-- languages (Basic Language: English/en) -->
<script src="https://cdn.jsdelivr.net/npm/suneditor@latest/src/lang/ru.js"></script>
<script>
  const editor = SUNEDITOR.create((document.getElementById('sample') || 'sample'),{
      // All of the plugins are loaded in the "window.SUNEDITOR" object in dist/suneditor.min.js file
      // Insert options
      // Language global object (default: en)
      lang: SUNEDITOR_LANG['ru'],
      buttonList: [
        ['undo', 'redo'],
        ['font', 'fontSize', 'formatBlock'],
        ['paragraphStyle', 'blockquote'],
        ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
        ['fontColor', 'hiliteColor', 'textStyle'],
        ['removeFormat'],
        '/', // Line break
        ['outdent', 'indent'],
        ['align', 'horizontalRule', 'list', 'lineHeight'],
        ['table', 'link', 'image', 'video', 'audio' /** ,'math' */], // You must add the 'katex' library at options to use the 'math' plugin.
        /** ['imageGallery'] */ // You must add the "imageGalleryUrl".
        ['fullScreen', 'showBlocks', 'codeView']
      ],
      width: "100%",
      height: "600px"
  });
  
  const title = document.getElementsByName("title")[0];
  const author= document.getElementsByName("author")[0];
  const formData = new FormData();
  formData.append('id',location.pathname.split("/")[3]);
  fetch('/getPostById',{
    method: "POST",
    body: formData
  }).then(response=>response.json())
    .then(result=>{
      console.log(result);
      title.value = result.title;
      author.value = result.author;
      editor.setContents(result.content);
    })
  
  function updatePost(form){
    const formData = new FormData(form);
    formData.append('content',editor.getContents());
    formData.append('id',location.pathname.split("/")[3]);
    fetch('/updatePost',{
      method: "POST",
      body: formData
    }).then(response=>response.json())
      .then(result=>{
        console.log(result);
      })
  }
  
</script>