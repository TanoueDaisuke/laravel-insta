const messageInput = document.getElementsByName('message')

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