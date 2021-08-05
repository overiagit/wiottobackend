$(document).ready(function(event){
    document.querySelectorAll("ul.pagination > li").forEach(function (item){
       item.classList.add('btn', 'btn-outline-info');
    });
})