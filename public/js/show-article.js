const local_url = 'http://167.172.85.4'

async function likeArticle(article_id,liked){
  var data = {
    article_id : article_id,
    liked : liked
  }
  console.log(liked)
  var response = await fetch(local_url+'/article/like',{
    method: 'POST',
    headers: {
      'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest"
    },
    credentials: "same-origin",
    body: JSON.stringify(data)
  })
  var result = await response.json()
  .then((res) => {
    console.log(res.data)
    if (res.message == 'success') {
      Swal.fire({
        title: 'Artikel '+ res.data ? 'Disukai' : 'Tidak Disukai',
        text: '',
        icon: 'success',
        confirmButtonColor: '#3085d6'
      })
      .then(() => location.reload())
    }
  })
}

async function addComment() {
  const formData = new FormData(document.getElementById('comment-form'));
  var data = {
    article_id : formData.get('article_id'),
    comment : formData.get('comment')
  }
  console.log(data)
  var response = await fetch(local_url+'/article/comment/add',{
    method: 'POST',
    headers: {
      'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest"
    },
    credentials: "same-origin",
    body: JSON.stringify(data)
  })
  var result = await response.json()
  .then((res) => {
    if (res.message == 'success') {
      Swal.fire({
        title: 'Komentar Berhasil Ditambahkan',
        text: '',
        icon: 'success',
        confirmButtonColor: '#3085d6'
      })
      .then(() => location.reload())
    }
  })
}

function toggleReply(index){
  var form = document.getElementById('reply-comment-form-'+index)
  if (!form.classList.contains("hidden")){
    form.classList.add("hidden");
    return
  }
  form.classList.remove("hidden")
}

async function addReplyComment(index){
  const formData = new FormData(document.getElementById('reply-comment-form-'+index));
  var data = {
    article_comment_id : formData.get('article_comment_id'),
    reply_comment : formData.get('reply_comment')
  }
  console.log(data)
  var response = await fetch(local_url+'/article/reply-comment/add',{
    method: 'POST',
    headers: {
      'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
      "Content-Type": "application/json",
      "Accept": "application/json, text-plain, */*",
      "X-Requested-With": "XMLHttpRequest"
    },
    credentials: "same-origin",
    body: JSON.stringify(data)
  })
  var result = await response.json()
  .then((res) => {
    if (res.message == 'success') {
      Swal.fire({
        title: 'Balasan Berhasil Ditambahkan',
        text: '',
        icon: 'success',
        confirmButtonColor: '#3085d6'
      })
      .then(() => location.reload())
    }
  })
}