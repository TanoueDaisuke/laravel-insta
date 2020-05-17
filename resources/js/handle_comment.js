// ①コメント投稿する際に０文字ではボタンを押せなくする
const messageInput = document.getElementsByName('message') // コメント投稿inputタグ

// 入力制限
messageInput.forEach(input => {
  input.addEventListener('input', (e) => {
    if (e.target.value.length === 0) {
      e.target.nextElementSibling.setAttribute('disabled', '')
    } else {
      e.target.nextElementSibling.removeAttribute('disabled')
    }
  })
})

// ②コメント削除する際に、どのコメントかわかりやすいように削除アイコンにカーソルが載ったら該当コメントに背景色をつける
// もちろん外れたら元に戻す

const toggleHoverCommentLine = (e) => {
  const commentId = e.target.dataset.commentId
  const commentLine = document.getElementById(`comment${commentId}`) // line_commentクラスのpタグ
  commentLine.classList.toggle("hover-comment")
}

const deleteIconsArray = Array.from(document.getElementsByClassName('js-comment-delete'))

deleteIconsArray.forEach(deleteIcon => {
  deleteIcon.addEventListener('mouseover', toggleHoverCommentLine)
  deleteIcon.addEventListener('mouseleave', toggleHoverCommentLine)
})