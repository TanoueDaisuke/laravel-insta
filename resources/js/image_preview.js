const image = document.getElementById('image')
image.addEventListener('change', (e) => {
  const reader = new FileReader()
  reader.onload = (e) => {
    const preview = document.getElementById('preview')
    preview.setAttribute('src', e.target.result)
  }
  reader.readAsDataURL(e.target.files[0])
})
