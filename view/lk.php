<style>
  .edit-btn{
    color: blue;
    cursor: pointer;
  }
  .edit-btn:hover{
    color:DodgerBlue;
  }
  .edit-btn:active{
    color:DarkBlue;
  }
  .save-btn{
    color:green;
    cursor: pointer;
  }
  .save-btn:hover{
    color:LimeGreen;
  }
  .save-btn:active{
    color:DarkGreen;
  }
  .cancel-btn{
    color:darkred;
    cursor: pointer;
  }
  .cancel-btn:hover{
    color:red;
  }
  .cancel-btn:active{
    color:maroon;
  }
</style>
<div class="container">
  <div class="row">
    <div class="col-3">
      <img id="userAvatar" width="100%" alt="">
      <input type="file" name="avatar" hidden onchange="uploadUserAvatar(this)">
      <p style="color:blue; cursor:pointer" class="text-center" onclick="this.previousElementSibling.click()">[загрузить изображение]</p>
    </div>
    <div class="col-9">
      <p>Имя: <span id="firstname"></span><span class="edit-btn">[редактировать]</span>
        <span class="save-btn" hidden data-item="firstname">[сохранить]</span>
        <span class="cancel-btn" hidden>[отменить]</span></p>
      <p>Фамилия: <span id="lastname"></span><span class="edit-btn">[редактировать]</span>
        <span class="save-btn" hidden data-item="lastname">[сохранить]</span>
        <span class="cancel-btn" hidden>[отменить]</span></p>
      <p>E-mail: <span id="email"></span></p>
      <p>ID: <span id="id"></span></p>
    </div>
  </div>
</div>
<script>
  //const name = document.getElementById('firstname');
  fetch('/getUserById')
    .then(response=>response.json())
    .then(result=>{
      lastname.innerText = result.lastname;
      firstname.innerText = result.firstname;
      email.innerText = result.email;
      id.innerText = result.id;
      userAvatar.src = result.avatar;
    })
    
    function uploadUserAvatar(input){
      const formData = new FormData();
      formData.append('avatar',input.files[0]);
      
      fetch('/uploadUserAvatar',{
        method: "POST",
        body: formData
      }).then(response=>response.json())
        .then(result=>{
          if(result.imagePath !== 'error'){
            userAvatar.src = result.imagePath;
          }else{
            alert("Ошибка загрузки файла");
          }
        })
    }
    const editBtns = document.querySelectorAll('.edit-btn');
    const saveBtns = document.querySelectorAll('.save-btn');
    const cancelBtns = document.querySelectorAll('.cancel-btn');
    for(let i=0; i<editBtns.length; i++){
      const editBtn = editBtns[i];
      const saveBtn = saveBtns[i];
      const cancelBtn=cancelBtns[i];
      let value;
      editBtn.addEventListener("click", ()=>{ // нажатие на кнопку редактировать
        value = editBtn.previousElementSibling.innerText;
        editBtn.previousElementSibling.innerHTML = `<input type="text" value="${value}">`;
        editBtn.hidden = true; // Скрываем кнопку [редактировать]
        saveBtn.hidden = false; // Показываем кнопку [сохранить]
        cancelBtn.hidden = false;
      });
      saveBtn.addEventListener("click", ()=>{
        let value = editBtn.previousElementSibling.getElementsByTagName('input')[0].value;
        const item = saveBtn.dataset.item;
        const formData = new FormData();
        formData.append('item',item);
        formData.append('value',value);
        fetch("/updateUser",{
          method:"POST",
          body:formData
        }).then(response=>response.text())
          .then(result=>{
            value = editBtn.previousElementSibling.getElementsByTagName('input')[0].value;
            editBtn.previousElementSibling.innerHTML = value;
            saveBtn.hidden = true;
            editBtn.hidden = false;
            cancelBtn.hidden = true;
          });
      });
      cancelBtn.addEventListener("click", ()=>{
            editBtn.previousElementSibling.innerHTML = value;
            saveBtn.hidden = true;
            editBtn.hidden = false;
            cancelBtn.hidden = true;
      });
    }
</script>