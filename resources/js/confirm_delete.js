const confirmDelete = () => {
  const result = window.confirm('本当に投稿を削除しますか？')
  
  if (result) {
    deleteBtn.parentNode.submit() // 送信
  }
}
const deleteButtons = document.getElementsByName('delete')

// name属性が"delete"(削除アイコンボタン)のタグ全てにイベント設定
deleteButtons.forEach(deleteBtn => {
  deleteBtn.addEventListener('click', confirmDelete)
});
