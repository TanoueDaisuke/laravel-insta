//////// Ajaxといいねクリックの切り替えを行うJSファイル //////////

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


// handleClick関数が長くなりすぎるのでswitchの部分を少し分けた
const replaceLikedContent = (isChecked, likedContent, likeCount) => {  
  let newLikedText = ''

  if (isChecked) {
    switch (likeCount) {
      // 一人がいいねしてるとき(自分だけ)
      case 1:
        newLikedText = '' // いいねしているユーザーは０人ということになるので
        break;
        
      // ２人以上がいいねしているとき(自分を含む)
      default:
        newLikedText = `<span>${likeCount - 1}人</span>が「いいね！」しました` // 他のユーザーを持ってくるロジックが面倒なのでこれで許してクレメンス・・・
        break;
      }
  } else {
    switch (likeCount) {
      // 誰もいいねしてないとき
      case 0 :
        newLikedText = `<span>${likedContent.dataset.authUser}</span>が「いいね」しました`
        break;
        
      // １人以上がいいねしているとき
      default:
        newLikedText = `<span>${likedContent.dataset.authUser}</span>, 他${likeCount}が「いいね」しました`
      break;
    }
  }

  // console.log(newLikedText)
  
  return newLikedText
}


const handleClick = (e) => {
  const heartIcon = e.target
  const targetPostId = Array.from(heartIcon.classList).find(className => className.indexOf('post') !== -1) // 例) post12
  // console.log(targetPostId);

  // 「他〇人がいいねしました」のpタグを獲得
  const likedContent = document.getElementById(targetPostId)
  // console.log(likedContent);

  // クリック前のいいね数
  const likeCount = Number(likedContent.dataset.likeCount) 

  let newLikedText = ''
  
  // if ： いいねがついてる時の処理 => いいねの取り消し
  // else ： いいねがない場合の処理 => いいね追加  
  if (heartIcon.classList.contains('checked')) {
    likedContent.setAttribute('data-like-count', likeCount - 1) //data-like-countも変える
    newLikedText = replaceLikedContent(true, likedContent, likeCount)
  } else {
    likedContent.setAttribute('data-like-count', likeCount + 1)
    newLikedText = replaceLikedContent(false, likedContent, likeCount)
  }
  
  // 各classの付け替え
  heartIcon.classList.toggle('fas') // fasは背景色ありのアイコン
  heartIcon.classList.toggle('far') // farはなし
  heartIcon.classList.toggle('checked') // checkedをつけて赤にする
  
  // いいねクリック後の個数を反映したテキストに置き換え
  // console.log(newLikedText);
  
  likedContent.innerHTML = newLikedText
}

// ajaxを行うノードにイベント設定
const likeButtons = document.querySelectorAll('.like-btn') // NodeListで取得
likeButtons.forEach(likeBtn => {
  likeBtn.addEventListener('click', postAjax)
  likeBtn.addEventListener('click', handleClick)
})