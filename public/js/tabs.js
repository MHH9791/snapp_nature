const tabs = document.querySelectorAll('[data-tab-target]')
const tabContents = document.querySelectorAll('[data-tab-content]')
const body = document.body


tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        const target = document.querySelector(tab.dataset.tabTarget)
        tabContents.forEach(tabContent => {
            tabContent.classList.remove('active')
        })
        tabs.forEach(tab => {
            tab.classList.remove('active')
        })

        target.classList.add('active')
        tab.classList.add('active')

        if(target.querySelector("#map") == null){
            body.classList.remove('non-scrollable')
        }
        else{
            body.classList.add('non-scrollable')
        }


        if(document.getElementsByClassName(".task_page") != null){
            load_a_tab()
        }
    })
})