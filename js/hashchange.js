
function myLoad(link){
    console.log(link)
    $('.main-content').load(link);
    localStorage.setItem('page', link);
    
}


