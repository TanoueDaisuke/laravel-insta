const deleteBtn = document.getElementById('delete-btn')

deleteBtn.addEventListener('click', () => {
  const result = window.confirm('本当に削除しますか？')

  if (result) {
    deleteBtn.parentNode.submit() // 送信
  } else {
    alert('キャンセルされました') // キャンセル
  }
})