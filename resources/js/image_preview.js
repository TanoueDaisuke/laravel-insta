// 「写真を選択」と「画像,×ボタン」の表示切り替え
const togglePreview = () => {
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
const image = document.getElementById('image')
image.addEventListener('change', (e) => {
  const reader = new FileReader()
  reader.onload = (e) => {
    const preview = document.getElementById('preview')
    preview.setAttribute('src', e.target.result)
  }
  reader.readAsDataURL(e.target.files[0])

  // 切り替え
  togglePreview()
})

// 写真上の×ボタンを押した時の処理
const closeBtn = document.getElementById('close-btn')
closeBtn.addEventListener('click', togglePreview)




// これReactで書いたらクッソ楽なんだけどなあ...
