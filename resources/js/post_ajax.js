const postAjax = async (e) => {
  const req = new XMLHttpRequest()
  const postId = e.target.parentNode.parentNode.dataset.postId // i -> button -> form

  // 非同期で実行されてしまい、postIdの取得前に実行されてしまうのでasync/awaitで同期通信
  await req.open(
    'POST', 
    `/posts/${postId}/likes`, 
    true // 一部同期処理があるが、推奨通り非同期で設定する。
  )
  // ヘッダーにcsrfトークンをセット
  await req.setRequestHeader(
    'X-CSRF-TOKEN', 
    document.getElementsByName('csrf-token')[0].content
  )
  ////  async/await ////


  // post通信におけるクエストリング(?の後ろの部分) = リクエストボディを設定するのに必要
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


  // 受信が完了した時のイベント設定
  req.onload = () => {
    if (req.status >= 200 && req.status < 400) {      
      console.log("成功", req.status)
      console.log("成功", req.response) // {'checked': 'checked' or ''}
    } else {
        console.log("失敗", req.status)
    }
  }

  // 受信に失敗した時のイベント
  req.onerror = () => {
    console.log("失敗");
  }

  // クリックされたiタグに"checked"クラスがあれば「checked」なければ「null」を代入
  const checked_or_null = e.target.classList.contains('checked') ? 'checked' : null

  // ajax => LikesController@toggle (POST)
  req.send(`checked=${checked_or_null}`);
}

// ajaxを行うノードにイベント設定
const likeButtons = document.querySelectorAll('.like-btn') // NodeListで取得
likeButtons.forEach(likeBtn => likeBtn.addEventListener('click', postAjax))