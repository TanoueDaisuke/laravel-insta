const postAjax = async (e) => {
  const req = new XMLHttpRequest()
  const postId = e.target.parentNode.parentNode.dataset.postId // i -> button -> form

  // 非同期で実行されてしまい、postIdの取得前に実行されてしまうのでawaitで同期通信
  await req.open(
    'POST', 
    `/posts/${postId}/likes`, 
    true
  )

  // ヘッダーにcsrfトークンをセット
  await req.setRequestHeader(
    'X-CSRF-TOKEN', 
    document.getElementsByName('csrf-token')[0].content
  )
  

  req.onload = () => {
    if (req.status >= 200 && req.status < 400) {
      // Success!
      // e.target.parentNode.parentNode.submit()
      
      console.log("成功", req.status)
      console.log("成功", req.response) // {'checked': 'checked}
    } else {
        console.log("失敗", req.status)
    }
  }

  req.onerror = () => {
    console.log("失敗");
  }

  req.send();
}


const likeButtons = document.querySelectorAll('.like-btn') // NodeListで取得
likeButtons.forEach(likeBtn => likeBtn.addEventListener('click', postAjax))