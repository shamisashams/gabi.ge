const tabTableBtns = document.querySelectorAll('.sex-select')
const tabTableContent = document.querySelectorAll('.gendertabs')


tabTableBtns.forEach((el, i ) => {
    el.addEventListener('click' , () => {
        tabTableBtns.forEach(el => {
            el.classList.remove('active')
        })
        tabTableContent.forEach(el => {
            el.classList.remove('show')
        })
        tabTableBtns[i].classList.add('active')
        tabTableContent[i].classList.add('show')
    })
})