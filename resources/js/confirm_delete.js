const confirmDelete = (e) => {
  const result = window.confirm('本当に削除しますか？')

  console.log(e.target); // i

  // const deleteId = e.target.parentNode.dataset.deleteId // buttonタグのdata-delete-id
  
  
  if (result) {
    e.target.parentNode.parentNode.submit() // 送信
  }
}
const deleteButtons = document.getElementsByName('delete')

// name属性が"delete"(削除アイコンボタン)のタグ全てにイベント設定
deleteButtons.forEach(deleteBtn => {
  deleteBtn.addEventListener('click', confirmDelete)
});
