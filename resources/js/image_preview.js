// 「写真を選択」と「画像,×ボタン」の表示切り替え
const toggleActive = () => {
  // 画像と×ボタンをラップしてるdiv
  const divRelative = document.getElementById('relative')
  // 写真を選択ボタン
  const toggleLabel = document.getElementById('toggle-label')

  // footerのポジションも切り替えるのに必要
  const footer = document.getElementsByTagName('footer')[0]

  // それぞれ切り替え
  divRelative.classList.toggle('active')
  toggleLabel.classList.toggle('active')
  footer.classList.toggle('active')
}

// 写真選択からプレビューまで
const prevImage = (e) => {
  const reader = new FileReader()
  reader.onload = (e) => {
    const preview = document.getElementById('preview')
    preview.setAttribute('src', e.target.result)
  }
  reader.readAsDataURL(e.target.files[0])

  // 切り替え
  toggleActive()
}

// 写真上の×ボタンを押した時の処理
const closeBtn = document.getElementById('close-btn')
closeBtn.addEventListener('click', toggleActive)

// 写真を選択した時の処理
const img = document.getElementById('image')
img.addEventListener('change', prevImage)

