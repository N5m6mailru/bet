        <!-- Main Content-->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto" id="postList">
                    <!-- Pager-->
                    <div class="clearfix"><a class="btn btn-primary float-right" href="#!">Older Posts →</a></div>
                </div>
            </div>
        </div>
        <hr />
            <div class="post-preview">
                      <a href="post.html">
                          <h2 class="post-title">${result.title}</h2>
                          <h3>editor.setContent(${result.content})</h3>
                      </a>
                      <p class="post-meta">
                          Posted by
                          ${result.author}
                          on ${result.add_date}
                      </p>
                  </div>
                  <hr />
        <script>
          let posts = '';
          const formData = new FormData();
          formData.append('id',location.pathname.split("/")[2]);
        console.log(location.pathname.split("/")[2]);
          fetch('/getPostById',{
            method:"POST",
            body:formData
            }).then(response=>response.json())
            .then(result=>{
              console.log(result);
             // result.forEach(post=>{
              //  const parser = new DOMParser();
               // const subtitle = parser.parseFromString(post.content, "text/html");
                 posts = `
                  <div class="post-preview">
                      <a href="post.html">
                          <h2 class="post-title">${result.title}</h2>
                          <h3>editor.setContent(${result.content})</h3>
                      </a>
                      <p class="post-meta">
                          Posted by
                          ${result.author}
                          on ${result.add_date}
                      </p>
                  </div>
                  <hr />
                `;
                postList.innerHTML = posts;
              })
         </script>
        
        