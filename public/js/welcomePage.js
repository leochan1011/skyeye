const h3 = document.querySelector('.title-confi')

document.addEventListener('scroll', (e) =>{
    let scrolled = document.documentElement.scrollTop /
    (document.documentElement.scrollHeight - document.documentElement.clientHeight)
    //console.log(scrolled)
    h3.style.setProperty('--percentage',`${scrolled * 100*10}%`)
    console.log(scrolled)
})

const h1 = document.querySelector('.video-text')
const theChip = document.querySelector('#the-chip')
const UAV = document.querySelector('#UAV')
const img = document.querySelector('#the-chip img')

document.addEventListener('scroll', (e) =>{
    let sc = document.documentElement.scrollTop /
    (document.documentElement.scrollHeight - document.documentElement.clientHeight)
    // zoom size
    theChip.style.width = theChip.style.height = document.documentElement.clientWidth * 20 * (Math.pow(sc,13) ) +'px'
    //the h1 title moving effect
    //console.log(sc)
    if(sc <= 0.83){
        h1.style.opacity = (0.7 - sc) / 0.05
        h1.style.marginTop =6 + (sc * 10 * -1 ) + 'cm'
    }else{
        h1.style.opacity = 0
    }
    // The SVG appear
    if(sc <= 0.8){
        UAV.style.opacity = (sc - 0.7) / 0.01
    }else{
        UAV.style.opacity = 1
    }
    // The SVG bg Zoom to disappear
    if(sc >= 0.93){
        img.style.opacity = (1-sc) / 0.05
        theChip.classList.add('transparent')
    }else{
        theChip.classList.remove('transparent')
    }

    if(sc >=0.95){
        theChip.style.opacity = (1 - sc) / 0.05
    }else{
        theChip.style.opacity = 1
    }
})